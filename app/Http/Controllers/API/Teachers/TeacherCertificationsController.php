<?php

namespace App\Http\Controllers\API\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certification;
use App\Http\Requests\API\Teachers\TeacherCertifications\CreateRequest;
use App\Http\Resources\API\CertificationsResource;
use Illuminate\Support\Facades\DB;

class TeacherCertificationsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
        $this->middleware(['api','auth:api','verified','api_setting']);
        $this->middleware('teacher.api');
      // $this->middleware('permission:teacher_certifications.index');
      // $this->middleware('permission:teacher_certifications.create',['only' => ['store']]);
      // $this->middleware('permission:teacher_certifications.update',['only' => ['update']]);
      // $this->middleware('permission:teacher_certifications.delete',['only' => ['destroy']]);
      // $this->middleware('permission:teacher_certifications.export',['only' => ['export']]);
      // $this->middleware('permission:teacher_certifications.import',['only' => ['import']])
      // $this->middleware('permission:teacher_certifications.update|teacher_certifications.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $teacher = auth()->user()->teacher;
    if($req != null){
      $teacher_certifications =  $teacher->teacher_certifications()->withAll();
      if($req->trash && $req->trash == 'with'){
        $teacher_certifications =  $teacher_certifications->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $teacher_certifications =  $teacher_certifications->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $teacher_certifications = $teacher_certifications->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $teacher_certifications = $teacher_certifications->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $teacher_certifications = $teacher_certifications->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $teacher_certifications = $teacher_certifications->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $teacher_certifications = $teacher_certifications->get();
        return $teacher_certifications;
      }
      $totalTeacherCertifications = $teacher_certifications->count();
      $teacher_certifications = $teacher_certifications->paginate($req->perPage);
      $teacher_certifications = CertificationsResource::collection($teacher_certifications)->response()->getData(true);

      return $teacher_certifications;
    }
    $teacher_certifications = CertificationsResource::collection($teacher->teacher_certifications()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $teacher_certifications;
  }

  /********* FETCH ALL TeacherCertifications ***********/
    public function index()
    {
        $teacher_certifications =  $this->getter();
        $response = generateResponse($teacher_certifications,count($teacher_certifications['data']) > 0 ? true:false,'TeacherCertifications Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER TeacherCertifications FOR Search ***********/
   public function filter(Request $request){
     $teacher_certifications = $this->getter($request);
     $response = generateResponse($teacher_certifications,count($teacher_certifications['data']) > 0 ? true:false,'Filter TeacherCertifications Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW TeacherCertification ***********/
    public function store(CreateRequest $request)
    {
      $teacher = auth()->user()->teacher;
      try{
      DB::beginTransaction();
      $request->merge(['created_by_user_id'=>auth()->user()->id]);
      $data = $request->all();
      $data['image'] = uploadFile($request,'file','teacher_certifications');
      $teacher_certification = $teacher->teacher_certifications()->create($data);
      DB::commit();
      $teacher_certification = $teacher->teacher_certifications()->withAll()->find($teacher_certification->id);
      $teacher_certification = new CertificationsResource($teacher_certification);
      $response = generateResponse($teacher_certification,true ,'TeacherCertifications Created Successfully',null,'collection');
      return response()->json($response, 200);
    }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show(Certification $teacher_certification)
    {
        $teacher = auth()->user()->teacher;
        if($teacher_certification->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_certification = $teacher->teacher_certifications()->withAll()->find($teacher_certification->id);
        if($teacher_certification){
          $teacher_certification = new CertificationsResource($teacher_certification);
          $response = generateResponse($teacher_certification,true,'TeacherCertification Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'TeacherCertification Not Found',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE TeacherCertification ***********/
    public function update(CreateRequest $request, Certification $teacher_certification)
    {
        // dd($request->all());
        $teacher = auth()->user()->teacher;
        if($teacher_certification->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
      try{
        DB::beginTransaction();
        $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        if ($request->file) {
            $data['image'] = uploadFile($request,'file','teacher_certifications',$teacher_certification->image);
        } else {
            $data['image'] = $teacher_certification->image;
        }
        $teacher_certification->update($data);
        DB::commit();
        $teacher_certification = $teacher->teacher_certifications()->withAll()->find($teacher_certification->id);
        $teacher_certification = new CertificationsResource($teacher_certification);
        $response = generateResponse($teacher_certification,true,'TeacherCertification Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
        catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }

    /********* UPDATE TeacherCertification Status***********/
    public function updateStatus(Request $request,Certification $teacher_certification){
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_certification->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $teacher_certification->update([
          'is_active' => $teacher_certification->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'TeacherCertification Status Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }


    /********* DELETE TeacherCertification ***********/
    public function destroy(Request $request,Certification $teacher_certification)
    {
      try{
        $teacher = auth()->user()->teacher;
        if($teacher_certification->teacher_id != $teacher->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
          if($teacher_certification->trashed()) {
            $response = generateResponse(null,false ,'Already in Trash',null,'collection');
            return response()->json($response, 404);
          }
          else{
            $teacher_certification->delete();
          }
          $response = generateResponse(null,true,'TeacherCertification Deleted Successfully',null,'object');
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /*********Permanently DELETE TeacherCertification ***********/
    public function destroyPermanently(Request $request,$teacher_certification)
    {
      try{
        $teacher= auth()->user()->teacher;
        $teacher_certification = $teacher->teacher_certifications()->withTrashed()->find($teacher_certification);
        if($teacher_certification){
            if($teacher_certification->teacher_id != $teacher->id){
              $response = generateResponse(null,false ,'Not Found',null,'collection');
              return response()->json($response, 404);
            }
          if ($teacher_certification->trashed()) {
            $teacher_certification->forceDelete();
            $response = generateResponse(null,true,'TeacherCertification Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherCertification is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'TeacherCertification not found',null,'object');
        }
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /********* Restore TeacherCertification ***********/
    public function restore(Request $request,$teacher_certification)
    {
      $teacher= auth()->user()->teacher;
      $teacher_certification = $teacher->teacher_certifications()->withTrashed()->find($teacher_certification);
          if ($teacher_certification->trashed()) {
            $teacher_certification->restore();
            $response = generateResponse(null,true,'TeacherCertification Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'TeacherCertification is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
