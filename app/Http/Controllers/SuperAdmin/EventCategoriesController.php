<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\EventCategoriesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\EventCategories\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\EventCategoriesImport;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class EventCategoriesController extends Controller
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
            $event_categories =  EventCategory::withAll();
            if ($req->trash && $req->trash == 'with') {
                $event_categories =  $event_categories->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $event_categories =  $event_categories->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $event_categories = $event_categories->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $event_categories = $event_categories->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $event_categories = $event_categories->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $event_categories = $event_categories->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $event_categories = $event_categories->get();
                return $event_categories;
            }
            $event_categories = $event_categories->get();
            return $event_categories;
        }
        $event_categories = EventCategory::withAll()->orderBy('id', 'desc')->get();
        return $event_categories;
    }


    /*********View All BlogCategories  ***********/
    public function index(Request $request)
    {
        $event_categories = $this->getter($request);
        return view('super_admins.event_categories.index')->with('event_categories', $event_categories);
    }

    /*********View Create Form of EventCategory  ***********/
    public function create()
    {
        return view('super_admins.event_categories.create');
    }

    /*********Store EventCategory  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if (!$request->is_featured) {
                $data['is_featured'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','event_categories');
            $event_category = EventCategory::create($data);
            $event_category->slug = Str::slug($event_category->name . ' ' . $event_category->id, '-');
            $event_category->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.event_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.event_categories.index')->with('message', 'EventCategory Created Successfully')->with('message_type', 'success');
    }

    /*********View EventCategory  ***********/
    public function show(EventCategory $event_category)
    {
        return view('super_admins.event_categories.show', compact('event_category'));
    }

    /*********View Edit Form of EventCategory  ***********/
    public function edit(EventCategory $event_category)
    {
        return view('super_admins.event_categories.edit', compact('event_category'));
    }

    /*********Update EventCategory  ***********/
    public function update(CreateRequest $request, EventCategory $event_category)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if (!$request->is_featured) {
                $data['is_featured'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','event_categories',$event_category->image);
            } else {
                $data['image'] = $event_category->image;
            }
            $event_category->update($data);
            $event_category = EventCategory::find($event_category->id);
            $slug = Str::slug($event_category->name . ' ' . $event_category->id, '-');
            $event_category->update([
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.event_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.event_categories.index')->with('message', 'EventCategory Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $event_categories = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "event_categories." . $extension;
        return Excel::download(new EventCategoriesExport($event_categories), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new EventCategoriesImport, $file);
        return redirect()->back()->with('message', 'Event Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE EventCategory ***********/
    public function destroy(EventCategory $event_category)
    {
        $event_category->delete();
        return redirect()->back()->with('message', 'EventCategory Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE EventCategory ***********/
    public function destroyPermanently(Request $request, $event_category)
    {
        $event_category = EventCategory::withTrashed()->find($event_category);
        if ($event_category) {
            if ($event_category->trashed()) {
                if ($event_category->image && file_exists(public_path($event_category->image))) {
                    unlink(public_path($event_category->image));
                }
                $event_category->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore EventCategory***********/
    public function restore(Request $request, $event_category)
    {
        $event_category = EventCategory::withTrashed()->find($event_category);
        if ($event_category->trashed()) {
            $event_category->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
