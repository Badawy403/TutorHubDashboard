<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\EventCategoriesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\ServiceCategories\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\ServiceCategoriesImport;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ServiceCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

       /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
    //   $this->middleware('permission:service_category.index');
    //   $this->middleware('permission:service_category.add', ['only' => ['store']]);
    //   $this->middleware('permission:service_category.edit', ['only' => ['update']]);
    //   $this->middleware('permission:service_category.delete', ['only' => ['destroy']]);
    //   $this->middleware('permission:service_category.export', ['only' => ['export']]);
    //   $this->middleware('permission:service_category.import', ['only' => ['import']]);
  }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        if ($req != null) {
            $service_categories =  ServiceCategory::withAll();
            if ($req->trash && $req->trash == 'with') {
                $service_categories =  $service_categories->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $service_categories =  $service_categories->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $service_categories = $service_categories->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $service_categories = $service_categories->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $service_categories = $service_categories->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $service_categories = $service_categories->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $service_categories = $service_categories->get();
                return $service_categories;
            }
            $service_categories = $service_categories->get();
            return $service_categories;
        }
        $service_categories = ServiceCategory::withAll()->orderBy('id', 'desc')->get();
        return $service_categories;
    }


    /*********View All BlogCategories  ***********/
    public function index(Request $request)
    {
        $service_categories = $this->getter($request);
        return view('super_admins.service_categories.index')->with('service_categories', $service_categories);
    }

    /*********View Create Form of ServiceCategory  ***********/
    public function create()
    {
        return view('super_admins.service_categories.create');
    }

    /*********Store ServiceCategory  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','service_categories');
            $service_category = ServiceCategory::create($data);
            $service_category->slug = Str::slug($service_category->name . ' ' . $service_category->id, '-');
            $service_category->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.service_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.service_categories.index')->with('message', 'ServiceCategory Created Successfully')->with('message_type', 'success');
    }

    /*********View ServiceCategory  ***********/
    public function show(ServiceCategory $service_category)
    {
        return view('super_admins.service_categories.show', compact('service_category'));
    }

    /*********View Edit Form of ServiceCategory  ***********/
    public function edit(ServiceCategory $service_category)
    {
        return view('super_admins.service_categories.edit', compact('service_category'));
    }

    /*********Update ServiceCategory  ***********/
    public function update(CreateRequest $request, ServiceCategory $service_category)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','service_categories',$service_category->image);
            } else {
                $data['image'] = $service_category->image;
            }
            $service_category->update($data);
            $service_category = ServiceCategory::find($service_category->id);
            $slug = Str::slug($service_category->name . ' ' . $service_category->id, '-');
            $service_category->update([
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.service_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.service_categories.index')->with('message', 'ServiceCategory Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $service_categories = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "service_categories." . $extension;
        return Excel::download(new EventCategoriesExport($service_categories), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new ServiceCategoriesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE ServiceCategory ***********/
    public function destroy(ServiceCategory $service_category)
    {
        $service_category->delete();
        return redirect()->back()->with('message', 'ServiceCategory Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE ServiceCategory ***********/
    public function destroyPermanently(Request $request, $service_category)
    {
        $service_category = ServiceCategory::withTrashed()->find($service_category);
        if ($service_category) {
            if ($service_category->trashed()) {
                if ($service_category->image && file_exists(public_path($service_category->image))) {
                    unlink(public_path($service_category->image));
                }
                $service_category->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore ServiceCategory***********/
    public function restore(Request $request, $service_category)
    {
        $service_category = ServiceCategory::withTrashed()->find($service_category);
        if ($service_category->trashed()) {
            $service_category->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
