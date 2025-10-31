<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\EventsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Events\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\EventsImport;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Teacher;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class TeacherEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null , $teacher)
    {
        if ($req != null) {
            $teacher_events =  $teacher->teacher_events();
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
            if ($req->sort_field != null && $req->sort_type != null) {
                $teacher_events = $teacher_events->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $teacher_events = $teacher_events->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $teacher_events = $teacher_events->get();
                return $teacher_events;
            }
            $teacher_events = $teacher_events->get();
            return $teacher_events;
        }
        $teacher_events = $teacher->teacher_events()->withAll()->orderBy('id', 'desc')->get();
        return $teacher_events;
    }


    /*********View All Events  ***********/
    public function index(Request $request , Teacher $teacher)
    {
        $teacher_events = $this->getter($request , null , $teacher);
        return view('super_admins.teachers.teacher_events.index' , compact('teacher_events' , 'teacher'));
    }

    /*********View Create Form of Event  ***********/
    public function create(Teacher $teacher)
    {
        $tags = Tag::active()->get();
        $event_categories = EventCategory::active()->get();
        return view('super_admins.teachers.teacher_events.create', compact('teacher' , 'tags' , 'event_categories'));
    }

    /*********Store Event  ***********/
    public function store(CreateRequest $request , Teacher $teacher)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['created_by_user_id'=>auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request,'image','teacher_events');
            $teacher_event = $teacher->teacher_events()->create($data);
            $teacher_event->slug = Str::slug($teacher_event->name . ' ' . $teacher_event->id, '-');
            $teacher_event->save();
            foreach ($request->sponsers as $sponser) {
                $image_url = uploadArrayFile($sponser ,'image','event_sponsers');
                $teacher_event->sponsers()->create([
                    'name' => $sponser['name'],
                    'image' => $image_url
                ]);
              }
            $teacher_event->tags()->sync($request->tag_ids);
            $teacher_event = $teacher->teacher_events()->withAll()->find($teacher_event->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_events.index' , $teacher->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_events.index' , $teacher->id)->with('message', 'Event Created Successfully')->with('message_type', 'success');
    }

    /*********View Event  ***********/
    public function show(Teacher $teacher ,Event $teacher_event)
    {
        if($teacher->id != $teacher_event->teacher_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        return view('super_admins.teachers.teacher_events.show', compact('teacher_event' , 'teacher'));
    }

    /*********View Edit Form of Event  ***********/
    public function edit(Teacher $teacher ,Event $teacher_event)
    {
        if($teacher->id != $teacher_event->teacher_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        $tags = Tag::active()->get();
        $event_categories = EventCategory::active()->get();
        return view('super_admins.teachers.teacher_events.edit', compact('teacher_event', 'teacher' , 'tags' , 'event_categories'));
    }

    /*********Update Event  ***********/
    public function update(CreateRequest $request,Teacher $teacher , Event $teacher_event)
    {
        if($teacher->id != $teacher_event->teacher_id){
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
                $data['image'] = uploadCroppedFile($request,'image','teacher_events',$teacher_event->image);
            } else {
                $data['image'] = $teacher_event->image;
            }
            $teacher_event->sponsers()->delete();
            foreach ($request->sponsers as $sponser) {
                if(isset($sponser['image'])){
                    if (is_string($sponser['image']) && $sponser['image'] != 'undefined') {
                        $image_url = $sponser['previous_image'];
                    }else{
                        $image_url = uploadArrayFile($sponser ,'image','event_sponsers');
                    }
                }
                $teacher_event->sponsers()->create([
                    'name' => $sponser['name'],
                    'image' => $image_url
                ]);
              }
              $teacher_event->update($data);
              $teacher_event = Event::find($teacher_event->id);
              $slug = Str::slug($teacher_event->name . ' ' . $teacher_event->id, '-');
              $teacher_event->update([
                  'slug' => $slug
              ]);
            $teacher_event->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_events.index' , $teacher->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_events.index' , $teacher->id)->with('message', 'Event Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $teacher_events = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "teacher_events." . $extension;
        return Excel::download(new EventsExport($teacher_events), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new EventsImport, $file);
        return redirect()->back()->with('message', 'Event Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Event ***********/
    public function destroy(Teacher $teacher ,Event $teacher_event)
    {
        if($teacher->id != $teacher_event->teacher_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        $teacher_event->delete();
        return redirect()->back()->with('message', 'Event Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Event ***********/
    public function destroyPermanently(Request $request,Teacher $teacher ,$teacher_event)
    {
        if($teacher->id != $teacher_event->teacher_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        $teacher_event = Event::withTrashed()->find($teacher_event);
        if ($teacher_event) {
            if ($teacher_event->trashed()) {
                if ($teacher_event->image && file_exists(public_path($teacher_event->image))) {
                    unlink(public_path($teacher_event->image));
                }
                $teacher_event->forceDelete();
                return redirect()->back()->with('message', 'Event Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Event is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Event Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Event***********/
    public function restore(Request $request,Teacher $teacher, $teacher_event)
    {
        if($teacher->id != $teacher_event->teacher_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        $teacher_event = Event::withTrashed()->find($teacher_event);
        if ($teacher_event->trashed()) {
            $teacher_event->restore();
            return redirect()->back()->with('message', 'Event Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Event Not Found')->with('message_type', 'error');
        }
    }
}
