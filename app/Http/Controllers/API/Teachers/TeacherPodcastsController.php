<?php

namespace App\Http\Controllers\API\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Podcast;
use App\Http\Requests\API\Teachers\TeacherPodcasts\CreateRequest;
use App\Http\Resources\API\PodcastsResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeacherPodcastsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
        $this->middleware(['api','auth:api','verified','api_setting']);
        $this->middleware('teacher.api');
      // $this->middleware('permission:teacher_podcasts.index');
      // $this->middleware('permission:teacher_podcasts.create',['only' => ['store']]);
      // $this->middleware('permission:teacher_podcasts.update',['only' => ['update']]);
      // $this->middleware('permission:teacher_podcasts.delete',['only' => ['destroy']]);
      // $this->middleware('permission:teacher_podcasts.export',['only' => ['export']]);
      // $this->middleware('permission:teacher_podcasts.import',['only' => ['import']])
      // $this->middleware('permission:teacher_podcasts.update|teacher_podcasts.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $teacher = auth()->user()->teacher;
    if($req != null){
      $teacher_podcasts =  $teacher->teacher_podcasts()->withAll();
      if($req->trash && $req->trash == 'with'){
        $teacher_podcasts =  $teacher_podcasts->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $teacher_podcasts =  $teacher_podcasts->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $teacher_podcasts = $teacher_podcasts->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $teacher_podcasts = $teacher_podcasts->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $teacher_podcasts = $teacher_podcasts->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $teacher_podcasts = $teacher_podcasts->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $teacher_podcasts = $teacher_podcasts->get();
        return $teacher_podcasts;
      }
      $totalTeacherCertifications = $teacher_podcasts->count();
      $teacher_podcasts = $teacher_podcasts->paginate($req->perPage);
      $teacher_podcasts = PodcastsResource::collection($teacher_podcasts)->response()->getData(true);

      return $teacher_podcasts;
    }
    $teacher_podcasts = PodcastsResource::collection($teacher->teacher_podcasts()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $teacher_podcasts;
  }

  /********* FETCH ALL TeacherPodcasts ***********/
    public function index()
    {
        $teacher_podcasts =  $this->getter();
        $response = generateResponse($teacher_podcasts,count($teacher_podcasts['data']) > 0 ? true:false,'TeacherPodcasts Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER TeacherPodcasts FOR Search ***********/
   public function filter(Request $request){
     $teacher_podcasts = $this->getter($request);
     $response = generateResponse($teacher_podcasts,count($teacher_podcasts['data']) > 0 ? true:false,'Filter TeacherPodcasts Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW TeacherPodcast ***********/
    public function store(CreateRequest $request)
    {
      $teacher = auth()->user()->teacher;
      try{
        DB::beginTransaction();
        $request->merge(['created_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        $data['image'] = uploadFile($request,'image','teacher_podcasts');
        $data['audio'] = uploadFile($request,'audio','teacher_podcasts');
        $data['video'] = uploadFile($request,'video','teacher_podcasts');
        $teacher_podcast = $teacher->teacher_podcasts()->create($data);
        $teacher_podcast->slug = Str::slug($teacher_podcast->name . ' ' . $teacher_podcast->id, '-');
        $teacher_podcast->save();
        $teacher_podcast->tags()->sync($request->tag_ids);
        DB::commit();
        $teacher_podcast = $teacher->teacher_podcasts()->withAll()->find($teacher_podcast->id);
        $teacher_podcast = new PodcastsResource($teacher_podcast);
      $response = generateResponse($teacher_podcast,true ,'TeacherPodcasts Created Successfully',null,'collection');
      return response()->json($response, 200);
    }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show(Podcast $teacher_podcast)
    {
        $teacher = auth()->user()->teacher;
        if($teacher_podcast->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_podcast = $teacher->teacher_podcasts()->withAll()->find($teacher_podcast->id);
        if($teacher_podcast){
          $teacher_podcast = new PodcastsResource($teacher_podcast);
          $response = generateResponse($teacher_podcast,true,'TeacherPodcast Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'TeacherPodcast Not Found',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE TeacherPodcast ***********/
    public function update(CreateRequest $request, Podcast $teacher_podcast)
    {
        // dd($request->all());
        $teacher = auth()->user()->teacher;
        if($teacher_podcast->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
      try{
        DB::beginTransaction();
        $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        if ($request->image) {
            $data['image'] = uploadFile($request,'image','teacher_podcasts',$teacher_podcast->image);
        } else {
            $data['image'] = $teacher_podcast->image;
        }

        if ($request->audio) {
            $data['audio'] = uploadFile($request,'audio','teacher_podcasts');
        } else {
            $data['audio'] = $teacher_podcast->audio;
        }

        if ($request->video) {
            $data['video'] = uploadFile($request,'video','teacher_podcasts');
        } else {
            $data['video'] = $teacher_podcast->video;
        }
        $data['slug'] = Str::slug($data['name'] . ' ' . $teacher_podcast->id, '-');

        $teacher_podcast->update($data);
        $teacher_podcast->tags()->sync($request->tag_ids);
        DB::commit();
        $teacher_podcast = $teacher->teacher_podcasts()->withAll()->find($teacher_podcast->id);
        $teacher_podcast = new PodcastsResource($teacher_podcast);
        $response = generateResponse($teacher_podcast,true,'TeacherPodcast Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
        catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }

    /********* UPDATE TeacherPodcast Status***********/
    public function updateStatus(Request $request,Podcast $teacher_podcast){
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_podcast->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_podcast->update([
          'is_active' => $teacher_podcast->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'TeacherPodcast Status Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }


    /********* DELETE TeacherPodcast ***********/
    public function destroy(Request $request,Podcast $teacher_podcast)
    {
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_podcast->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
          if($teacher_podcast->trashed()) {
            $response = generateResponse(null,false ,'Already in Trash',null,'collection');
            return response()->json($response, 404);
          }
          else{
            $teacher_podcast->delete();
          }
          $response = generateResponse(null,true,'TeacherPodcast Deleted Successfully',null,'object');
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /*********Permanently DELETE TeacherPodcast ***********/
    public function destroyPermanently(Request $request,$teacher_podcast)
    {
      try{
        $teacher= auth()->user()->teacher;
        $teacher_podcast = $teacher->teacher_podcasts()->withTrashed()->find($teacher_podcast);
        if($teacher_podcast){
            if($teacher_podcast->teacher_id != $teacher->id){
              $response = generateResponse(null,false ,'Not Found',null,'collection');
              return response()->json($response, 404);
            }
          if ($teacher_podcast->trashed()) {
            $teacher_podcast->forceDelete();
            $response = generateResponse(null,true,'TeacherPodcast Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherPodcast is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'TeacherPodcast not found',null,'object');
        }
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /********* Restore TeacherPodcast ***********/
    public function restore(Request $request,$teacher_podcast)
    {
      $teacher= auth()->user()->teacher;
      $teacher_podcast = $teacher->teacher_podcasts()->withTrashed()->find($teacher_podcast);
          if ($teacher_podcast->trashed()) {
            $teacher_podcast->restore();
            $response = generateResponse(null,true,'TeacherPodcast Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherPodcast is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
