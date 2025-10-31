<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\EventsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Events\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\SuperAdmin\Events\UpdateRequest;
use App\Imports\SuperAdmin\EventsImport;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\PricingPlan;
use App\Models\Subscription;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        if ($req != null) {
            $events =  Event::withAll();
            if ($req->trash && $req->trash == 'with') {
                $events =  $events->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $events =  $events->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $events = $events->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $events = $events->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $events = $events->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $events = $events->OrderBy('is_approved', 'ASC');

            }
            if ($export != null) { // for export do not paginate
                $events = $events->get();
                return $events;
            }
            $events = $events->get();
            return $events;
        }
        $events = Event::withAll()->OrderBy('is_approved', 'ASC')->get();
        return $events;
    }


    /*********View All Events  ***********/
    public function index(Request $request)
    {
        $events = $this->getter($request);
        return view('super_admins.events.index')->with('events', $events);
    }

    /*********View Create Form of Event  ***********/
    public function create()
    {
        $event_categories = EventCategory::active()->get();
        $tags = Tag::active()->get();
        return view('super_admins.events.create',compact('event_categories' , 'tags'));
    }

    /*********Store Event  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','events');
            $event = Event::create($data);
            foreach ($request->sponsers as $sponser) {
                $image_url = uploadArrayFile($sponser ,'image','event_sponsers');
                $event->sponsers()->create([
                    'name' => $sponser['name'],
                    'image' => $image_url
                ]);
              }
            $event->tags()->sync($request->tag_ids);
            $event->slug = Str::slug($event->name . ' ' . $event->id, '-');
            $event->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.events.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.events.index')->with('message', 'Event Created Successfully')->with('message_type', 'success');
    }

    /*********View Event  ***********/
    public function show(Event $event)
    {
        return view('super_admins.events.show', compact('event'));
    }

    /*********View Edit Form of Event  ***********/
    public function edit(Event $event)
    {
        $event = Event::withAll()->find($event->id);
        $event_categories = EventCategory::active()->get();
        $tags = Tag::active()->get();
        return view('super_admins.events.edit', compact('event','event_categories' , 'tags'));
    }

    /*********Update Event  ***********/
    public function update(CreateRequest $request, Event $event)
    {
        $data = $request->all();

            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
            $data = $request->all();
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','teacher_events',$event->image);
            } else {
                $data['image'] = $event->image;
            }
            $event->sponsers()->delete();
            foreach ($request->sponsers as $sponser) {
                if(isset($sponser['image'])){
                    if (is_string($sponser['image']) && $sponser['image'] != 'undefined') {
                        $image_url = $sponser['previous_image'];
                    }else{
                        $image_url = uploadArrayFile($sponser ,'image','event_sponsers');
                    }
                }
                $event->sponsers()->create([
                    'name' => $sponser['name'],
                    'image' => $image_url
                ]);
              }
            $event->tags()->sync($request->tag_ids);
            $event->update($data);
            $event = Event::find($event->id);
            $slug = Str::slug($event->name . ' ' . $event->id, '-');
            $event->update([
                'slug' => $slug
            ]);
            DB::commit();

        return redirect()->route('super_admin.events.index')->with('message', 'Event Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $events = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "events." . $extension;
        return Excel::download(new EventsExport($events), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new EventsImport, $file);
        return redirect()->back()->with('message', 'Events imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Event ***********/
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->back()->with('message', 'Event Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Event ***********/
    public function destroyPermanently(Request $request, $event)
    {
        $event = Event::withTrashed()->find($event);
        if ($event) {
            if ($event->trashed()) {
                if ($event->image && file_exists(public_path($event->image))) {
                    unlink(public_path($event->image));
                }
                $event->forceDelete();
                return redirect()->back()->with('message', 'Event Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Event is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Event Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Event***********/
    public function restore(Request $request, $event)
    {
        $event = Event::withTrashed()->find($event);
        if ($event->trashed()) {
            $event->restore();
            return redirect()->back()->with('message', 'Event Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Event Not Found')->with('message_type', 'error');
        }
    }
        /*********Approve Event ***********/
        public function approve(Event $event)
        {
            if(!$event->is_approved){
                $event->update(['is_approved' => 1,'approved_at' => now()]);
            }
            return redirect()->back()->with('message', 'Event Approved Successfully')->with('message_type', 'success');
        }
}
