<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Requests\Teachers\TeacherEvents\CreateRequest;
use App\Http\Resources\Web\EventsResource;
use Carbon\Carbon;
use Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TeacherEventsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacher');
        // $this->middleware('permission:teacher_events.index');
        // $this->middleware('permission:teacher_events.create',['only' => ['store']]);
        // $this->middleware('permission:teacher_events.update',['only' => ['update']]);
        // $this->middleware('permission:teacher_events.delete',['only' => ['destroy']]);
        // $this->middleware('permission:teacher_events.export',['only' => ['export']]);
        // $this->middleware('permission:teacher_events.import',['only' => ['import']])
        // $this->middleware('permission:teacher_events.update|teacher_events.is_active',['only' => ['updateStatus']]);
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        $teacher = auth()->user()->teacher;
        if ($req != null) {
            $teacher_events =  $teacher->teacher_events()->withAll();
            if ($req->trash && $req->trash == 'with') {
                $teacher_events =  $teacher_events->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $teacher_events =  $teacher_events->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $teacher_events = $teacher_events->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $teacher_events = $teacher_events->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort && $req->sort['field'] != null && $req->sort['type'] != null) {
                $teacher_events = $teacher_events->OrderBy($req->sort['field'], $req->sort['type']);
            } else {
                $teacher_events = $teacher_events->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $teacher_events = $teacher_events->get();
                return $teacher_events;
            }
            $totalTeacherEvents = $teacher_events->count();
            $teacher_events = $teacher_events->paginate($req->perPage);
            $teacher_events = EventsResource::collection($teacher_events)->response()->getData(true);

            return $teacher_events;
        }
        $teacher_events = EventsResource::collection($teacher->teacher_events()->withAll()->orderBy('id', 'desc')->paginate(10))->response()->getData(true);
        return $teacher_events;
    }

    /********* FETCH ALL TeacherEvents ***********/
    public function index()
    {
        $teacher_events =  $this->getter();
        $response = generateResponse($teacher_events, count($teacher_events['data']) > 0 ? true : false, 'TeacherEvents Fetched Successfully', null, 'collection');
        return response()->json($response, 200);
    }

    /********* FILTER TeacherEvents FOR Search ***********/
    public function filter(Request $request)
    {
        $teacher_events = $this->getter($request);
        $response = generateResponse($teacher_events, count($teacher_events['data']) > 0 ? true : false, 'Filter TeacherEvents Successfully', null, 'collection');
        return response()->json($response, 200);
    }

    /********* ADD NEW TeacherEvent ***********/
    public function store(CreateRequest $request)
    {
        // dd($request->all());
        $teacher = auth()->user()->teacher;
        try {
            DB::beginTransaction();
            $request->merge(['created_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request, 'image', 'teacher_events');
            $teacher_event = $teacher->teacher_events()->create($data);
            $teacher_event->slug = Str::slug($teacher_event->name . ' ' . $teacher_event->id, '-');
            $teacher_event->save();
            $teacher_event = $teacher->teacher_events()->withAll()->find($teacher_event->id);
            foreach ($request->sponsers as $sponser) {
                $image_url = uploadArrayFile($sponser, 'image', 'event_sponsers');
                $teacher_event->sponsers()->create([
                    'name' => $sponser['name'],
                    'image' => $image_url
                ]);
            }
            $teacher_event = new EventsResource($teacher_event);
            $teacher_event->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
            return redirect()->back()->withErrors(['line' => $e->getLine(), 'message' => $e->getMessage()]);
        }
        return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show($teacher_event)
    {
        $teacher = auth()->user()->teacher;
        if ($teacher_event->teacher_id != $teacher->id) {
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $teacher_event = $teacher->teacher_events()->withAll()->find($teacher_event);
        if ($teacher_event) {
            $teacher_event = new EventsResource($teacher_event);
            $response = generateResponse($teacher_event, true, 'TeacherEvent Fetched Successfully', null, 'object');
        } else {
            $response = generateResponse(null, false, 'TeacherEvent Not FOund', null, 'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE TeacherEvent ***********/
    public function update(CreateRequest $request, Event $teacher_event)
    {
        // dd($request->all());
        $teacher = auth()->user()->teacher;
        if ($teacher_event->teacher_id != $teacher->id) {
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        try {
            DB::beginTransaction();
            $request->merge(['last_updated_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request, 'image', 'teacher_events', $teacher_event->image);
            } else {
                $data['image'] = $teacher_event->image;
            }

            $teacher_event->update($data);
            $teacher_event = $teacher_event->find($teacher_event->id);
            $slug = Str::slug($teacher_event['name'] . ' ' . $teacher_event->id, '-');
            $teacher_event->update(
                [
                    'slug' => $slug
                ]
            );
            $teacher_event->sponsers()->delete();
            foreach ($request->sponsers as $sponser) {
                if (is_string($sponser['image'])) {
                    $image_url = $sponser['previous_image'];
                } else {
                    $image_url = uploadArrayFile($sponser, 'image', 'event_sponsers');
                }
                $teacher_event->sponsers()->create([
                    'name' => $sponser['name'],
                    'image' => $image_url
                ]);
            }
            $teacher_event->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
            return redirect()->back()->withErrors(['line' => $e->getLine(), 'message' => $e->getMessage()]);
        }
        return redirect()->back();
    }

    /********* UPDATE TeacherEvent Status***********/
    public function updateStatus(Request $request, Event $teacher_event)
    {
        $teacher = auth()->user()->teacher;
        if ($teacher_event->teacher_id != $teacher->id) {
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $teacher_event->update([
            'is_active' => $teacher_event->is_active == 1 ? 0 : 1
        ]);
        $response = generateResponse(null, true, 'TeacherEvent Status Updated Successfully', null, 'object');
        return response()->json($response, 200);
    }


    /********* DELETE TeacherEvent ***********/
    public function destroy(Request $request, Event $teacher_event)
    {
        $teacher = auth()->user()->teacher;
        if ($teacher_event->teacher_id != $teacher->id) {
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
            return redirect()->back();
        }
        if ($teacher_event->trashed()) {
            request()->session()->flash('alert', ['message' => 'Already in Trash', 'type' => 'error']);
        } else {
            $teacher_event->sponsers()->delete();
            $teacher_event->delete();
        }
        return redirect()->back();
    }
    /*********Permanently DELETE TeacherEvent ***********/
    public function destroyPermanently(Request $request, $teacher_event)
    {
        $teacher = auth()->user()->teacher;
        $teacher_event = $teacher->teacher_events()->withTrashed()->find($teacher_event);
        if ($teacher_event) {
            if ($teacher_event->teacher_id != $teacher->id) {
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
            if ($teacher_event->trashed()) {
                $teacher_event->forceDelete();
                $response = generateResponse(null, true, 'TeacherEvent Deleted Successfully', null, 'object');
            } else {
                $response = generateResponse(null, false, 'TeacherEvent is not in trash to delete permanently', null, 'object');
            }
        } else {
            $response = generateResponse(null, false, 'TeacherEvent not found', null, 'object');
        }
        return response()->json($response, 200);
    }
    /********* Restore TeacherEvent ***********/
    public function restore(Request $request, $teacher_event)
    {
        $teacher = auth()->user()->teacher;
        $teacher_event = $teacher->teacher_events()->withTrashed()->find($teacher_event);
        if ($teacher_event->trashed()) {
            $teacher_event->restore();
            $response = generateResponse(null, true, 'TeacherEvent Restored Successfully', null, 'object');
        } else {
            $response = generateResponse(null, false, 'TeacherEvent is not trashed', null, 'object');
        }
        return response()->json($response, 200);
    }
}
