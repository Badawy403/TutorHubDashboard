<?php

namespace App\Http\Controllers\Academies;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Podcast;
use App\Http\Requests\Academies\AcademyPodcasts\CreateRequest;
use App\Http\Resources\Web\PodcastsResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AcademyPodcastsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('academy');
      // $this->middleware('permission:academy_podcasts.index');
      // $this->middleware('permission:academy_podcasts.create',['only' => ['store']]);
      // $this->middleware('permission:academy_podcasts.update',['only' => ['update']]);
      // $this->middleware('permission:academy_podcasts.delete',['only' => ['destroy']]);
      // $this->middleware('permission:academy_podcasts.export',['only' => ['export']]);
      // $this->middleware('permission:academy_podcasts.import',['only' => ['import']])
      // $this->middleware('permission:academy_podcasts.update|academy_podcasts.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $academy = auth()->user()->academy;
    if($req != null){
      $academy_podcasts =  $academy->academy_podcasts()->withAll();
      if($req->trash && $req->trash == 'with'){
        $academy_podcasts =  $academy_podcasts->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $academy_podcasts =  $academy_podcasts->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $academy_podcasts = $academy_podcasts->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $academy_podcasts = $academy_podcasts->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $academy_podcasts = $academy_podcasts->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $academy_podcasts = $academy_podcasts->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $academy_podcasts = $academy_podcasts->get();
        return $academy_podcasts;
      }
      $totalAcademyPodcasts = $academy_podcasts->count();
      $academy_podcasts = $academy_podcasts->paginate($req->perPage);
      $academy_podcasts = PodcastsResource::collection($academy_podcasts)->response()->getData(true);

      return $academy_podcasts;
    }
    $academy_podcasts = PodcastsResource::collection($academy->academy_podcasts()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $academy_podcasts;
  }

  /********* FETCH ALL AcademyPodcasts ***********/
    public function index()
    {
        $academy_podcasts =  $this->getter();
        $response = generateResponse($academy_podcasts,count($academy_podcasts['data']) > 0 ? true:false,'AcademyPodcasts Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER AcademyPodcasts FOR Search ***********/
   public function filter(Request $request){
     $academy_podcasts = $this->getter($request);
     $response = generateResponse($academy_podcasts,count($academy_podcasts['data']) > 0 ? true:false,'Filter AcademyPodcasts Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW AcademyPodcast ***********/
    public function store(CreateRequest $request)
    {
      $academy = auth()->user()->academy;
      try{
      DB::beginTransaction();
      $request->merge(['created_by_user_id'=>auth()->user()->id]);
      $data = $request->all();
      $data['image'] = uploadCroppedFile($request,'image','academy_podcasts');
      $data['audio'] = uploadFile($request,'audio','academy_podcasts');
      $data['video'] = uploadFile($request,'video','academy_podcasts');
      $academy_podcast = $academy->academy_podcasts()->create($data);
      $academy_podcast->slug = Str::slug($academy_podcast->name . ' ' . $academy_podcast->id, '-');
      $academy_podcast->save();
      $academy_podcast = $academy->academy_podcasts()->withAll()->find($academy_podcast->id);
      $academy_podcast = new PodcastsResource($academy_podcast);
      $academy_podcast->tags()->sync($request->tag_ids);
      DB::commit();
    }
      catch (\Exception $e) {
        DB::rollBack();
        request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
     }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $academy_podcast)
    {
        $academy = auth()->user()->academy;
        if($academy_podcast->academy_id != $academy->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $academy_podcast = $academy->academy_podcasts()->withAll()->find($academy_podcast);
        if($academy_podcast){
          $academy_podcast = new PodcastsResource($academy_podcast);
          $response = generateResponse($academy_podcast,true,'AcademyPodcast Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'AcademyPodcast Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE AcademyPodcast ***********/
    public function update(CreateRequest $request, Podcast $academy_podcast)
    {
        // dd($request->all());
        $academy = auth()->user()->academy;
        if($academy_podcast->academy_id != $academy->id){
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
            $data['image'] = uploadCroppedFile($request,'image','academy_podcasts',$academy_podcast->image);
        } else {
            $data['image'] = $academy_podcast->image;
        }

        if ($request->audio) {
            $data['audio'] = uploadFile($request,'audio','academy_podcasts');
        } else {
            $data['audio'] = $academy_podcast->audio;
        }

        if ($request->video) {
            $data['video'] = uploadFile($request,'video','academy_podcasts');
        } else {
            $data['video'] = $academy_podcast->video;
        }
        $academy_podcast->update($data);
        $academy_podcast = $academy_podcast->find($academy_podcast->id);
        $slug = Str::slug($academy_podcast['name'] . ' ' . $academy_podcast->id, '-');
        $academy_podcast->update(
            [
                'slug' => $slug
            ]
        );
        $academy_podcast->tags()->sync($request->tag_ids);
        DB::commit();
      }
        catch (\Exception $e) {
            dd($e->getMessage());
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
       }
       return redirect()->back();
    }

    /********* UPDATE AcademyPodcast Status***********/
    public function updateStatus(Request $request,Podcast $academy_podcast){
        $academy = auth()->user()->academy;
        if($academy_podcast->academy_id != $academy->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $academy_podcast->update([
          'is_active' => $academy_podcast->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'AcademyPodcast Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE AcademyPodcast ***********/
    public function destroy(Request $request,Podcast $academy_podcast)
    {
        $academy = auth()->user()->academy;
        if($academy_podcast->academy_id != $academy->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($academy_podcast->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            $academy_podcast->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE AcademyPodcast ***********/
    public function destroyPermanently(Request $request,$academy_podcast)
    {
        $academy= auth()->user()->academy;
        $academy_podcast = $academy->academy_podcasts()->withTrashed()->find($academy_podcast);
        if($academy_podcast){
            if($academy_podcast->academy_id != $academy->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
          if ($academy_podcast->trashed()) {
            $academy_podcast->forceDelete();
            $response = generateResponse(null,true,'AcademyPodcast Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'AcademyPodcast is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'AcademyPodcast not found',null,'object');
        }
          return response()->json($response, 200);
    }
    /********* Restore AcademyPodcast ***********/
    public function restore(Request $request,$academy_podcast)
    {
      $academy= auth()->user()->academy;
      $academy_podcast = $academy->academy_podcasts()->withTrashed()->find($academy_podcast);
          if ($academy_podcast->trashed()) {
            $academy_podcast->restore();
            $response = generateResponse(null,true,'AcademyPodcast Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'AcademyPodcast is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
