<?php

namespace App\Http\Controllers\API\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\API\Teachers\TeacherPosts\CreateRequest;
use App\Http\Resources\API\PostsResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeacherPostsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
        $this->middleware(['api','auth:api','verified','api_setting']);
        $this->middleware('teacher.api');
      // $this->middleware('permission:teacher_posts.index');
      // $this->middleware('permission:teacher_posts.create',['only' => ['store']]);
      // $this->middleware('permission:teacher_posts.update',['only' => ['update']]);
      // $this->middleware('permission:teacher_posts.delete',['only' => ['destroy']]);
      // $this->middleware('permission:teacher_posts.export',['only' => ['export']]);
      // $this->middleware('permission:teacher_posts.import',['only' => ['import']])
      // $this->middleware('permission:teacher_posts.update|teacher_posts.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $teacher = auth()->user()->teacher;
    if($req != null){
      $teacher_posts =  $teacher->teacher_posts()->withAll();
      if($req->trash && $req->trash == 'with'){
        $teacher_posts =  $teacher_posts->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $teacher_posts =  $teacher_posts->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $teacher_posts = $teacher_posts->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $teacher_posts = $teacher_posts->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $teacher_posts = $teacher_posts->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $teacher_posts = $teacher_posts->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $teacher_posts = $teacher_posts->get();
        return $teacher_posts;
      }
      $totalTeacherCertifications = $teacher_posts->count();
      $teacher_posts = $teacher_posts->paginate($req->perPage);
      $teacher_posts = PostsResource::collection($teacher_posts)->response()->getData(true);

      return $teacher_posts;
    }
    $teacher_posts = PostsResource::collection($teacher->teacher_posts()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $teacher_posts;
  }

  /********* FETCH ALL TeacherPosts ***********/
    public function index()
    {
        $teacher_posts =  $this->getter();
        $response = generateResponse($teacher_posts,count($teacher_posts['data']) > 0 ? true:false,'TeacherPosts Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER TeacherPosts FOR Search ***********/
   public function filter(Request $request){
     $teacher_posts = $this->getter($request);
     $response = generateResponse($teacher_posts,count($teacher_posts['data']) > 0 ? true:false,'Filter TeacherPosts Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW TeacherPost ***********/
    public function store(CreateRequest $request)
    {
      $teacher = auth()->user()->teacher;
      try{
        DB::beginTransaction();
        $request->merge(['created_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        $data['image'] = uploadCroppedFile($request,'image','teacher_posts');
        $teacher_post = $teacher->teacher_posts()->create($data);
        $teacher_post->slug = Str::slug($teacher_post->name . ' ' . $teacher_post->id, '-');
        $teacher_post->save();
        $teacher_post = $teacher->teacher_posts()->withAll()->find($teacher_post->id);
        $teacher_post = new PostsResource($teacher_post);
        DB::commit();
        $teacher_post = $teacher->teacher_posts()->withAll()->find($teacher_post->id);
        $teacher_post = new PostsResource($teacher_post);
      $response = generateResponse($teacher_post,true ,'TeacherPosts Created Successfully',null,'collection');
      return response()->json($response, 200);
    }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show(Post $teacher_post)
    {
        $teacher = auth()->user()->teacher;
        if($teacher_post->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_post = $teacher->teacher_posts()->withAll()->find($teacher_post->id);
        if($teacher_post){
          $teacher_post = new PostsResource($teacher_post);
          $response = generateResponse($teacher_post,true,'TeacherPost Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'TeacherPost Not Found',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE TeacherPost ***********/
    public function update(CreateRequest $request, Post $teacher_post)
    {
        // dd($request->all());
        $teacher = auth()->user()->teacher;
        if($teacher_post->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
      try{
        DB::beginTransaction();
        $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        if ($request->image) {
            $data['image'] = uploadCroppedFile($request,'image','teacher_posts',$teacher_post->image);
        } else {
            $data['image'] = $teacher_post->image;
        }
        $data['slug'] = Str::slug($data['name'] . ' ' . $teacher_post->id, '-');
        $teacher_post->update($data);
        $teacher_post->tags()->sync($request->tag_ids);
        DB::commit();
        $teacher_post = $teacher->teacher_posts()->withAll()->find($teacher_post->id);
        $teacher_post = new PostsResource($teacher_post);
        $response = generateResponse($teacher_post,true,'TeacherPost Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
        catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }

    /********* UPDATE TeacherPost Status***********/
    public function updateStatus(Request $request,Post $teacher_post){
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_post->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_post->update([
          'is_active' => $teacher_post->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'TeacherPost Status Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }


    /********* DELETE TeacherPost ***********/
    public function destroy(Request $request,Post $teacher_post)
    {
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_post->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
          if($teacher_post->trashed()) {
            $response = generateResponse(null,false ,'Already in Trash',null,'collection');
            return response()->json($response, 404);
          }
          else{
            $teacher_post->delete();
          }
          $response = generateResponse(null,true,'TeacherPost Deleted Successfully',null,'object');
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /*********Permanently DELETE TeacherPost ***********/
    public function destroyPermanently(Request $request,$teacher_post)
    {
      try{
        $teacher= auth()->user()->teacher;
        $teacher_post = $teacher->teacher_posts()->withTrashed()->find($teacher_post);
        if($teacher_post){
            if($teacher_post->teacher_id != $teacher->id){
              $response = generateResponse(null,false ,'Not Found',null,'collection');
              return response()->json($response, 404);
            }
          if ($teacher_post->trashed()) {
            $teacher_post->forceDelete();
            $response = generateResponse(null,true,'TeacherPost Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherPost is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'TeacherPost not found',null,'object');
        }
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /********* Restore TeacherPost ***********/
    public function restore(Request $request,$teacher_post)
    {
      $teacher= auth()->user()->teacher;
      $teacher_post = $teacher->teacher_posts()->withTrashed()->find($teacher_post);
          if ($teacher_post->trashed()) {
            $teacher_post->restore();
            $response = generateResponse(null,true,'TeacherPost Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherPost is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
