<?php

namespace App\Http\Controllers\Academies;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\Academies\AcademyServices\CreateRequest;
use App\Http\Resources\Web\ServicesResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AcademyServicesController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
    //   $this->middleware('auth');
    //   $this->middleware('academy');
      // $this->middleware('permission:academy_services.index');
      // $this->middleware('permission:academy_services.create',['only' => ['store']]);
      // $this->middleware('permission:academy_services.update',['only' => ['update']]);
      // $this->middleware('permission:academy_services.delete',['only' => ['destroy']]);
      // $this->middleware('permission:academy_services.export',['only' => ['export']]);
      // $this->middleware('permission:academy_services.import',['only' => ['import']])
      // $this->middleware('permission:academy_services.update|academy_services.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $academy = auth()->user()->academy;
    if($req != null){
      $academy_services =  $academy->academy_services()->withAll();
      if($req->trash && $req->trash == 'with'){
        $academy_services =  $academy_services->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $academy_services =  $academy_services->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $academy_services = $academy_services->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $academy_services = $academy_services->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $academy_services = $academy_services->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $academy_services = $academy_services->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $academy_services = $academy_services->get();
        return $academy_services;
      }
      $totalAcademyServices = $academy_services->count();
      $academy_services = $academy_services->paginate($req->perPage);
      $academy_services = ServicesResource::collection($academy_services)->response()->getData(true);

      return $academy_services;
    }
    $academy_services = ServicesResource::collection($academy->academy_services()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $academy_services;
  }

  /********* FETCH ALL AcademyServices ***********/
    public function index()
    {
        $academy_services =  $this->getter();
        $response = generateResponse($academy_services,count($academy_services['data']) > 0 ? true:false,'AcademyServices Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER AcademyServices FOR Search ***********/
   public function filter(Request $request){
     $academy_services = $this->getter($request);
     $response = generateResponse($academy_services,count($academy_services['data']) > 0 ? true:false,'Filter AcademyServices Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW AcademyService ***********/
    public function store(CreateRequest $request)
    {
        $settings = generalSettings();
      $academy = auth()->user()->academy;
      try{
      DB::beginTransaction();
      $request->merge(['created_by_user_id'=>auth()->user()->id]);
      $data = $request->all();
      $data['image'] = uploadCroppedFile($request,'image','academy_services');
      $data['audio'] = uploadFile($request,'audio','academy_services');
      $data['video'] = uploadFile($request,'video','academy_services');
      $academy_service = $academy->academy_services()->create($data);
      $academy_service->slug = Str::slug($academy_service->name . ' ' . $academy_service->id, '-');
      if((int)$settings['auto_approve_academy_service']){
        $academy_service->is_approved = 1;
        $academy_service->approved_at = now();
      }
      $academy_service->save();
      $academy_service = $academy->academy_services()->withAll()->find($academy_service->id);
      $academy_service = new ServicesResource($academy_service);
      $academy_service->tags()->sync($request->tag_ids);
      if($request->faqs){
        $academy_service->faqs()->createMany($request->faqs);
      }
      DB::commit();
    }
      catch (\Exception $e) {
        DB::rollBack();
        request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
     }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $academy_service)
    {
        $academy = auth()->user()->academy;
        if($academy_service->academy_id != $academy->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $academy_service = $academy->academy_services()->withAll()->find($academy_service);
        if($academy_service){
          $academy_service = new ServicesResource($academy_service);
          $response = generateResponse($academy_service,true,'AcademyService Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'AcademyService Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE AcademyService ***********/
    public function update(CreateRequest $request, Service $academy_service)
    {
        // dd($request->all());
        $academy = auth()->user()->academy;
        if($academy_service->academy_id != $academy->id){
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
            $data['image'] = uploadCroppedFile($request,'image','academy_services',$academy_service->image);
        } else {
            $data['image'] = $academy_service->image;
        }

        if ($request->audio) {
            $data['audio'] = uploadFile($request,'audio','academy_services');
        } else {
            $data['audio'] = $academy_service->audio;
        }

        if ($request->video) {
            $data['video'] = uploadFile($request,'video','academy_services');
        } else {
            $data['video'] = $academy_service->video;
        }
        $academy_service->update($data);
        $academy_service = $academy_service->find($academy_service->id);
        $slug = Str::slug($academy_service['name'] . ' ' . $academy_service->id, '-');
        $academy_service->update(
            [
                'slug' => $slug
            ]
        );
        $academy_service->tags()->sync($request->tag_ids);
        if($request->faqs){
            $academy_service->faqs()->delete();
            $academy_service->faqs()->createMany($request->faqs);
          }
        DB::commit();
      }
        catch (\Exception $e) {
            dd($e->getMessage());
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
       }
       return redirect()->back();
    }

    /********* UPDATE AcademyService Status***********/
    public function updateStatus(Request $request,Service $academy_service){
        $academy = auth()->user()->academy;
        if($academy_service->academy_id != $academy->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $academy_service->update([
          'is_active' => $academy_service->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'AcademyService Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE AcademyService ***********/
    public function destroy(Request $request,Service $academy_service)
    {
        $academy = auth()->user()->academy;
        if($academy_service->academy_id != $academy->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($academy_service->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            $academy_service->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE AcademyService ***********/
    public function destroyPermanently(Request $request,$academy_service)
    {
        $academy= auth()->user()->academy;
        $academy_service = $academy->academy_services()->withTrashed()->find($academy_service);
        if($academy_service){
            if($academy_service->academy_id != $academy->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
          if ($academy_service->trashed()) {
            $academy_service->forceDelete();
            $response = generateResponse(null,true,'AcademyService Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'AcademyService is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'AcademyService not found',null,'object');
        }
          return response()->json($response, 200);
    }
    /********* Restore AcademyService ***********/
    public function restore(Request $request,$academy_service)
    {
      $academy= auth()->user()->academy;
      $academy_service = $academy->academy_services()->withTrashed()->find($academy_service);
          if ($academy_service->trashed()) {
            $academy_service->restore();
            $response = generateResponse(null,true,'AcademyService Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'AcademyService is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
