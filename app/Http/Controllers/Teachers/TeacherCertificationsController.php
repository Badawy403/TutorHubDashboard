<?php

namespace App\Http\Controllers\Teachers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certification;
use App\Http\Requests\Teachers\TeacherCertifications\CreateRequest;
use App\Http\Resources\Web\CertificationsResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeacherCertificationsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('teacher');
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
      $teacher_certification = $teacher->teacher_certifications()->withAll()->find($teacher_certification->id);
      $teacher_certification = new CertificationsResource($teacher_certification);
      DB::commit();
    }
      catch (\Exception $e) {
        DB::rollBack();
        request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
     }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $teacher_certification)
    {
        $teacher = auth()->user()->teacher;
        if($teacher_certification->teacher_id != $teacher->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $teacher_certification = $teacher->teacher_certifications()->withAll()->find($teacher_certification);
        if($teacher_certification){
          $teacher_certification = new CertificationsResource($teacher_certification);
          $response = generateResponse($teacher_certification,true,'TeacherCertification Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'TeacherCertification Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE TeacherCertification ***********/
    public function update(CreateRequest $request, Certification $teacher_certification)
    {
        // dd($request->all());
        $teacher = auth()->user()->teacher;
        if($teacher_certification->teacher_id != $teacher->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
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
      }
        catch (\Exception $e) {
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
       }
       return redirect()->back();
    }

    /********* UPDATE TeacherCertification Status***********/
    public function updateStatus(Request $request,Certification $teacher_certification){
        $teacher = auth()->user()->teacher;
        if($teacher_certification->teacher_id != $teacher->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $teacher_certification->update([
          'is_active' => $teacher_certification->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'TeacherCertification Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE TeacherCertification ***********/
    public function destroy(Request $request,Certification $teacher_certification)
    {
        $teacher = auth()->user()->teacher;
        if($teacher_certification->teacher_id != $teacher->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($teacher_certification->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            $teacher_certification->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE TeacherCertification ***********/
    public function destroyPermanently(Request $request,$teacher_certification)
    {
        $teacher= auth()->user()->teacher;
        $teacher_certification = $teacher->teacher_certifications()->withTrashed()->find($teacher_certification);
        if($teacher_certification){
            if($teacher_certification->teacher_id != $teacher->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
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
