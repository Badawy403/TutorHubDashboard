<?php

namespace App\Http\Controllers\API\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Broadcast;
use App\Http\Requests\API\Teachers\TeacherBroadcasts\CreateRequest;
use App\Http\Resources\API\BroadcastsResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeacherBroadcastsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
        $this->middleware(['api','auth:api','verified','api_setting']);
        $this->middleware('teacher.api');
      // $this->middleware('permission:teacher_broadcasts.index');
      // $this->middleware('permission:teacher_broadcasts.create',['only' => ['store']]);
      // $this->middleware('permission:teacher_broadcasts.update',['only' => ['update']]);
      // $this->middleware('permission:teacher_broadcasts.delete',['only' => ['destroy']]);
      // $this->middleware('permission:teacher_broadcasts.export',['only' => ['export']]);
      // $this->middleware('permission:teacher_broadcasts.import',['only' => ['import']])
      // $this->middleware('permission:teacher_broadcasts.update|teacher_broadcasts.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $teacher = auth()->user()->teacher;
    if($req != null){
      $teacher_broadcasts =  $teacher->teacher_broadcasts()->withAll();
      if($req->trash && $req->trash == 'with'){
        $teacher_broadcasts =  $teacher_broadcasts->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $teacher_broadcasts =  $teacher_broadcasts->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $teacher_broadcasts = $teacher_broadcasts->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $teacher_broadcasts = $teacher_broadcasts->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $teacher_broadcasts = $teacher_broadcasts->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $teacher_broadcasts = $teacher_broadcasts->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $teacher_broadcasts = $teacher_broadcasts->get();
        return $teacher_broadcasts;
      }
      $totalTeacherCertifications = $teacher_broadcasts->count();
      $teacher_broadcasts = $teacher_broadcasts->paginate($req->perPage);
      $teacher_broadcasts = BroadcastsResource::collection($teacher_broadcasts)->response()->getData(true);

      return $teacher_broadcasts;
    }
    $teacher_broadcasts = BroadcastsResource::collection($teacher->teacher_broadcasts()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $teacher_broadcasts;
  }

  /********* FETCH ALL TeacherCertifications ***********/
    public function index()
    {
        $teacher_broadcasts =  $this->getter();
        $response = generateResponse($teacher_broadcasts,count($teacher_broadcasts['data']) > 0 ? true:false,'TeacherCertifications Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER TeacherCertifications FOR Search ***********/
   public function filter(Request $request){
     $teacher_broadcasts = $this->getter($request);
     $response = generateResponse($teacher_broadcasts,count($teacher_broadcasts['data']) > 0 ? true:false,'Filter TeacherCertifications Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW TeacherMedia ***********/
    public function store(CreateRequest $request)
    {
      $teacher = auth()->user()->teacher;
      try{
        DB::beginTransaction();
        $request->merge(['created_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        $data['image'] = uploadFile($request,'image','teacher_broadcasts');
        $data['audio'] = uploadFile($request,'audio','teacher_broadcasts');
        $data['video'] = uploadFile($request,'video','teacher_broadcasts');
        $teacher_broadcast = $teacher->teacher_broadcasts()->create($data);
        $teacher_broadcast->slug = Str::slug($teacher_broadcast->name . ' ' . $teacher_broadcast->id, '-');
        $teacher_broadcast->save();
        $teacher_broadcast->tags()->sync($request->tag_ids);
        DB::commit();
        $teacher_broadcast = $teacher->teacher_broadcasts()->withAll()->find($teacher_broadcast->id);
        $teacher_broadcast = new BroadcastsResource($teacher_broadcast);
      $response = generateResponse($teacher_broadcast,true ,'TeacherCertifications Created Successfully',null,'collection');
      return response()->json($response, 200);
    }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show(Broadcast $teacher_broadcast)
    {
        $teacher = auth()->user()->teacher;
        if($teacher_broadcast->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_broadcast = $teacher->teacher_broadcasts()->withAll()->find($teacher_broadcast->id);
        if($teacher_broadcast){
          $teacher_broadcast = new BroadcastsResource($teacher_broadcast);
          $response = generateResponse($teacher_broadcast,true,'TeacherMedia Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'TeacherMedia Not Found',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE TeacherMedia ***********/
    public function update(CreateRequest $request, Broadcast $teacher_broadcast)
    {
        // dd($request->all());
        $teacher = auth()->user()->teacher;
        if($teacher_broadcast->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
      try{
        DB::beginTransaction();
        $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        if ($request->image) {
            $data['image'] = uploadFile($request,'image','teacher_broadcasts',$teacher_broadcast->image);
        } else {
            $data['image'] = $teacher_broadcast->image;
        }

        if ($request->audio) {
            $data['audio'] = uploadFile($request,'audio','teacher_broadcasts');
        } else {
            $data['audio'] = $teacher_broadcast->audio;
        }

        if ($request->video) {
            $data['video'] = uploadFile($request,'video','teacher_broadcasts');
        } else {
            $data['video'] = $teacher_broadcast->video;
        }
        $data['slug'] = Str::slug($data['name'] . ' ' . $teacher_broadcast->id, '-');
        $teacher_broadcast->update($data);
         $teacher_broadcast->tags()->sync($request->tag_ids);
        DB::commit();
        $teacher_broadcast = $teacher->teacher_broadcasts()->withAll()->find($teacher_broadcast->id);
        $teacher_broadcast = new BroadcastsResource($teacher_broadcast);
        $response = generateResponse($teacher_broadcast,true,'TeacherMedia Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
        catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }

    /********* UPDATE TeacherMedia Status***********/
    public function updateStatus(Request $request,Broadcast $teacher_broadcast){
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_broadcast->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_broadcast->update([
          'is_active' => $teacher_broadcast->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'TeacherMedia Status Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }


    /********* DELETE TeacherMedia ***********/
    public function destroy(Request $request,Broadcast $teacher_broadcast)
    {
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_broadcast->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
          if($teacher_broadcast->trashed()) {
            $response = generateResponse(null,false ,'Already in Trash',null,'collection');
            return response()->json($response, 404);
          }
          else{
            $teacher_broadcast->delete();
          }
          $response = generateResponse(null,true,'TeacherMedia Deleted Successfully',null,'object');
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /*********Permanently DELETE TeacherMedia ***********/
    public function destroyPermanently(Request $request,$teacher_broadcast)
    {
      try{
        $teacher= auth()->user()->teacher;
        $teacher_broadcast = $teacher->teacher_broadcasts()->withTrashed()->find($teacher_broadcast);
        if($teacher_broadcast){
            if($teacher_broadcast->teacher_id != $teacher->id){
              $response = generateResponse(null,false ,'Not Found',null,'collection');
              return response()->json($response, 404);
            }
          if ($teacher_broadcast->trashed()) {
            $teacher_broadcast->forceDelete();
            $response = generateResponse(null,true,'TeacherMedia Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherMedia is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'TeacherMedia not found',null,'object');
        }
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /********* Restore TeacherMedia ***********/
    public function restore(Request $request,$teacher_broadcast)
    {
      $teacher= auth()->user()->teacher;
      $teacher_broadcast = $teacher->teacher_broadcasts()->withTrashed()->find($teacher_broadcast);
          if ($teacher_broadcast->trashed()) {
            $teacher_broadcast->restore();
            $response = generateResponse(null,true,'TeacherMedia Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherMedia is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
