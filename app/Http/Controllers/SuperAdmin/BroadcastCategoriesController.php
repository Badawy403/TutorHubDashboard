<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\EventCategoriesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\BroadcastCategories\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\EventCategoriesImport;
use App\Models\BroadcastCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class BroadcastCategoriesController extends Controller
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
            $broadcast_categories =  BroadcastCategory::withAll();
            if ($req->trash && $req->trash == 'with') {
                $broadcast_categories =  $broadcast_categories->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $broadcast_categories =  $broadcast_categories->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $broadcast_categories = $broadcast_categories->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $broadcast_categories = $broadcast_categories->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $broadcast_categories = $broadcast_categories->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $broadcast_categories = $broadcast_categories->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $broadcast_categories = $broadcast_categories->get();
                return $broadcast_categories;
            }
            $broadcast_categories = $broadcast_categories->get();
            return $broadcast_categories;
        }
        $broadcast_categories = BroadcastCategory::withAll()->orderBy('id', 'desc')->get();
        return $broadcast_categories;
    }


    /*********View All BlogCategories  ***********/
    public function index(Request $request)
    {
        $broadcast_categories = $this->getter($request);
        return view('super_admins.broadcast_categories.index')->with('broadcast_categories', $broadcast_categories);
    }

    /*********View Create Form of BroadcastCategory  ***********/
    public function create()
    {
        return view('super_admins.broadcast_categories.create');
    }

    /*********Store BroadcastCategory  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','broadcast_categories');
            $broadcast_category = BroadcastCategory::create($data);
            $broadcast_category->slug = Str::slug($broadcast_category->name . ' ' . $broadcast_category->id, '-');
            $broadcast_category->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.broadcast_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.broadcast_categories.index')->with('message', 'BroadcastCategory Created Successfully')->with('message_type', 'success');
    }

    /*********View BroadcastCategory  ***********/
    public function show(BroadcastCategory $broadcast_category)
    {
        return view('super_admins.broadcast_categories.show', compact('broadcast_category'));
    }

    /*********View Edit Form of BroadcastCategory  ***********/
    public function edit(BroadcastCategory $broadcast_category)
    {
        return view('super_admins.broadcast_categories.edit', compact('broadcast_category'));
    }

    /*********Update BroadcastCategory  ***********/
    public function update(CreateRequest $request, BroadcastCategory $broadcast_category)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','broadcast_categories',$broadcast_category->image);
            } else {
                $data['image'] = $broadcast_category->image;
            }
            $broadcast_category->update($data);
            $broadcast_category = BroadcastCategory::find($broadcast_category->id);
            $slug = Str::slug($broadcast_category->name . ' ' . $broadcast_category->id, '-');
            $broadcast_category->update([
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.broadcast_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.broadcast_categories.index')->with('message', 'BroadcastCategory Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $broadcast_categories = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "broadcast_categories." . $extension;
        return Excel::download(new EventCategoriesExport($broadcast_categories), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new EventCategoriesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE BroadcastCategory ***********/
    public function destroy(BroadcastCategory $broadcast_category)
    {
        $broadcast_category->delete();
        return redirect()->back()->with('message', 'BroadcastCategory Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE BroadcastCategory ***********/
    public function destroyPermanently(Request $request, $broadcast_category)
    {
        $broadcast_category = BroadcastCategory::withTrashed()->find($broadcast_category);
        if ($broadcast_category) {
            if ($broadcast_category->trashed()) {
                if ($broadcast_category->image && file_exists(public_path($broadcast_category->image))) {
                    unlink(public_path($broadcast_category->image));
                }
                $broadcast_category->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore BroadcastCategory***********/
    public function restore(Request $request, $broadcast_category)
    {
        $broadcast_category = BroadcastCategory::withTrashed()->find($broadcast_category);
        if ($broadcast_category->trashed()) {
            $broadcast_category->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
