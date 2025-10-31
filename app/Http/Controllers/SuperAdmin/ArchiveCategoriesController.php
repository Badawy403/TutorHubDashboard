<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\ArchiveCategoriesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\ArchiveCategories\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\ArchiveCategoriesImport;
use App\Models\ArchiveCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ArchiveCategoriesController extends Controller
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
            $archive_categories =  ArchiveCategory::withAll();
            if ($req->trash && $req->trash == 'with') {
                $archive_categories =  $archive_categories->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $archive_categories =  $archive_categories->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $archive_categories = $archive_categories->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $archive_categories = $archive_categories->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $archive_categories = $archive_categories->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $archive_categories = $archive_categories->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $archive_categories = $archive_categories->get();
                return $archive_categories;
            }
            $archive_categories = $archive_categories->get();
            return $archive_categories;
        }
        $archive_categories = ArchiveCategory::withAll()->orderBy('id', 'desc')->get();
        return $archive_categories;
    }


    /*********View All ArchiveCategories  ***********/
    public function index(Request $request)
    {
        $archive_categories = $this->getter($request);
        return view('super_admins.archive_categories.index')->with('archive_categories', $archive_categories);
    }

    /*********View Create Form of ArchiveCategory  ***********/
    public function create()
    {
        return view('super_admins.archive_categories.create');
    }

    /*********Store ArchiveCategory  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','archive_categories');
            $archive_category = ArchiveCategory::create($data);
            $archive_category->slug = Str::slug($archive_category->name . ' ' . $archive_category->id, '-');
            $archive_category->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.archive_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.archive_categories.index')->with('message', 'ArchiveCategory Created Successfully')->with('message_type', 'success');
    }

    /*********View ArchiveCategory  ***********/
    public function show(ArchiveCategory $archive_category)
    {
        return view('super_admins.archive_categories.show', compact('archive_category'));
    }

    /*********View Edit Form of ArchiveCategory  ***********/
    public function edit(ArchiveCategory $archive_category)
    {
        return view('super_admins.archive_categories.edit', compact('archive_category'));
    }

    /*********Update ArchiveCategory  ***********/
    public function update(CreateRequest $request, ArchiveCategory $archive_category)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','archive_categories',$archive_category->image);

            } else {
                $data['image'] = $archive_category->image;
            }
            $archive_category->update($data);
            $archive_category = ArchiveCategory::find($archive_category->id);
            $slug = Str::slug($archive_category->name . ' ' . $archive_category->id, '-');
            $archive_category->update([
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.archive_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.archive_categories.index')->with('message', 'ArchiveCategory Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $archive_categories = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "archive_categories." . $extension;
        return Excel::download(new ArchiveCategoriesExport($archive_categories), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new ArchiveCategoriesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE ArchiveCategory ***********/
    public function destroy(ArchiveCategory $archive_category)
    {
        // if ($archive_category->Has('posts')) {
        //     $archive_category->news()->delete();
        // }
        $archive_category->delete();
        return redirect()->back()->with('message', 'ArchiveCategory Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE ArchiveCategory ***********/
    public function destroyPermanently(Request $request, $archive_category)
    {
        $archive_category = ArchiveCategory::withTrashed()->find($archive_category);
        if ($archive_category) {
            if ($archive_category->trashed()) {
                if ($archive_category->image && file_exists(public_path($archive_category->image))) {
                    unlink(public_path($archive_category->image));
                }
                $archive_category->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore ArchiveCategory***********/
    public function restore(Request $request, $archive_category)
    {
        $archive_category = ArchiveCategory::withTrashed()->find($archive_category);
        if ($archive_category->trashed()) {
            $archive_category->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
