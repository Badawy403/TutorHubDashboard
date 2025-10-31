<?php

namespace App\Http\Controllers\API\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeacherEducation;
use App\Http\Requests\API\Teachers\TeacherEducations\CreateRequest;
use App\Http\Requests\API\Teachers\TeacherEducations\UpdateRequest;
use App\Http\Resources\API\TeacherEducationsResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeacherEducationsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
        $this->middleware(['api','auth:api','verified','api_setting']);
        $this->middleware('teacher.api');
      // $this->middleware('permission:teacher_educations.index');
      // $this->middleware('permission:teacher_educations.create',['only' => ['store']]);
      // $this->middleware('permission:teacher_educations.update',['only' => ['update']]);
      // $this->middleware('permission:teacher_educations.delete',['only' => ['destroy']]);
      // $this->middleware('permission:teacher_educations.export',['only' => ['export']]);
      // $this->middleware('permission:teacher_educations.import',['only' => ['import']])
      // $this->middleware('permission:teacher_educations.update|teacher_educations.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $teacher = auth()->user()->teacher;
    if($req != null){
      $teacher_educations =  $teacher->teacher_educations()->withAll();
      if($req->trash && $req->trash == 'with'){
        $teacher_educations =  $teacher_educations->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $teacher_educations =  $teacher_educations->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $teacher_educations = $teacher_educations->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $teacher_educations = $teacher_educations->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $teacher_educations = $teacher_educations->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $teacher_educations = $teacher_educations->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $teacher_educations = $teacher_educations->get();
        return $teacher_educations;
      }
      $totalTeacherCertifications = $teacher_educations->count();
      $teacher_educations = $teacher_educations->paginate($req->perPage);
      $teacher_educations = TeacherEducationsResource::collection($teacher_educations)->response()->getData(true);

      return $teacher_educations;
    }
    $teacher_educations = TeacherEducationsResource::collection($teacher->teacher_educations()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $teacher_educations;
  }

  /********* FETCH ALL Teacher Educations ***********/
    public function index()
    {
        $teacher_educations =  $this->getter();
        $response = generateResponse($teacher_educations,count($teacher_educations['data']) > 0 ? true:false,'Teacher Educations Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER Teacher Educations FOR Search ***********/
   public function filter(Request $request){
     $teacher_educations = $this->getter($request);
     $response = generateResponse($teacher_educations,count($teacher_educations['data']) > 0 ? true:false,'Filter Teacher Educations Successfully',null,'collection');
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
        $data['image'] = uploadFile($request,'file','teacher_educations');
        $teacher_education = $teacher->teacher_educations()->create($data);
        DB::commit();
        $teacher_education = $teacher->teacher_educations()->withAll()->find($teacher_education->id);
        $teacher_education = new TeacherEducationsResource($teacher_education);
      $response = generateResponse($teacher_education,true ,'Teacher Educations Created Successfully',null,'collection');
      return response()->json($response, 200);
    }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show(TeacherEducation $teacher_education)
    {
        $teacher = auth()->user()->teacher;
        if($teacher_education->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_education = $teacher->teacher_educations()->withAll()->find($teacher_education->id);
        if($teacher_education){
          $teacher_education = new TeacherEducationsResource($teacher_education);
          $response = generateResponse($teacher_education,true,'Teacher Experience Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'Teacher Experience Not Found',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE Teacher Experience ***********/
    public function update(UpdateRequest $request, TeacherEducation $teacher_education)
    {
        // dd($request->all());
        $teacher = auth()->user()->teacher;
        if($teacher_education->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
      try{
        DB::beginTransaction();
        $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        if ($request->file) {
            $data['image'] = uploadFile($request,'file','teacher_educations',$teacher_education->image);
        } else {
            $data['image'] = $teacher_education->image;
        }
        $teacher_education->update($data);
        DB::commit();
        $teacher_education = $teacher->teacher_educations()->withAll()->find($teacher_education->id);
        $teacher_education = new TeacherEducationsResource($teacher_education);
        $response = generateResponse($teacher_education,true,'Teacher Experience Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
        catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }

    /********* UPDATE Teacher Experience Status***********/
    public function updateStatus(Request $request,TeacherEducation $teacher_education){
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_education->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_education->update([
          'is_active' => $teacher_education->is_active == 1 ? 0:1
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
    public function destroy(Request $request,TeacherEducation $teacher_education)
    {
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_education->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
          if($teacher_education->trashed()) {
            $response = generateResponse(null,false ,'Already in Trash',null,'collection');
            return response()->json($response, 404);
          }
          else{
            $teacher_education->delete();
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
    public function destroyPermanently(Request $request,$teacher_education)
    {
      try{
        $teacher= auth()->user()->teacher;
        $teacher_education = $teacher->teacher_educations()->withTrashed()->find($teacher_education);
        if($teacher_education){
            if($teacher_education->teacher_id != $teacher->id){
              $response = generateResponse(null,false ,'Not Found',null,'collection');
              return response()->json($response, 404);
            }
          if ($teacher_education->trashed()) {
            $teacher_education->forceDelete();
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
    public function restore(Request $request,$teacher_education)
    {
      $teacher= auth()->user()->teacher;
      $teacher_education = $teacher->teacher_educations()->withTrashed()->find($teacher_education);
          if ($teacher_education->trashed()) {
            $teacher_education->restore();
            $response = generateResponse(null,true,'Teacher Experience Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'Teacher Experience is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
