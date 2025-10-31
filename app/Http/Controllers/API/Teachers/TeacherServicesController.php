<?php

namespace App\Http\Controllers\API\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\API\Teachers\TeacherServices\CreateRequest;
use App\Http\Resources\API\ServicesResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeacherServicesController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
        $this->middleware(['api','auth:api','verified','api_setting']);
        $this->middleware('teacher.api');
      // $this->middleware('permission:teacher_services.index');
      // $this->middleware('permission:teacher_services.create',['only' => ['store']]);
      // $this->middleware('permission:teacher_services.update',['only' => ['update']]);
      // $this->middleware('permission:teacher_services.delete',['only' => ['destroy']]);
      // $this->middleware('permission:teacher_services.export',['only' => ['export']]);
      // $this->middleware('permission:teacher_services.import',['only' => ['import']])
      // $this->middleware('permission:teacher_services.update|teacher_services.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $teacher = auth()->user()->teacher;
    if($req != null){
      $teacher_services =  $teacher->teacher_services()->withAll();
      if($req->trash && $req->trash == 'with'){
        $teacher_services =  $teacher_services->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $teacher_services =  $teacher_services->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $teacher_services = $teacher_services->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $teacher_services = $teacher_services->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $teacher_services = $teacher_services->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $teacher_services = $teacher_services->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $teacher_services = $teacher_services->get();
        return $teacher_services;
      }
      $teacher_services = $teacher_services->paginate($req->perPage);
      $teacher_services = ServicesResource::collection($teacher_services)->response()->getData(true);

      return $teacher_services;
    }
    $teacher_services = ServicesResource::collection($teacher->teacher_services()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $teacher_services;
  }

  /********* FETCH ALL TeacherServices ***********/
    public function index()
    {
        $teacher_services =  $this->getter();
        $response = generateResponse($teacher_services,count($teacher_services['data']) > 0 ? true:false,'TeacherServices Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER TeacherServices FOR Search ***********/
   public function filter(Request $request){
     $teacher_services = $this->getter($request);
     $response = generateResponse($teacher_services,count($teacher_services['data']) > 0 ? true:false,'Filter TeacherServices Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW TeacherService ***********/
    public function store(CreateRequest $request)
    {
        $settings = generalSettings();
      $teacher = auth()->user()->teacher;
      try{
        DB::beginTransaction();
        $request->merge(['created_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        $data['image'] = uploadFile($request,'image','teacher_services');
        $data['audio'] = uploadFile($request,'audio','teacher_services');
        $data['video'] = uploadFile($request,'video','teacher_services');
        $teacher_service = $teacher->teacher_services()->create($data);
        $teacher_service->slug = Str::slug($teacher_service->name . ' ' . $teacher_service->id, '-');
        if($settings['auto_approve_teacher_service'] == 1){
            $teacher_service->is_approved = 1;
            $teacher_service->approved_at = now();
          }
        $teacher_service->save();
        $teacher_service->tags()->sync($request->tag_ids);
        DB::commit();
        $teacher_service = $teacher->teacher_services()->withAll()->find($teacher_service->id);
        $teacher_service = new ServicesResource($teacher_service);
      $response = generateResponse($teacher_service,true ,'TeacherServices Created Successfully',null,'collection');
      return response()->json($response, 200);
    }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show(Service $teacher_service)
    {
        $teacher = auth()->user()->teacher;
        if($teacher_service->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_service = $teacher->teacher_services()->withAll()->find($teacher_service->id);
        if($teacher_service){
          $teacher_service = new ServicesResource($teacher_service);
          $response = generateResponse($teacher_service,true,'TeacherService Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'TeacherService Not Found',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE TeacherService ***********/
    public function update(CreateRequest $request, Service $teacher_service)
    {
        // dd($request->all());
        $teacher = auth()->user()->teacher;
        if($teacher_service->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
      try{
        DB::beginTransaction();
        $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        if ($request->image) {
            $data['image'] = uploadFile($request,'image','teacher_services',$teacher_service->image);
        } else {
            $data['image'] = $teacher_service->image;
        }

        if ($request->audio) {
            $data['audio'] = uploadFile($request,'audio','teacher_services');
        } else {
            $data['audio'] = $teacher_service->audio;
        }

        if ($request->video) {
            $data['video'] = uploadFile($request,'video','teacher_services');
        } else {
            $data['video'] = $teacher_service->video;
        }
        $data['slug'] = Str::slug($data['name'] . ' ' . $teacher_service->id, '-');

        $teacher_service->update($data);
        $teacher_service->tags()->sync($request->tag_ids);
        DB::commit();
        $teacher_service = $teacher->teacher_services()->withAll()->find($teacher_service->id);
        $teacher_service = new ServicesResource($teacher_service);
        $response = generateResponse($teacher_service,true,'TeacherService Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
        catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }

    /********* UPDATE TeacherService Status***********/
    public function updateStatus(Request $request,Service $teacher_service){
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_service->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_service->update([
          'is_active' => $teacher_service->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'TeacherService Status Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }


    /********* DELETE TeacherService ***********/
    public function destroy(Request $request,Service $teacher_service)
    {
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_service->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
          if($teacher_service->trashed()) {
            $response = generateResponse(null,false ,'Already in Trash',null,'collection');
            return response()->json($response, 404);
          }
          else{
            $teacher_service->delete();
          }
          $response = generateResponse(null,true,'TeacherService Deleted Successfully',null,'object');
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /*********Permanently DELETE TeacherService ***********/
    public function destroyPermanently(Request $request,$teacher_service)
    {
      try{
        $teacher= auth()->user()->teacher;
        $teacher_service = $teacher->teacher_services()->withTrashed()->find($teacher_service);
        if($teacher_service){
            if($teacher_service->teacher_id != $teacher->id){
              $response = generateResponse(null,false ,'Not Found',null,'collection');
              return response()->json($response, 404);
            }
          if ($teacher_service->trashed()) {
            $teacher_service->forceDelete();
            $response = generateResponse(null,true,'TeacherService Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherService is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'TeacherService not found',null,'object');
        }
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /********* Restore TeacherService ***********/
    public function restore(Request $request,$teacher_service)
    {
      $teacher= auth()->user()->teacher;
      $teacher_service = $teacher->teacher_services()->withTrashed()->find($teacher_service);
          if ($teacher_service->trashed()) {
            $teacher_service->restore();
            $response = generateResponse(null,true,'TeacherService Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherService is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
