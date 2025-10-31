<?php

namespace App\Http\Controllers\Academies;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certification;
use App\Http\Requests\Academies\AcademyCertifications\CreateRequest;
use App\Http\Resources\Web\CertificationsResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AcademyCertificationsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('academy');

      // $this->middleware('permission:academy_certifications.index');
      // $this->middleware('permission:academy_certifications.create',['only' => ['store']]);
      // $this->middleware('permission:academy_certifications.update',['only' => ['update']]);
      // $this->middleware('permission:academy_certifications.delete',['only' => ['destroy']]);
      // $this->middleware('permission:academy_certifications.export',['only' => ['export']]);
      // $this->middleware('permission:academy_certifications.import',['only' => ['import']])
      // $this->middleware('permission:academy_certifications.update|academy_certifications.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $academy = auth()->user()->academy;
    if($req != null){
      $academy_certifications =  $academy->academy_certifications()->withAll();
      if($req->trash && $req->trash == 'with'){
        $academy_certifications =  $academy_certifications->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $academy_certifications =  $academy_certifications->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $academy_certifications = $academy_certifications->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $academy_certifications = $academy_certifications->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $academy_certifications = $academy_certifications->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $academy_certifications = $academy_certifications->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $academy_certifications = $academy_certifications->get();
        return $academy_certifications;
      }
      $totalAcademyCertifications = $academy_certifications->count();
      $academy_certifications = $academy_certifications->paginate($req->perPage);
      $academy_certifications = CertificationsResource::collection($academy_certifications)->response()->getData(true);

      return $academy_certifications;
    }
    $academy_certifications = CertificationsResource::collection($academy->academy_certifications()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $academy_certifications;
  }

  /********* FETCH ALL AcademyCertifications ***********/
    public function index()
    {
        $academy_certifications =  $this->getter();
        $response = generateResponse($academy_certifications,count($academy_certifications['data']) > 0 ? true:false,'AcademyCertifications Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER AcademyCertifications FOR Search ***********/
   public function filter(Request $request){
     $academy_certifications = $this->getter($request);
     $response = generateResponse($academy_certifications,count($academy_certifications['data']) > 0 ? true:false,'Filter AcademyCertifications Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW AcademyCertification ***********/
    public function store(CreateRequest $request)
    {
      $academy = auth()->user()->academy;
      try{
      DB::beginTransaction();
      $request->merge(['created_by_user_id'=>auth()->user()->id]);
      $data = $request->all();
      $data['image'] = uploadCroppedFile($request,'image','academy_certifications');
      $academy_certification = $academy->academy_certifications()->create($data);
      $academy_certification = $academy->academy_certifications()->withAll()->find($academy_certification->id);
      $academy_certification = new CertificationsResource($academy_certification);
      DB::commit();
    }
      catch (\Exception $e) {
        DB::rollBack();
        request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
     }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $academy_certification)
    {
        $academy = auth()->user()->academy;
        if($academy_certification->academy_id != $academy->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $academy_certification = $academy->academy_certifications()->withAll()->find($academy_certification);
        if($academy_certification){
          $academy_certification = new CertificationsResource($academy_certification);
          $response = generateResponse($academy_certification,true,'AcademyCertification Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'AcademyCertification Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE AcademyCertification ***********/
    public function update(CreateRequest $request, Certification $academy_certification)
    {
        // dd($request->all());
        $academy = auth()->user()->academy;
        if($academy_certification->academy_id != $academy->id){
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
            $data['image'] = uploadCroppedFile($request,'image','academy_certifications',$academy_certification->image);
        } else {
            $data['image'] = $academy_certification->image;
        }
        $academy_certification->update($data);
        DB::commit();
      }
        catch (\Exception $e) {
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
       }
       return redirect()->back();
    }

    /********* UPDATE AcademyCertification Status***********/
    public function updateStatus(Request $request,Certification $academy_certification){
        $academy = auth()->user()->academy;
        if($academy_certification->academy_id != $academy->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $academy_certification->update([
          'is_active' => $academy_certification->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'AcademyCertification Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE AcademyCertification ***********/
    public function destroy(Request $request,Certification $academy_certification)
    {
        $academy = auth()->user()->academy;
        if($academy_certification->academy_id != $academy->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($academy_certification->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            $academy_certification->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE AcademyCertification ***********/
    public function destroyPermanently(Request $request,$academy_certification)
    {
        $academy= auth()->user()->academy;
        $academy_certification = $academy->academy_certifications()->withTrashed()->find($academy_certification);
        if($academy_certification){
            if($academy_certification->academy_id != $academy->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
          if ($academy_certification->trashed()) {
            $academy_certification->forceDelete();
            $response = generateResponse(null,true,'AcademyCertification Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'AcademyCertification is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'AcademyCertification not found',null,'object');
        }
          return response()->json($response, 200);
    }
    /********* Restore AcademyCertification ***********/
    public function restore(Request $request,$academy_certification)
    {
      $academy= auth()->user()->academy;
      $academy_certification = $academy->academy_certifications()->withTrashed()->find($academy_certification);
          if ($academy_certification->trashed()) {
            $academy_certification->restore();
            $response = generateResponse(null,true,'AcademyCertification Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'AcademyCertification is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
