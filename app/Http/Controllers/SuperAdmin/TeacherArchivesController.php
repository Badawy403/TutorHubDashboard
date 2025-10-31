<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\ArchivesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\TeacherArchives\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\ArchivesImport;
use App\Models\Archive;
use App\Models\Teacher;
use App\Models\ArchiveCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class TeacherArchivesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null , $teacher)
    {
        if ($req != null) {
            $teacher_archives =  $teacher->teacher_archives();
            if ($req->trash && $req->trash == 'with') {
                $teacher_archives =  $teacher_archives->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $teacher_archives =  $teacher_archives->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $teacher_archives = $teacher_archives->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $teacher_archives = $teacher_archives->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $teacher_archives = $teacher_archives->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $teacher_archives = $teacher_archives->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $teacher_archives = $teacher_archives->get();
                return $teacher_archives;
            }
            $teacher_archives = $teacher_archives->get();
            return $teacher_archives;
        }
        $teacher_archives = $teacher->teacher_archives()->withAll()->orderBy('id', 'desc')->get();
        return $teacher_archives;
    }


    /*********View All TeacherArchives  ***********/
    public function index(Request $request , Teacher $teacher)
    {
        $teacher_archives = $this->getter($request , null , $teacher);
        return view('super_admins.teachers.teacher_archives.index' , compact('teacher_archives' , 'teacher'));
    }

    /*********View Create Form of Archive  ***********/
    public function create(Teacher $teacher)
    {
        $archive_categories = ArchiveCategory::active()->get();
        $tags = Tag::active()->get();
        
        return view('super_admins.teachers.teacher_archives.create', compact('archive_categories' , 'teacher' , 'tags'));
    }

    /*********Store Archive  ***********/
    public function store(CreateRequest $request , Teacher $teacher)
    {
        
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['created_by_user_id'=>auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request,'image','teacher_archives');
            $teacher_archive = $teacher->teacher_archives()->create($data);
            $teacher_archive->slug = Str::slug($teacher_archive->name . ' ' . $teacher_archive->id, '-');
            $teacher_archive->save();
            $teacher_archive = $teacher->teacher_archives()->withAll()->find($teacher_archive->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_archives.index' , $teacher->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_archives.index' , $teacher->id)->with('message', 'Archive Created Successfully')->with('message_type', 'success');
    }

    /*********View Archive  ***********/
    public function show(Teacher $teacher ,Archive $teacher_archive)
    {
        if($teacher->id != $teacher_archive->teacher_id){
            return redirect()->back()->with('message', 'TeacherArchive Not Found')->with('message_type', 'error');
        }
        return view('super_admins.teachers.teacher_archives.show', compact('teacher_archive' , 'teacher'));
    }

    /*********View Edit Form of Archive  ***********/
    public function edit(Teacher $teacher ,Archive $teacher_archive)
    {
        if($teacher->id != $teacher_archive->teacher_id){
            return redirect()->back()->with('message', 'TeacherArchive Not Found')->with('message_type', 'error');
        }
        $archive_categories = ArchiveCategory::active()->get();
        $tags = Tag::active()->get();
        return view('super_admins.teachers.teacher_archives.edit', compact('teacher_archive','archive_categories' , 'teacher' , 'tags'));
    }

    /*********Update Archive  ***********/
    public function update(CreateRequest $request,Teacher $teacher , Archive $teacher_archive)
    {
        if($teacher->id != $teacher_archive->teacher_id){
            return redirect()->back()->with('message', 'TeacherArchive Not Found')->with('message_type', 'error');
        }
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
            $data = $request->all();
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','teacher_archives',$teacher_archive->image);
            } else {
                $data['image'] = $teacher_archive->image;
            }
            $teacher_archive->update($data);
            $teacher_archive = Archive::find($teacher_archive->id);
            $slug = Str::slug($teacher_archive->name . ' ' . $teacher_archive->id, '-');
            $teacher_archive->update([
                'slug' => $slug
            ]);
            $teacher_archive->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_archives.index' , $teacher->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_archives.index' , $teacher->id)->with('message', 'Archive Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $teacher_archives = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "teacher_archives." . $extension;
        return Excel::download(new ArchivesExport($teacher_archives), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new ArchivesImport, $file);
        return redirect()->back()->with('message', 'Archive Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Archive ***********/
    public function destroy(Teacher $teacher ,Archive $teacher_archive)
    {
        if($teacher->id != $teacher_archive->teacher_id){
            return redirect()->back()->with('message', 'TeacherArchive Not Found')->with('message_type', 'error');
        }
        $teacher_archive->delete();
        return redirect()->back()->with('message', 'Archive Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Archive ***********/
    public function destroyPermanently(Request $request,Teacher $teacher ,$teacher_archive)
    {
        if($teacher->id != $teacher_archive->teacher_id){
            return redirect()->back()->with('message', 'TeacherArchive Not Found')->with('message_type', 'error');
        }
        $teacher_archive = Archive::withTrashed()->find($teacher_archive);
        if ($teacher_archive) {
            if ($teacher_archive->trashed()) {
                if ($teacher_archive->image && file_exists(public_path($teacher_archive->image))) {
                    unlink(public_path($teacher_archive->image));
                }
                $teacher_archive->forceDelete();
                return redirect()->back()->with('message', 'Archive Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Archive Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Archive Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Archive***********/
    public function restore(Request $request,Teacher $teacher, $teacher_archive)
    {
        if($teacher->id != $teacher_archive->teacher_id){
            return redirect()->back()->with('message', 'TeacherArchive Not Found')->with('message_type', 'error');
        }
        $teacher_archive = Archive::withTrashed()->find($teacher_archive);
        if ($teacher_archive->trashed()) {
            $teacher_archive->restore();
            return redirect()->back()->with('message', 'Archive Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Archive Category Not Found')->with('message_type', 'error');
        }
    }
}
