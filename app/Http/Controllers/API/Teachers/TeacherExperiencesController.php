<?php

namespace App\Http\Controllers\API\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeacherExperience;
use App\Http\Requests\API\Teachers\TeacherExperiences\CreateRequest;
use App\Http\Resources\API\TeacherExperiencesResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeacherExperiencesController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
        $this->middleware(['api','auth:api','verified','api_setting']);
        $this->middleware('teacher.api');
      // $this->middleware('permission:teacher_experiences.index');
      // $this->middleware('permission:teacher_experiences.create',['only' => ['store']]);
      // $this->middleware('permission:teacher_experiences.update',['only' => ['update']]);
      // $this->middleware('permission:teacher_experiences.delete',['only' => ['destroy']]);
      // $this->middleware('permission:teacher_experiences.export',['only' => ['export']]);
      // $this->middleware('permission:teacher_experiences.import',['only' => ['import']])
      // $this->middleware('permission:teacher_experiences.update|teacher_experiences.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $teacher = auth()->user()->teacher;
    if($req != null){
      $teacher_experiences =  $teacher->teacher_experiences()->withAll();
      if($req->trash && $req->trash == 'with'){
        $teacher_experiences =  $teacher_experiences->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $teacher_experiences =  $teacher_experiences->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $teacher_experiences = $teacher_experiences->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $teacher_experiences = $teacher_experiences->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $teacher_experiences = $teacher_experiences->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $teacher_experiences = $teacher_experiences->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $teacher_experiences = $teacher_experiences->get();
        return $teacher_experiences;
      }
      $totalTeacherCertifications = $teacher_experiences->count();
      $teacher_experiences = $teacher_experiences->paginate($req->perPage);
      $teacher_experiences = TeacherExperiencesResource::collection($teacher_experiences)->response()->getData(true);

      return $teacher_experiences;
    }
    $teacher_experiences = TeacherExperiencesResource::collection($teacher->teacher_experiences()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $teacher_experiences;
  }

  /********* FETCH ALL Teacher Experiences ***********/
    public function index()
    {
        $teacher_experiences =  $this->getter();
        $response = generateResponse($teacher_experiences,count($teacher_experiences['data']) > 0 ? true:false,'Teacher Experiences Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER Teacher Experiences FOR Search ***********/
   public function filter(Request $request){
     $teacher_experiences = $this->getter($request);
     $response = generateResponse($teacher_experiences,count($teacher_experiences['data']) > 0 ? true:false,'Filter Teacher Experiences Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW Teacher Experience ***********/
    public function store(CreateRequest $request)
    {
      $teacher = auth()->user()->teacher;
      try{
        DB::beginTransaction();
        $request->merge(['teacher_id'=>auth()->user()->id]);
        $data = $request->all();
        $data['image'] = uploadFile($request,'file','teacher_experiences');
        $teacher_experience = $teacher->teacher_experiences()->create($data);
        DB::commit();
        $teacher_experience = $teacher->teacher_experiences()->withAll()->find($teacher_experience->id);
        $teacher_experience = new TeacherExperiencesResource($teacher_experience);
      $response = generateResponse($teacher_experience,true ,'Teacher Experiences Created Successfully',null,'collection');
      return response()->json($response, 200);
    }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show(TeacherExperience $teacher_experience)
    {
        $teacher = auth()->user()->teacher;
        if($teacher_experience->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_experience = $teacher->teacher_experiences()->withAll()->find($teacher_experience->id);
        if($teacher_experience){
          $teacher_experience = new TeacherExperiencesResource($teacher_experience);
          $response = generateResponse($teacher_experience,true,'Teacher Experience Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'Teacher Experience Not Found',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE Teacher Experience ***********/
    public function update(CreateRequest $request, TeacherExperience $teacher_experience)
    {
        // dd($request->all());
        $teacher = auth()->user()->teacher;
        if($teacher_experience->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
      try{
        DB::beginTransaction();
        $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        if ($request->file) {
            $data['image'] = uploadFile($request,'file','teacher_experiences',$teacher_experience->image);
        } else {
            $data['image'] = $teacher_experience->image;
        }
        $teacher_experience->update($data);
        DB::commit();
        $teacher_experience = $teacher->teacher_experiences()->withAll()->find($teacher_experience->id);
        $teacher_experience = new TeacherExperiencesResource($teacher_experience);
        $response = generateResponse($teacher_experience,true,'Teacher Experience Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
        catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }

    /********* UPDATE Teacher Experience Status***********/
    public function updateStatus(Request $request,TeacherExperience $teacher_experience){
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_experience->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_experience->update([
          'is_active' => $teacher_experience->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'Teacher Experience Status Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }


    /********* DELETE Teacher Experience ***********/
    public function destroy(Request $request,TeacherExperience $teacher_experience)
    {
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_experience->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
          if($teacher_experience->trashed()) {
            $response = generateResponse(null,false ,'Already in Trash',null,'collection');
            return response()->json($response, 404);
          }
          else{
            $teacher_experience->delete();
          }
          $response = generateResponse(null,true,'Teacher Experience Deleted Successfully',null,'object');
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /*********Permanently DELETE Teacher Experience ***********/
    public function destroyPermanently(Request $request,$teacher_experience)
    {
      try{
        $teacher= auth()->user()->teacher;
        $teacher_experience = $teacher->teacher_experiences()->withTrashed()->find($teacher_experience);
        if($teacher_experience){
            if($teacher_experience->teacher_id != $teacher->id){
              $response = generateResponse(null,false ,'Not Found',null,'collection');
              return response()->json($response, 404);
            }
          if ($teacher_experience->trashed()) {
            $teacher_experience->forceDelete();
            $response = generateResponse(null,true,'Teacher Experience Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'Teacher Experience is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'Teacher Experience not found',null,'object');
        }
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /********* Restore Teacher Experience ***********/
    public function restore(Request $request,$teacher_experience)
    {
      $teacher= auth()->user()->teacher;
      $teacher_experience = $teacher->teacher_experiences()->withTrashed()->find($teacher_experience);
          if ($teacher_experience->trashed()) {
            $teacher_experience->restore();
            $response = generateResponse(null,true,'Teacher Experience Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'Teacher Experience is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
