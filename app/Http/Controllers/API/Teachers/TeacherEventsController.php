<?php

namespace App\Http\Controllers\API\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Requests\API\Teachers\TeacherEvents\CreateRequest;
use App\Http\Resources\API\EventsResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeacherEventsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
        $this->middleware(['api','auth:api','verified','api_setting']);
        $this->middleware('teacher.api');
      // $this->middleware('permission:teacher_events.index');
      // $this->middleware('permission:teacher_events.create',['only' => ['store']]);
      // $this->middleware('permission:teacher_events.update',['only' => ['update']]);
      // $this->middleware('permission:teacher_events.delete',['only' => ['destroy']]);
      // $this->middleware('permission:teacher_events.export',['only' => ['export']]);
      // $this->middleware('permission:teacher_events.import',['only' => ['import']])
      // $this->middleware('permission:teacher_events.update|teacher_events.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $teacher = auth()->user()->teacher;
    if($req != null){
      $teacher_events =  $teacher->teacher_events()->withAll();
      if($req->trash && $req->trash == 'with'){
        $teacher_events =  $teacher_events->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $teacher_events =  $teacher_events->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $teacher_events = $teacher_events->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $teacher_events = $teacher_events->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $teacher_events = $teacher_events->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $teacher_events = $teacher_events->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $teacher_events = $teacher_events->get();
        return $teacher_events;
      }
      $totalTeacherCertifications = $teacher_events->count();
      $teacher_events = $teacher_events->paginate($req->perPage);
      $teacher_events = EventsResource::collection($teacher_events)->response()->getData(true);

      return $teacher_events;
    }
    $teacher_events = EventsResource::collection($teacher->teacher_events()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $teacher_events;
  }

  /********* FETCH ALL TeacherEvents ***********/
    public function index()
    {
        $teacher_events =  $this->getter();
        $response = generateResponse($teacher_events,count($teacher_events['data']) > 0 ? true:false,'TeacherEvents Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER TeacherEvents FOR Search ***********/
   public function filter(Request $request){
     $teacher_events = $this->getter($request);
     $response = generateResponse($teacher_events,count($teacher_events['data']) > 0 ? true:false,'Filter TeacherEvents Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW TeacherEvent ***********/
    public function store(CreateRequest $request)
    {
      $teacher = auth()->user()->teacher;
      try{
        DB::beginTransaction();
        $request->merge(['created_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        $data['image'] = uploadFile($request,'image','teacher_events');
        $teacher_event = $teacher->teacher_events()->create($data);
        $teacher_event->slug = Str::slug($teacher_event->name . ' ' . $teacher_event->id, '-');
        $teacher_event->save();
        $teacher_event->tags()->sync($request->tag_ids);
        DB::commit();
        $teacher_event = $teacher->teacher_posts()->withAll()->find($teacher_event->id);
        $teacher_event = new EventsResource($teacher_event);
      $response = generateResponse($teacher_event,true ,'TeacherEvents Created Successfully',null,'collection');
      return response()->json($response, 200);
    }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show(Event $teacher_event)
    {
        $teacher = auth()->user()->teacher;
        if($teacher_event->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_event = $teacher->teacher_events()->withAll()->find($teacher_event->id);
        if($teacher_event){
          $teacher_event = new EventsResource($teacher_event);
          $response = generateResponse($teacher_event,true,'TeacherEvent Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'TeacherEvent Not Found',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE TeacherEvent ***********/
    public function update(CreateRequest $request, Event $teacher_event)
    {
        // dd($request->all());
        $teacher = auth()->user()->teacher;
        if($teacher_event->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
      try{
        DB::beginTransaction();
        $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        if ($request->image) {
            $data['image'] = uploadFile($request,'image','teacher_events',$teacher_event->image);
        } else {
            $data['image'] = $teacher_event->image;
        }
        $data['slug'] = Str::slug($data['name'] . ' ' . $teacher_event->id, '-');
        $teacher_event->update($data);
        $teacher_event->tags()->sync($request->tag_ids);
        DB::commit();
        $teacher_event = $teacher->teacher_events()->withAll()->find($teacher_event->id);
        $teacher_event = new EventsResource($teacher_event);
        $response = generateResponse($teacher_event,true,'TeacherEvent Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
        catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }

    /********* UPDATE TeacherEvent Status***********/
    public function updateStatus(Request $request,Event $teacher_event){
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_event->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_event->update([
          'is_active' => $teacher_event->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'TeacherEvent Status Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }


    /********* DELETE TeacherEvent ***********/
    public function destroy(Request $request,Event $teacher_event)
    {
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_event->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
          if($teacher_event->trashed()) {
            $response = generateResponse(null,false ,'Already in Trash',null,'collection');
            return response()->json($response, 404);
          }
          else{
            $teacher_event->delete();
          }
          $response = generateResponse(null,true,'TeacherEvent Deleted Successfully',null,'object');
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /*********Permanently DELETE TeacherEvent ***********/
    public function destroyPermanently(Request $request,$teacher_event)
    {
      try{
        $teacher= auth()->user()->teacher;
        $teacher_event = $teacher->teacher_events()->withTrashed()->find($teacher_event);
        if($teacher_event){
            if($teacher_event->teacher_id != $teacher->id){
              $response = generateResponse(null,false ,'Not Found',null,'collection');
              return response()->json($response, 404);
            }
          if ($teacher_event->trashed()) {
            $teacher_event->forceDelete();
            $response = generateResponse(null,true,'TeacherEvent Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherEvent is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'TeacherEvent not found',null,'object');
        }
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /********* Restore TeacherEvent ***********/
    public function restore(Request $request,$teacher_event)
    {
      $teacher= auth()->user()->teacher;
      $teacher_event = $teacher->teacher_events()->withTrashed()->find($teacher_event);
          if ($teacher_event->trashed()) {
            $teacher_event->restore();
            $response = generateResponse(null,true,'TeacherEvent Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherEvent is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
