<?php

namespace App\Http\Controllers\Teachers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Broadcast;
use App\Http\Requests\Teachers\TeacherBroadcasts\CreateRequest;
use App\Http\Resources\Web\BroadcastsResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeacherBroadcastsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('teacher');
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
      $totalTeacherBroadcasts = $teacher_broadcasts->count();
      $teacher_broadcasts = $teacher_broadcasts->paginate($req->perPage);
      $teacher_broadcasts = BroadcastsResource::collection($teacher_broadcasts)->response()->getData(true);

      return $teacher_broadcasts;
    }
    $teacher_broadcasts = BroadcastsResource::collection($teacher->teacher_broadcasts()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $teacher_broadcasts;
  }

  /********* FETCH ALL TeacherBroadcasts ***********/
    public function index()
    {
        $teacher_broadcasts =  $this->getter();
        $response = generateResponse($teacher_broadcasts,count($teacher_broadcasts['data']) > 0 ? true:false,'TeacherBroadcasts Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER TeacherBroadcasts FOR Search ***********/
   public function filter(Request $request){
     $teacher_broadcasts = $this->getter($request);
     $response = generateResponse($teacher_broadcasts,count($teacher_broadcasts['data']) > 0 ? true:false,'Filter TeacherBroadcasts Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW TeacherBroadcast ***********/
    public function store(CreateRequest $request)
    {
      $teacher = auth()->user()->teacher;
      try{
      DB::beginTransaction();
      $request->merge(['created_by_user_id'=>auth()->user()->id]);
      $data = $request->all();
      $data['image'] = uploadCroppedFile($request,'image','teacher_broadcasts');
      $data['audio'] = uploadFile($request,'audio','teacher_broadcasts');
      $data['video'] = uploadFile($request,'video','teacher_broadcasts');
      $teacher_broadcast = $teacher->teacher_broadcasts()->create($data);
      $teacher_broadcast->slug = Str::slug($teacher_broadcast->name . ' ' . $teacher_broadcast->id, '-');
      $teacher_broadcast->save();
      $teacher_broadcast->tags()->sync($request->tag_ids);
      $teacher_broadcast = $teacher->teacher_broadcasts()->withAll()->find($teacher_broadcast->id);
      $teacher_broadcast = new BroadcastsResource($teacher_broadcast);
      DB::commit();
    }
      catch (\Exception $e) {
        dd($e->getMessage());
        DB::rollBack();
        request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
     }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $teacher_broadcast)
    {
        $teacher = auth()->user()->teacher;
        if($teacher_broadcast->teacher_id != $teacher->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $teacher_broadcast = $teacher->teacher_broadcasts()->withAll()->find($teacher_broadcast);
        if($teacher_broadcast){
          $teacher_broadcast = new BroadcastsResource($teacher_broadcast);
          $response = generateResponse($teacher_broadcast,true,'TeacherBroadcast Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'TeacherBroadcast Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE TeacherBroadcast ***********/
    public function update(CreateRequest $request, Broadcast $teacher_broadcast)
    {
        // dd($request->all());
        $teacher = auth()->user()->teacher;
        if($teacher_broadcast->teacher_id != $teacher->id){
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
            $data['image'] = uploadCroppedFile($request,'image','teacher_broadcasts',$teacher_broadcast->image);
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
        $teacher_broadcast->update($data);
        $teacher_broadcast = Broadcast::find($teacher_broadcast->id);
        $slug = Str::slug($teacher_broadcast->name . ' ' . $teacher_broadcast->id, '-');
        $teacher_broadcast->update([
            'slug' => $slug
        ]);
         $teacher_broadcast->tags()->sync($request->tag_ids);
        DB::commit();
      }
        catch (\Exception $e) {
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
       }
       return redirect()->back();
    }

    /********* UPDATE TeacherBroadcast Status***********/
    public function updateStatus(Request $request,Broadcast $teacher_broadcast){
        $teacher = auth()->user()->teacher;
        if($teacher_broadcast->teacher_id != $teacher->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $teacher_broadcast->update([
          'is_active' => $teacher_broadcast->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'TeacherBroadcast Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE TeacherBroadcast ***********/
    public function destroy(Request $request,Broadcast $teacher_broadcast)
    {
        $teacher = auth()->user()->teacher;
        if($teacher_broadcast->teacher_id != $teacher->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($teacher_broadcast->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            $teacher_broadcast->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE TeacherBroadcast ***********/
    public function destroyPermanently(Request $request,$teacher_broadcast)
    {
        $teacher= auth()->user()->teacher;
        $teacher_broadcast = $teacher->teacher_broadcasts()->withTrashed()->find($teacher_broadcast);
        if($teacher_broadcast){
            if($teacher_broadcast->teacher_id != $teacher->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
          if ($teacher_broadcast->trashed()) {
            $teacher_broadcast->forceDelete();
            $response = generateResponse(null,true,'TeacherBroadcast Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherBroadcast is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'TeacherBroadcast not found',null,'object');
        }
          return response()->json($response, 200);
    }
    /********* Restore TeacherBroadcast ***********/
    public function restore(Request $request,$teacher_broadcast)
    {
      $teacher= auth()->user()->teacher;
      $teacher_broadcast = $teacher->teacher_broadcasts()->withTrashed()->find($teacher_broadcast);
          if ($teacher_broadcast->trashed()) {
            $teacher_broadcast->restore();
            $response = generateResponse(null,true,'TeacherBroadcast Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherBroadcast is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
