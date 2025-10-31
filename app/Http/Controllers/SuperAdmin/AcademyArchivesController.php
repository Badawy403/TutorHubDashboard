<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\ArchivesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\AcademyArchives\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\ArchivesImport;
use App\Models\Archive;
use App\Models\Academy;
use App\Models\ArchiveCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AcademyArchivesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null , $academy)
    {
        if ($req != null) {
            $academy_archives =  $academy->academy_archives();
            if ($req->trash && $req->trash == 'with') {
                $academy_archives =  $academy_archives->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $academy_archives =  $academy_archives->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $academy_archives = $academy_archives->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $academy_archives = $academy_archives->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $academy_archives = $academy_archives->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $academy_archives = $academy_archives->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $academy_archives = $academy_archives->get();
                return $academy_archives;
            }
            $academy_archives = $academy_archives->get();
            return $academy_archives;
        }
        $academy_archives = $academy->academy_archives()->withAll()->orderBy('id', 'desc')->get();
        return $academy_archives;
    }


    /*********View All AcademyArchives  ***********/
    public function index(Request $request , Academy $academy)
    {
        $academy_archives = $this->getter($request , null , $academy);
        return view('super_admins.academies.academy_archives.index' , compact('academy_archives' , 'academy'));
    }

    /*********View Create Form of Archive  ***********/
    public function create(Academy $academy)
    {
        $archive_categories = ArchiveCategory::active()->get();
        $tags = Tag::active()->get();
        
        return view('super_admins.academies.academy_archives.create', compact('archive_categories' , 'academy' , 'tags'));
    }

    /*********Store Archive  ***********/
    public function store(CreateRequest $request , Academy $academy)
    {
        
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['created_by_user_id'=>auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request,'image','academy_archives');
            $academy_archive = $academy->academy_archives()->create($data);
            $academy_archive->slug = Str::slug($academy_archive->name . ' ' . $academy_archive->id, '-');
            $academy_archive->save();
            $academy_archive = $academy->academy_archives()->withAll()->find($academy_archive->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academy_archives.index' , $academy->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academy_archives.index' , $academy->id)->with('message', 'Archive Created Successfully')->with('message_type', 'success');
    }

    /*********View Archive  ***********/
    public function show(Academy $academy ,Archive $academy_archive)
    {
        if($academy->id != $academy_archive->academy_id){
            return redirect()->back()->with('message', 'TeacherFirmArchive Not Found')->with('message_type', 'error');
        }
        return view('super_admins.academies.academy_archives.show', compact('academy_archive' , 'academy'));
    }

    /*********View Edit Form of Archive  ***********/
    public function edit(Academy $academy ,Archive $academy_archive)
    {
        if($academy->id != $academy_archive->academy_id){
            return redirect()->back()->with('message', 'TeacherFirmArchive Not Found')->with('message_type', 'error');
        }
        $archive_categories = ArchiveCategory::active()->get();
        $tags = Tag::active()->get();
        return view('super_admins.academies.academy_archives.edit', compact('academy_archive','archive_categories' , 'academy' , 'tags'));
    }

    /*********Update Archive  ***********/
    public function update(CreateRequest $request,Academy $academy , Archive $academy_archive)
    {
        if($academy->id != $academy_archive->academy_id){
            return redirect()->back()->with('message', 'TeacherFirmArchive Not Found')->with('message_type', 'error');
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
                $data['image'] = uploadCroppedFile($request,'image','academy_archives',$academy_archive->image);
            } else {
                $data['image'] = $academy_archive->image;
            }
            $academy_archive->update($data);
            $academy_archive = Archive::find($academy_archive->id);
            $slug = Str::slug($academy_archive->name . ' ' . $academy_archive->id, '-');
            $academy_archive->update([
                'slug' => $slug
            ]);
            $academy_archive->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academy_archives.index' , $academy->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academy_archives.index' , $academy->id)->with('message', 'Archive Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $academy_archives = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "academy_archives." . $extension;
        return Excel::download(new ArchivesExport($academy_archives), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new ArchivesImport, $file);
        return redirect()->back()->with('message', 'Archive Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Archive ***********/
    public function destroy(Academy $academy ,Archive $academy_archive)
    {
        if($academy->id != $academy_archive->academy_id){
            return redirect()->back()->with('message', 'TeacherFirmArchive Not Found')->with('message_type', 'error');
        }
        $academy_archive->delete();
        return redirect()->back()->with('message', 'Archive Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Archive ***********/
    public function destroyPermanently(Request $request,Academy $academy ,$academy_archive)
    {
        if($academy->id != $academy_archive->academy_id){
            return redirect()->back()->with('message', 'TeacherFirmArchive Not Found')->with('message_type', 'error');
        }
        $academy_archive = Archive::withTrashed()->find($academy_archive);
        if ($academy_archive) {
            if ($academy_archive->trashed()) {
                if ($academy_archive->image && file_exists(public_path($academy_archive->image))) {
                    unlink(public_path($academy_archive->image));
                }
                $academy_archive->forceDelete();
                return redirect()->back()->with('message', 'Archive Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Archive Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Archive Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Archive***********/
    public function restore(Request $request,Academy $academy, $academy_archive)
    {
        if($academy->id != $academy_archive->academy_id){
            return redirect()->back()->with('message', 'TeacherFirmArchive Not Found')->with('message_type', 'error');
        }
        $academy_archive = Archive::withTrashed()->find($academy_archive);
        if ($academy_archive->trashed()) {
            $academy_archive->restore();
            return redirect()->back()->with('message', 'Archive Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Archive Category Not Found')->with('message_type', 'error');
        }
    }
}
