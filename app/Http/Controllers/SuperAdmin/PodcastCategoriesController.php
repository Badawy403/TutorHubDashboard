<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\EventCategoriesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\PodcastCategories\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\EventCategoriesImport;
use App\Models\PodcastCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class PodcastCategoriesController extends Controller
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
            $podcast_categories =  PodcastCategory::withAll();
            if ($req->trash && $req->trash == 'with') {
                $podcast_categories =  $podcast_categories->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $podcast_categories =  $podcast_categories->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $podcast_categories = $podcast_categories->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $podcast_categories = $podcast_categories->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $podcast_categories = $podcast_categories->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $podcast_categories = $podcast_categories->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $podcast_categories = $podcast_categories->get();
                return $podcast_categories;
            }
            $podcast_categories = $podcast_categories->get();
            return $podcast_categories;
        }
        $podcast_categories = PodcastCategory::withAll()->orderBy('id', 'desc')->get();
        return $podcast_categories;
    }


    /*********View All BlogCategories  ***********/
    public function index(Request $request)
    {
        $podcast_categories = $this->getter($request);
        return view('super_admins.podcast_categories.index')->with('podcast_categories', $podcast_categories);
    }

    /*********View Create Form of PodcastCategory  ***********/
    public function create()
    {
        return view('super_admins.podcast_categories.create');
    }

    /*********Store PodcastCategory  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','podcast_categories');
            $podcast_category = PodcastCategory::create($data);
            $podcast_category->slug = Str::slug($podcast_category->name . ' ' . $podcast_category->id, '-');
            $podcast_category->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.podcast_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.podcast_categories.index')->with('message', 'PodcastCategory Created Successfully')->with('message_type', 'success');
    }

    /*********View PodcastCategory  ***********/
    public function show(PodcastCategory $podcast_category)
    {
        return view('super_admins.podcast_categories.show', compact('podcast_category'));
    }

    /*********View Edit Form of PodcastCategory  ***********/
    public function edit(PodcastCategory $podcast_category)
    {
        return view('super_admins.podcast_categories.edit', compact('podcast_category'));
    }

    /*********Update PodcastCategory  ***********/
    public function update(CreateRequest $request, PodcastCategory $podcast_category)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','podcast_categories',$podcast_category->image);
            } else {
                $data['image'] = $podcast_category->image;
            }
            $podcast_category->update($data);
            $podcast_category = PodcastCategory::find($podcast_category->id);
            $slug = Str::slug($podcast_category->name . ' ' . $podcast_category->id, '-');
            $podcast_category->update([
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.podcast_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.podcast_categories.index')->with('message', 'PodcastCategory Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $podcast_categories = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "podcast_categories." . $extension;
        return Excel::download(new EventCategoriesExport($podcast_categories), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new EventCategoriesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE PodcastCategory ***********/
    public function destroy(PodcastCategory $podcast_category)
    {
        $podcast_category->delete();
        return redirect()->back()->with('message', 'PodcastCategory Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE PodcastCategory ***********/
    public function destroyPermanently(Request $request, $podcast_category)
    {
        $podcast_category = PodcastCategory::withTrashed()->find($podcast_category);
        if ($podcast_category) {
            if ($podcast_category->trashed()) {
                if ($podcast_category->image && file_exists(public_path($podcast_category->image))) {
                    unlink(public_path($podcast_category->image));
                }
                $podcast_category->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore PodcastCategory***********/
    public function restore(Request $request, $podcast_category)
    {
        $podcast_category = PodcastCategory::withTrashed()->find($podcast_category);
        if ($podcast_category->trashed()) {
            $podcast_category->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
