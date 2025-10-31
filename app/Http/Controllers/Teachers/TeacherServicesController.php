<?php

namespace App\Http\Controllers\Teachers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\Teachers\TeacherServices\CreateRequest;
use App\Http\Resources\Web\ServicesResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeacherServicesController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
    //   $this->middleware('auth');
    //   $this->middleware('teacher');
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
      $totalTeacherServices = $teacher_services->count();
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

    /********* ADD NEW TeacherServices ***********/
    public function store(CreateRequest $request)
    {
        $settings = generalSettings();
      $teacher = auth()->user()->teacher;
      try{
      DB::beginTransaction();
      $request->merge(['created_by_user_id'=>auth()->user()->id]);
      $data = $request->all();
      $data['image'] = uploadCroppedFile($request,'image','teacher_services');
      $data['audio'] = uploadFile($request,'audio','teacher_services');
      $data['video'] = uploadFile($request,'video','teacher_services');
      $teacher_service = $teacher->teacher_services()->create($data);
      if((int)$settings['auto_approve_teacher_service']){
        $teacher_service->is_approved = 1;
        $teacher_service->approved_at = now();
      }
      $teacher_service->slug = Str::slug($teacher_service->name . ' ' . $teacher_service->id, '-');
      $teacher_service->save();
      $teacher_service = $teacher->teacher_services()->withAll()->find($teacher_service->id);
      $teacher_service = new ServicesResource($teacher_service);
      $teacher_service->tags()->sync($request->tag_ids);
      if($request->faqs){
        $teacher_service->faqs()->createMany($request->faqs);
      }
      DB::commit();
    }
      catch (\Exception $e) {
        DB::rollBack();
        request()->session()->flash('alert',['message' => $e->getMessage(),'type' => 'error']);
     }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $teacher_service)
    {
        $teacher = auth()->user()->teacher;
        if($teacher_service->teacher_id != $teacher->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $teacher_service = $teacher->teacher_services()->withAll()->find($teacher_service);
        if($teacher_service){
          $teacher_service = new ServicesResource($teacher_service);
          $response = generateResponse($teacher_service,true,'TeacherServices Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'TeacherServices Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE TeacherServices ***********/
    public function update(CreateRequest $request, Service $teacher_service)
    {
        // dd($request->all());
        $teacher = auth()->user()->teacher;
        if($teacher_service->teacher_id != $teacher->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
      try{
        DB::beginTransaction();
        $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        if ($request->image) {
            $data['image'] = uploadCroppedFile($request,'image','teacher_services',$teacher_service->image);
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
        $teacher_service->update($data);
        $teacher_service = $teacher_service->find($teacher_service->id);
        $slug = Str::slug($teacher_service['name'] . ' ' . $teacher_service->id, '-');
        $teacher_service->update(
            [
                'slug' => $slug
            ]
        );
        $teacher_service->tags()->sync($request->tag_ids);
        if($request->faqs){
            $teacher_service->faqs()->delete();
            $teacher_service->faqs()->createMany($request->faqs);
          }
        DB::commit();
      }
        catch (\Exception $e) {
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
       }
       return redirect()->back();
    }

    /********* UPDATE TeacherServices Status***********/
    public function updateStatus(Request $request,Service $teacher_service){
        $teacher = auth()->user()->teacher;
        if($teacher_service->teacher_id != $teacher->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $teacher_service->update([
          'is_active' => $teacher_service->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'TeacherServices Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE TeacherServices ***********/
    public function destroy(Request $request,Service $teacher_service)
    {
        $teacher = auth()->user()->teacher;
        if($teacher_service->teacher_id != $teacher->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($teacher_service->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            $teacher_service->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE TeacherServices ***********/
    public function destroyPermanently(Request $request,$teacher_service)
    {
        $teacher= auth()->user()->teacher;
        $teacher_service = $teacher->teacher_services()->withTrashed()->find($teacher_service);
        if($teacher_service){
            if($teacher_service->teacher_id != $teacher->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
          if ($teacher_service->trashed()) {
            $teacher_service->forceDelete();
            $response = generateResponse(null,true,'TeacherServices Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherServices is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'TeacherServices not found',null,'object');
        }
          return response()->json($response, 200);
    }
    /********* Restore TeacherServices ***********/
    public function restore(Request $request,$teacher_service)
    {
      $teacher= auth()->user()->teacher;
      $teacher_service = $teacher->teacher_services()->withTrashed()->find($teacher_service);
          if ($teacher_service->trashed()) {
            $teacher_service->restore();
            $response = generateResponse(null,true,'TeacherServices Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherServices is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
