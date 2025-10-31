<?php

namespace App\Http\Controllers\Academies;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archive;
use App\Http\Requests\Academies\AcademyArchives\CreateRequest;
use App\Http\Resources\Web\ArchivesResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AcademyArchivesController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('academy');
      // $this->middleware('permission:academy_archives.index');
      // $this->middleware('permission:academy_archives.create',['only' => ['store']]);
      // $this->middleware('permission:academy_archives.update',['only' => ['update']]);
      // $this->middleware('permission:academy_archives.delete',['only' => ['destroy']]);
      // $this->middleware('permission:academy_archives.export',['only' => ['export']]);
      // $this->middleware('permission:academy_archives.import',['only' => ['import']])
      // $this->middleware('permission:academy_archives.update|academy_archives.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $academy = auth()->user()->academy;
    if($req != null){
      $academy_archives =  $academy->academy_archives()->withAll();
      if($req->trash && $req->trash == 'with'){
        $academy_archives =  $academy_archives->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $academy_archives =  $academy_archives->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $academy_archives = $academy_archives->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $academy_archives = $academy_archives->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $academy_archives = $academy_archives->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $academy_archives = $academy_archives->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $academy_archives = $academy_archives->get();
        return $academy_archives;
      }
      $totalAcademyArchives = $academy_archives->count();
      $academy_archives = $academy_archives->paginate($req->perPage);
      $academy_archives = ArchivesResource::collection($academy_archives)->response()->getData(true);

      return $academy_archives;
    }
    $academy_archives = ArchivesResource::collection($academy->academy_archives()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $academy_archives;
  }

  /********* FETCH ALL AcademyArchives ***********/
    public function index()
    {
        $academy_archives =  $this->getter();
        $response = generateResponse($academy_archives,count($academy_archives['data']) > 0 ? true:false,'AcademyArchives Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER AcademyArchives FOR Search ***********/
   public function filter(Request $request){
     $academy_archives = $this->getter($request);
     $response = generateResponse($academy_archives,count($academy_archives['data']) > 0 ? true:false,'Filter AcademyArchives Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW AcademyArchive ***********/
    public function store(CreateRequest $request)
    {
      $academy = auth()->user()->academy;
      try{
      DB::beginTransaction();
      $request->merge(['created_by_user_id'=>auth()->user()->id]);
      $data = $request->all();
      $data['image'] = uploadCroppedFile($request,'image','academy_archives');
      $academy_archive = $academy->academy_archives()->create($data);
      $academy_archive->slug = Str::slug($academy_archive->name . ' ' . $academy_archive->id, '-');
      $academy_archive->tags()->sync($request->tag_ids);
      $academy_archive->save();
      $academy_archive = $academy->academy_archives()->withAll()->find($academy_archive->id);
      $academy_archive = new ArchivesResource($academy_archive);
      DB::commit();
    }
      catch (\Exception $e) {
        DB::rollBack();
        request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
     }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $academy_archive)
    {
        $academy = auth()->user()->academy;
        if($academy_archive->academy_id != $academy->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $academy_archive = $academy->academy_archives()->withAll()->find($academy_archive);
        if($academy_archive){
          $academy_archive = new ArchivesResource($academy_archive);
          $response = generateResponse($academy_archive,true,'AcademyArchive Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'AcademyArchive Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE AcademyArchive ***********/
    public function update(CreateRequest $request, Archive $academy_archive)
    {
        // dd($request->all());
        $academy = auth()->user()->academy;
        if($academy_archive->academy_id != $academy->id){
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
            $data['image'] = uploadCroppedFile($request,'image','academy_archives',$academy_archive->image);
        } else {
            $data['image'] = $academy_archive->image;
        }
        $data['slug'] = Str::slug($data['name'] . ' ' . $academy_archive->id, '-');
        $academy_archive->update($data);
        $academy_archive->tags()->sync($request->tag_ids);
        DB::commit();
      }
        catch (\Exception $e) {
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
       }
       return redirect()->back();
    }

    /********* UPDATE AcademyArchive Status***********/
    public function updateStatus(Request $request,Archive $academy_archive){
        $academy = auth()->user()->academy;
        if($academy_archive->academy_id != $academy->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $academy_archive->update([
          'is_active' => $academy_archive->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'AcademyArchive Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE AcademyArchive ***********/
    public function destroy(Request $request,Archive $academy_archive)
    {
        $academy = auth()->user()->academy;
        if($academy_archive->academy_id != $academy->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($academy_archive->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            $academy_archive->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE AcademyArchive ***********/
    public function destroyPermanently(Request $request,$academy_archive)
    {
        $academy= auth()->user()->academy;
        $academy_archive = $academy->academy_archives()->withTrashed()->find($academy_archive);
        if($academy_archive){
            if($academy_archive->academy_id != $academy->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
          if ($academy_archive->trashed()) {
            $academy_archive->forceDelete();
            $response = generateResponse(null,true,'AcademyArchive Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'AcademyArchive is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'AcademyArchive not found',null,'object');
        }
          return response()->json($response, 200);
    }
    /********* Restore AcademyArchive ***********/
    public function restore(Request $request,$academy_archive)
    {
      $academy= auth()->user()->academy;
      $academy_archive = $academy->academy_archives()->withTrashed()->find($academy_archive);
          if ($academy_archive->trashed()) {
            $academy_archive->restore();
            $response = generateResponse(null,true,'AcademyArchive Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'AcademyArchive is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
