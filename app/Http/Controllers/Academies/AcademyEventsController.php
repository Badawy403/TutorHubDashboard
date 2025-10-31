<?php

namespace App\Http\Controllers\Academies;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Requests\Academies\AcademyEvents\CreateRequest;
use App\Http\Resources\Web\EventsResource;
use Carbon\Carbon;
use Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class AcademyEventsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('academy');
      // $this->middleware('permission:academy_events.index');
      // $this->middleware('permission:academy_events.create',['only' => ['store']]);
      // $this->middleware('permission:academy_events.update',['only' => ['update']]);
      // $this->middleware('permission:academy_events.delete',['only' => ['destroy']]);
      // $this->middleware('permission:academy_events.export',['only' => ['export']]);
      // $this->middleware('permission:academy_events.import',['only' => ['import']])
      // $this->middleware('permission:academy_events.update|academy_events.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $academy = auth()->user()->academy;
    if($req != null){
      $academy_events =  $academy->academy_events()->withAll();
      if($req->trash && $req->trash == 'with'){
        $academy_events =  $academy_events->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $academy_events =  $academy_events->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $academy_events = $academy_events->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $academy_events = $academy_events->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $academy_events = $academy_events->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $academy_events = $academy_events->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $academy_events = $academy_events->get();
        return $academy_events;
      }
      $totalAcademyEvents = $academy_events->count();
      $academy_events = $academy_events->paginate($req->perPage);
      $academy_events = EventsResource::collection($academy_events)->response()->getData(true);

      return $academy_events;
    }
    $academy_events = EventsResource::collection($academy->academy_events()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $academy_events;
  }

  /********* FETCH ALL AcademyEvents ***********/
    public function index()
    {
        $academy_events =  $this->getter();
        $response = generateResponse($academy_events,count($academy_events['data']) > 0 ? true:false,'AcademyEvents Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER AcademyEvents FOR Search ***********/
   public function filter(Request $request){
     $academy_events = $this->getter($request);
     $response = generateResponse($academy_events,count($academy_events['data']) > 0 ? true:false,'Filter AcademyEvents Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW AcademyEvent ***********/
    public function store(CreateRequest $request)
    {
      $academy = auth()->user()->academy;
      try{
      DB::beginTransaction();
      $request->merge(['created_by_user_id'=>auth()->user()->id]);
      $data = $request->all();
      $data['image'] = uploadCroppedFile($request,'image','academy_events');
      $academy_event = $academy->academy_events()->create($data);
      $academy_event->slug = Str::slug($academy_event->name . ' ' . $academy_event->id, '-');
      $academy_event->save();
      $academy_event = $academy->academy_events()->withAll()->find($academy_event->id);
      foreach ($request->sponsers as $sponser) {
        $image_url = uploadArrayFile($sponser ,'image','event_sponsers');
        $academy_event->sponsers()->create([
            'name' => $sponser['name'],
            'image' => $image_url
        ]);
      }
      $academy_event = new EventsResource($academy_event);
      $academy_event->tags()->sync($request->tag_ids);
      DB::commit();
    }
      catch (\Exception $e) {
        DB::rollBack();
        request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
        return redirect()->back()->withErrors(['line' => $e->getLine(),'message' => $e->getMessage()]);
    }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $academy_event)
    {
        $academy = auth()->user()->academy;
        if($academy_event->academy_id != $academy->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $academy_event = $academy->academy_events()->withAll()->find($academy_event);
        if($academy_event){
          $academy_event = new EventsResource($academy_event);
          $response = generateResponse($academy_event,true,'AcademyEvent Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'AcademyEvent Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE AcademyEvent ***********/
    public function update(CreateRequest $request, Event $academy_event)
    {
        // dd($request->all());
        $academy = auth()->user()->academy;
        if($academy_event->academy_id != $academy->id){
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
            $data['image'] = uploadCroppedFile($request,'image','academy_events',$academy_event->image);
        } else {
            $data['image'] = $academy_event->image;
        }
        $academy_event->sponsers()->delete();
        foreach ($request->sponsers as $sponser) {
        if (is_string($sponser['image'])) {
            $image_url = $sponser['previous_image'];
        }else{
            $image_url = uploadArrayFile($sponser ,'image','event_sponsers');
        }
            $academy_event->sponsers()->create([
                'name' => $sponser['name'],
                'image' => $image_url
            ]);
          }
          $academy_event->update($data);
          $academy_event = $academy_event->find($academy_event->id);
          $slug = Str::slug($academy_event['name'] . ' ' . $academy_event->id, '-');
          $academy_event->update(
              [
                  'slug' => $slug
              ]
          );
        $academy_event->tags()->sync($request->tag_ids);
        DB::commit();
      }
        catch (\Exception $e) {
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
          return redirect()->back()->withErrors(['line' => $e->getLine(),'message' => $e->getMessage()]);
        }
       return redirect()->back();
    }

    /********* UPDATE AcademyEvent Status***********/
    public function updateStatus(Request $request,Event $academy_event){
        $academy = auth()->user()->academy;
        if($academy_event->academy_id != $academy->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $academy_event->update([
          'is_active' => $academy_event->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'AcademyEvent Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE AcademyEvent ***********/
    public function destroy(Request $request,Event $academy_event)
    {
        $academy = auth()->user()->academy;
        if($academy_event->academy_id != $academy->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($academy_event->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            $academy_event->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE AcademyEvent ***********/
    public function destroyPermanently(Request $request,$academy_event)
    {
        $academy= auth()->user()->academy;
        $academy_event = $academy->academy_events()->withTrashed()->find($academy_event);
        if($academy_event){
            if($academy_event->academy_id != $academy->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
          if ($academy_event->trashed()) {
            $academy_event->forceDelete();
            $response = generateResponse(null,true,'AcademyEvent Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'AcademyEvent is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'AcademyEvent not found',null,'object');
        }
          return response()->json($response, 200);
    }
    /********* Restore AcademyEvent ***********/
    public function restore(Request $request,$academy_event)
    {
      $academy= auth()->user()->academy;
      $academy_event = $academy->academy_events()->withTrashed()->find($academy_event);
          if ($academy_event->trashed()) {
            $academy_event->restore();
            $response = generateResponse(null,true,'AcademyEvent Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'AcademyEvent is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
