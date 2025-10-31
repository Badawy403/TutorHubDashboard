<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\TeacherServicesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Services\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\TeacherServicesImport;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

       /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
    //   $this->middleware('permission:service.index');
    //   $this->middleware('permission:service.add', ['only' => ['store']]);
    //   $this->middleware('permission:service.edit', ['only' => ['update']]);
    //   $this->middleware('permission:service.delete', ['only' => ['destroy']]);
    //   $this->middleware('permission:service.export', ['only' => ['export']]);
    //   $this->middleware('permission:service.import', ['only' => ['import']]);
  }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        if ($req != null) {
            $services = Service::withAll();
            if ($req->trash && $req->trash == 'with') {
                $services =  $services->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $services =  $services->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $services = $services->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $services = $services->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $services = $services->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $services = $services->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $services = $services->get();
                return $services;
            }
            $services = $services->get();
            return $services;
        }
        $services = Service::withAll()->orderBy('id', 'desc')->get();
        return $services;
    }


    /*********View All Services  ***********/
    public function index(Request $request)
    {
        $services = $this->getter($request , null);
        return view('super_admins.services.index' , compact('services'));
    }

    /*********View Create Form of Service  ***********/
    public function create()
    {
        $service_categories = ServiceCategory::active()->get();
        $tags = Tag::active()->get();
        return view('super_admins.services.create', compact('tags' , 'service_categories'));
    }

    /*********Store Service  ***********/
    public function store(Request $request)
    {

        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if($request->link_type == 'internal' && $request->file_type == 'audio'){
                $data['audio'] = uploadFile($request,'file','services');
            }else{
                $data['video'] = uploadFile($request,'file','services');
            }
            $data['image'] = uploadCroppedFile($request,'image','services');
            $service = Service::create($data);
            $service->slug = Str::slug($service->name . ' ' . $service->id, '-');
            $service->save();
            $service->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.services.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.services.index')->with('message', 'Service Created Successfully')->with('message_type', 'success');
    }

    /*********View Service  ***********/
    public function show(Service $service)
    {
        return view('super_admins.services.show', compact('service'));
    }

    /*********View Edit Form of Service  ***********/
    public function edit(Service $service)
    {
        $service_categories = ServiceCategory::active()->get();
        return view('super_admins.services.edit', compact('service' , 'service_categories'));
    }

    /*********Update Service  ***********/
    public function update(Request $request, Service $service)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $service->update($data);
            $service = Service::find($service->id);
            $slug = Str::slug($service->name . ' ' . $service->id, '-');
            $service->update([
                'slug' => $slug
            ]);
            $service->tags()->sync($request->tag_ids);
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','services',$service->image);
            } else {
                $data['image'] = $service->image;
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.services.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.services.index')->with('message', 'Service Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $services = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "services." . $extension;
        return Excel::download(new TeacherServicesExport($services), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new TeacherServicesImport, $file);
        return redirect()->back()->with('message', 'Services imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Service ***********/
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->back()->with('message', 'Service Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Service ***********/
    public function destroyPermanently(Request $request,$service)
    {
        $service = Service::withTrashed()->find($service);
        if ($service) {
            if ($service->trashed()) {
                if ($service->image && file_exists(public_path($service->image))) {
                    unlink(public_path($service->image));
                }
                $service->forceDelete();
                return redirect()->back()->with('message', 'Service Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Service is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Service Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Service***********/
    public function restore(Request $request,$service)
    {
        $service = Service::withTrashed()->find($service);
        if ($service->trashed()) {
            $service->restore();
            return redirect()->back()->with('message', 'Service Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Service Not Found')->with('message_type', 'error');
        }
    }

     /*********Approve Services ***********/
     public function approve(Service $service)
     {
         if (!$service->is_approved) {
             $service->update(['is_approved' => 1, 'approved_at' => now()]);
         }
         return redirect()->back()->with('message', 'Service Approved Successfully')->with('message_type', 'success');
     }
     public function bulkActionServices(Request $request, $type)
     {
         if ($type == 'approve') {
             Service::whereIn('id', $request->selected_ids)->update([
                 'is_approved' => 1
             ]);
         } elseif ($type == 'disapprove') {
             Service::whereIn('id', $request->selected_ids)->update([
                 'is_approved' => 0
             ]);
         } elseif ($type == 'inactive') {
             Service::whereIn('id', $request->selected_ids)->update([
                 'is_active' => 0
             ]);
         } elseif ($type == 'active') {
             Service::whereIn('id', $request->selected_ids)->update([
                 'is_active' => 1
             ]);
         } elseif ($type == 'delete') {
             foreach ($request->selected_ids as $userId) {
                 $teacher = Service::where('id', $userId)->first();
                 $this->destroy($teacher);
             }
         } elseif ($type == 'feature') {
             Service::whereIn('id', $request->selected_ids)->update([
                 'is_featured' => 1
             ]);
         } else {
             Session::flash('message', 'Some Thing Went Wrong !');
             return response()->json('Success', 200);
         }
         Session::flash('message', 'Updated Successfully');
         return response()->json('Success', 200);
     }
}
