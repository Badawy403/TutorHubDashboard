<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\ArchivesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\TeacherArchives\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\ArchivesImport;
use App\Models\Archive;
use App\Models\ArchiveCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ArchivesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        if ($req != null) {
            $archives =  Archive::withAll();
            if ($req->trash && $req->trash == 'with') {
                $archives =  $archives->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $archives =  $archives->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $archives = $archives->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $archives = $archives->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $archives = $archives->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $archives = $archives->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $archives = $archives->get();
                return $archives;
            }
            $archives = $archives->get();
            return $archives;
        }
        $archives = Archive::withAll()->orderBy('id', 'desc')->get();
        return $archives;
    }


    /*********View All TeacherArchives  ***********/
    public function index(Request $request)
    {
        $archives = $this->getter($request , null);
        return view('super_admins.archives.index' , compact('archives'));
    }

    /*********View Create Form of Archive  ***********/
    public function create()
    {
        $archive_categories = ArchiveCategory::active()->get();
        $tags = Tag::active()->get();

        return view('super_admins.archives.create', compact('archive_categories' , 'tags'));
    }

    /*********Store Archive  ***********/
    public function store(CreateRequest $request)
    {

        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['created_by_user_id'=>auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request,'image','archives');
            $archive = Archive::create($data);
            $archive->slug = Str::slug($archive->name . ' ' . $archive->id, '-');
            $archive->save();
            $archive = Archive::withAll()->find($archive->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.archives.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.archives.index')->with('message', 'Archive Created Successfully')->with('message_type', 'success');
    }

    /*********View Archive  ***********/
    public function show(Archive $archive)
    {
        return view('super_admins.archives.show', compact('archive'));
    }

    /*********View Edit Form of Archive  ***********/
    public function edit(Archive $archive)
    {
        $archive_categories = ArchiveCategory::active()->get();
        $tags = Tag::active()->get();
        return view('super_admins.archives.edit', compact('archive','archive_categories' , 'tags'));
    }

    /*********Update Archive  ***********/
    public function update(CreateRequest $request , Archive $archive)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
            $data = $request->all();
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','archives',$archive->image);
            } else {
                $data['image'] = $archive->image;
            }
            $archive->update($data);
            $archive = Archive::find($archive->id);
            $slug = Str::slug($archive->name . ' ' . $archive->id, '-');
            $archive->update([
                'slug' => $slug
            ]);
            $archive->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.archives.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.archives.index')->with('message', 'Archive Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $archives = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "archives." . $extension;
        return Excel::download(new ArchivesExport($archives), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new ArchivesImport, $file);
        return redirect()->back()->with('message', 'Archive imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Archive ***********/
    public function destroy(Archive $archive)
    {
        $archive->delete();
        return redirect()->back()->with('message', 'Archive Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Archive ***********/
    public function destroyPermanently(Request $request,$archive)
    {
        $archive = Archive::withTrashed()->find($archive);
        if ($archive) {
            if ($archive->trashed()) {
                if ($archive->image && file_exists(public_path($archive->image))) {
                    unlink(public_path($archive->image));
                }
                $archive->forceDelete();
                return redirect()->back()->with('message', 'Archive Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Archive is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Archive Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Archive***********/
    public function restore(Request $request, $archive)
    {
        $archive = Archive::withTrashed()->find($archive);
        if ($archive->trashed()) {
            $archive->restore();
            return redirect()->back()->with('message', 'Archive Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Archive Not Found')->with('message_type', 'error');
        }
    }
}
