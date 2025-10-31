<?php

namespace App\Http\Controllers\API\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archive;
use App\Http\Requests\API\Teachers\TeacherArchives\CreateRequest;
use App\Http\Resources\API\ArchivesResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeacherArchivesController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
        $this->middleware(['api','auth:api','verified','api_setting']);
        $this->middleware('teacher.api');
      // $this->middleware('permission:teacher_archives.index');
      // $this->middleware('permission:teacher_archives.create',['only' => ['store']]);
      // $this->middleware('permission:teacher_archives.update',['only' => ['update']]);
      // $this->middleware('permission:teacher_archives.delete',['only' => ['destroy']]);
      // $this->middleware('permission:teacher_archives.export',['only' => ['export']]);
      // $this->middleware('permission:teacher_archives.import',['only' => ['import']])
      // $this->middleware('permission:teacher_archives.update|teacher_archives.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $teacher = auth()->user()->teacher;
    if($req != null){
      $teacher_archives =  $teacher->teacher_archives()->withAll();
      if($req->trash && $req->trash == 'with'){
        $teacher_archives =  $teacher_archives->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $teacher_archives =  $teacher_archives->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $teacher_archives = $teacher_archives->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $teacher_archives = $teacher_archives->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $teacher_archives = $teacher_archives->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $teacher_archives = $teacher_archives->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $teacher_archives = $teacher_archives->get();
        return $teacher_archives;
      }
      $totalTeacherCertifications = $teacher_archives->count();
      $teacher_archives = $teacher_archives->paginate($req->perPage);
      $teacher_archives = ArchivesResource::collection($teacher_archives)->response()->getData(true);

      return $teacher_archives;
    }
    $teacher_archives = ArchivesResource::collection($teacher->teacher_archives()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $teacher_archives;
  }

  /********* FETCH ALL TeacherArchives ***********/
    public function index()
    {
        $teacher_archives =  $this->getter();
        $response = generateResponse($teacher_archives,count($teacher_archives['data']) > 0 ? true:false,'TeacherArchives Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER TeacherArchives FOR Search ***********/
   public function filter(Request $request){
     $teacher_archives = $this->getter($request);
     $response = generateResponse($teacher_archives,count($teacher_archives['data']) > 0 ? true:false,'Filter TeacherArchives Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW TeacherArchive ***********/
    public function store(CreateRequest $request)
    {
      $teacher = auth()->user()->teacher;
      try{
        DB::beginTransaction();
        $request->merge(['created_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        $data['image'] = uploadCroppedFile($request,'image','teacher_archives');
        $teacher_archive = $teacher->teacher_archives()->create($data);
        $teacher_archive->slug = Str::slug($teacher_archive->name . ' ' . $teacher_archive->id, '-');
        $teacher_archive->tags()->sync($request->tag_ids);
        $teacher_archive->save();
        DB::commit();
        $teacher_archive = $teacher->teacher_archives()->withAll()->find($teacher_archive->id);
        $teacher_archive = new ArchivesResource($teacher_archive);
      $response = generateResponse($teacher_archive,true ,'TeacherArchives Created Successfully',null,'collection');
      return response()->json($response, 200);
    }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show(Archive $teacher_archive)
    {
        $teacher = auth()->user()->teacher;
        if($teacher_archive->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_archive = $teacher->teacher_archives()->withAll()->find($teacher_archive->id);
        if($teacher_archive){
          $teacher_archive = new ArchivesResource($teacher_archive);
          $response = generateResponse($teacher_archive,true,'TeacherArchive Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'TeacherArchive Not Found',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE TeacherArchive ***********/
    public function update(CreateRequest $request, Archive $teacher_archive)
    {
        // dd($request->all());
        $teacher = auth()->user()->teacher;
        if($teacher_archive->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
      try{
        DB::beginTransaction();
        $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        if ($request->image) {
            $data['image'] = uploadCroppedFile($request,'image','teacher_archives',$teacher_archive->image);
        } else {
            $data['image'] = $teacher_archive->image;
        }
        $data['slug'] = Str::slug($data['name'] . ' ' . $teacher_archive->id, '-');
        $teacher_archive->update($data);
        $teacher_archive->tags()->sync($request->tag_ids);
        DB::commit();
        $teacher_archive = $teacher->teacher_archives()->withAll()->find($teacher_archive->id);
        $teacher_archive = new ArchivesResource($teacher_archive);
        $response = generateResponse($teacher_archive,true,'TeacherArchive Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
        catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }

    /********* UPDATE TeacherArchive Status***********/
    public function updateStatus(Request $request,Archive $teacher_archive){
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_archive->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_archive->update([
          'is_active' => $teacher_archive->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'TeacherArchive Status Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }


    /********* DELETE TeacherArchive ***********/
    public function destroy(Request $request,Archive $teacher_archive)
    {
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_archive->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
          if($teacher_archive->trashed()) {
            $response = generateResponse(null,false ,'Already in Trash',null,'collection');
            return response()->json($response, 404);
          }
          else{
            $teacher_archive->delete();
          }
          $response = generateResponse(null,true,'TeacherArchive Deleted Successfully',null,'object');
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /*********Permanently DELETE TeacherArchive ***********/
    public function destroyPermanently(Request $request,$teacher_archive)
    {
      try{
        $teacher= auth()->user()->teacher;
        $teacher_archive = $teacher->teacher_archives()->withTrashed()->find($teacher_archive);
        if($teacher_archive){
            if($teacher_archive->teacher_id != $teacher->id){
              $response = generateResponse(null,false ,'Not Found',null,'collection');
              return response()->json($response, 404);
            }
          if ($teacher_archive->trashed()) {
            $teacher_archive->forceDelete();
            $response = generateResponse(null,true,'TeacherArchive Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherArchive is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'TeacherArchive not found',null,'object');
        }
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /********* Restore TeacherArchive ***********/
    public function restore(Request $request,$teacher_archive)
    {
      $teacher= auth()->user()->teacher;
      $teacher_archive = $teacher->teacher_archives()->withTrashed()->find($teacher_archive);
          if ($teacher_archive->trashed()) {
            $teacher_archive->restore();
            $response = generateResponse(null,true,'TeacherArchive Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherArchive is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
