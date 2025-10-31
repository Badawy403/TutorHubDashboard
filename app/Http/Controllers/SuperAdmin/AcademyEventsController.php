<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\EventsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Events\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\EventsImport;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Academy;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AcademyEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null , $academy)
    {
        if ($req != null) {
            $academy_events =  $academy->academy_events();
            if ($req->trash && $req->trash == 'with') {
                $academy_events =  $academy_events->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $academy_events =  $academy_events->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $academy_events = $academy_events->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $academy_events = $academy_events->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $academy_events = $academy_events->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $academy_events = $academy_events->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $academy_events = $academy_events->get();
                return $academy_events;
            }
            $academy_events = $academy_events->get();
            return $academy_events;
        }
        $academy_events = $academy->academy_events()->withAll()->orderBy('id', 'desc')->get();
        return $academy_events;
    }


    /*********View All Events  ***********/
    public function index(Request $request , Academy $academy)
    {
        $academy_events = $this->getter($request , null , $academy);
        return view('super_admins.academies.academy_events.index' , compact('academy_events' , 'academy'));
    }

    /*********View Create Form of Event  ***********/
    public function create(Academy $academy)
    {
        $tags = Tag::active()->get();
        $event_categories = EventCategory::active()->get();
        return view('super_admins.academies.academy_events.create', compact('academy' , 'tags' , 'event_categories'));
    }

    /*********Store Event  ***********/
    public function store(CreateRequest $request , Academy $academy)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['created_by_user_id'=>auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request,'image','academy_events');
            $academy_event = $academy->academy_events()->create($data);
            $academy_event->slug = Str::slug($academy_event->name . ' ' . $academy_event->id, '-');
            $academy_event->save();
            foreach ($request->sponsers as $sponser) {
                $image_url = uploadArrayFile($sponser ,'image','event_sponsers');
                $academy_event->sponsers()->create([
                    'name' => $sponser['name'],
                    'image' => $image_url
                ]);
              }
            $academy_event->tags()->sync($request->tag_ids);
            $academy_event = $academy->academy_events()->withAll()->find($academy_event->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academy_events.index' , $academy->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academy_events.index' , $academy->id)->with('message', 'Event Created Successfully')->with('message_type', 'success');
    }

    /*********View Event  ***********/
    public function show(Academy $academy ,Event $academy_event)
    {
        if($academy->id != $academy_event->academy_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        return view('super_admins.academies.academy_events.show', compact('academy_event' , 'academy'));
    }

    /*********View Edit Form of Event  ***********/
    public function edit(Academy $academy ,Event $academy_event)
    {
        if($academy->id != $academy_event->academy_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        $tags = Tag::active()->get();
        $event_categories = EventCategory::active()->get();
        return view('super_admins.academies.academy_events.edit', compact('academy_event', 'academy' , 'tags' , 'event_categories'));
    }

    /*********Update Event  ***********/
    public function update(CreateRequest $request,Academy $academy , Event $academy_event)
    {
        if($academy->id != $academy_event->academy_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
            $data = $request->all();
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','academy_events',$academy_event->image);
            } else {
                $data['image'] = $academy_event->image;
            }
            $academy_event->sponsers()->delete();
            foreach ($request->sponsers as $sponser) {
                if(isset($sponser['image'])){
                    if (is_string($sponser['image']) && $sponser['image'] != 'undefined') {
                        $image_url = $sponser['previous_image'];
                    }else{
                        $image_url = uploadArrayFile($sponser ,'image','event_sponsers');
                    }
                }
                $academy_event->sponsers()->create([
                    'name' => $sponser['name'],
                    'image' => $image_url
                ]);
              }
              $academy_event->update($data);
              $academy_event = Event::find($academy_event->id);
              $slug = Str::slug($academy_event->name . ' ' . $academy_event->id, '-');
              $academy_event->update([
                  'slug' => $slug
              ]);
            $academy_event->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academy_events.index' , $academy->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academy_events.index' , $academy->id)->with('message', 'Event Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $academy_events = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "academy_events." . $extension;
        return Excel::download(new EventsExport($academy_events), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new EventsImport, $file);
        return redirect()->back()->with('message', 'Event Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Event ***********/
    public function destroy(Academy $academy ,Event $academy_event)
    {
        if($academy->id != $academy_event->academy_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        $academy_event->delete();
        return redirect()->back()->with('message', 'Event Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Event ***********/
    public function destroyPermanently(Request $request,Academy $academy ,$academy_event)
    {
        if($academy->id != $academy_event->academy_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        $academy_event = Event::withTrashed()->find($academy_event);
        if ($academy_event) {
            if ($academy_event->trashed()) {
                if ($academy_event->image && file_exists(public_path($academy_event->image))) {
                    unlink(public_path($academy_event->image));
                }
                $academy_event->forceDelete();
                return redirect()->back()->with('message', 'Event Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Event is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Event Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Event***********/
    public function restore(Request $request,Academy $academy, $academy_event)
    {
        if($academy->id != $academy_event->academy_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        $academy_event = Event::withTrashed()->find($academy_event);
        if ($academy_event->trashed()) {
            $academy_event->restore();
            return redirect()->back()->with('message', 'Event Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Event Not Found')->with('message_type', 'error');
        }
    }
}
