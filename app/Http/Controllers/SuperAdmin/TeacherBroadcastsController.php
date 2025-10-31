<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\TeacherBroadcastsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\TeacherBroadcasts\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\TeacherBroadcastsImport;
use App\Models\Broadcast;
use App\Models\Teacher;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class TeacherBroadcastsController extends Controller
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
            $teacher_broadcasts =  $teacher->teacher_broadcasts();
            if ($req->trash && $req->trash == 'with') {
                $teacher_broadcasts =  $teacher_broadcasts->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $teacher_broadcasts =  $teacher_broadcasts->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $teacher_broadcasts = $teacher_broadcasts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $teacher_broadcasts = $teacher_broadcasts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $teacher_broadcasts = $teacher_broadcasts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $teacher_broadcasts = $teacher_broadcasts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $teacher_broadcasts = $teacher_broadcasts->get();
                return $teacher_broadcasts;
            }
            $teacher_broadcasts = $teacher_broadcasts->get();
            return $teacher_broadcasts;
        }
        $teacher_broadcasts = $teacher->teacher_broadcasts()->withAll()->orderBy('id', 'desc')->get();
        return $teacher_broadcasts;
    }


    /*********View All TeacherBroadcasts  ***********/
    public function index(Request $request , Teacher $teacher)
    {
        $teacher_broadcasts = $this->getter($request , null , $teacher);
        return view('super_admins.teachers.teacher_broadcasts.index' , compact('teacher_broadcasts' , 'teacher'));
    }

    /*********View Create Form of Broadcast  ***********/
    public function create(Teacher $teacher)
    {
        $tags = Tag::active()->get();
        return view('super_admins.teachers.teacher_broadcasts.create', compact('teacher' , 'tags'));
    }

    /*********Store Broadcast  ***********/
    public function store(CreateRequest $request , Teacher $teacher)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if($request->link_type == 'internal' && $request->file_type == 'audio'){
                $data['audio'] = uploadFile($request,'file','teacher_broadcasts');
            }else{
                $data['video'] = uploadFile($request,'file','teacher_broadcasts');
            }
            //$data['image'] = uploadCroppedFile($request,'image','teacher_broadcasts');
            $teacher_broadcast = $teacher->teacher_broadcasts()->create($data);
            $teacher_broadcast->slug = Str::slug($teacher_broadcast->name . ' ' . $teacher_broadcast->id, '-');
            $teacher_broadcast->save();
            $teacher_broadcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_broadcasts.index' , $teacher->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_broadcasts.index' , $teacher->id)->with('message', 'Broadcast Created Successfully')->with('message_type', 'success');
    }

    /*********View Broadcast  ***********/
    public function show(Teacher $teacher ,Broadcast $teacher_broadcast)
    {
        if($teacher->id != $teacher_broadcast->teacher_id){
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
        return view('super_admins.teachers.teacher_broadcasts.show', compact('teacher_broadcast' , 'teacher'));
    }

    /*********View Edit Form of Broadcast  ***********/
    public function edit(Teacher $teacher ,Broadcast $teacher_broadcast)
    {
        if($teacher->id != $teacher_broadcast->teacher_id){
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
        return view('super_admins.teachers.teacher_broadcasts.edit', compact('teacher_broadcast', 'teacher'));
    }

    /*********Update Broadcast  ***********/
    public function update(CreateRequest $request,Teacher $teacher , Broadcast $teacher_broadcast)
    {
        if($teacher->id != $teacher_broadcast->teacher_id){
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if($request->link_type == 'internal' && $request->file_type == 'audio'){
                if($request->file){
                    $data['audio'] = uploadFile($request,'file','teacher_broadcasts');
                }else{
                    $data['audio'] = $teacher_broadcast->audio;
                }
            }else{
                if($request->file){
                    $data['video'] = uploadFile($request,'file','teacher_broadcasts');
                }else{
                    $data['video'] = $teacher_broadcast->video;
                }
            }
            $teacher_broadcast->update($data);
            $teacher_broadcast = Broadcast::find($teacher_broadcast->id);
            $slug = Str::slug($teacher_broadcast->name . ' ' . $teacher_broadcast->id, '-');
            $teacher_broadcast->update([
                'slug' => $slug
            ]);
            $teacher_broadcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_broadcasts.index' , $teacher->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_broadcasts.index' , $teacher->id)->with('message', 'Broadcast Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $teacher_broadcasts = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "teacher_broadcasts." . $extension;
        return Excel::download(new TeacherBroadcastsExport($teacher_broadcasts), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new TeacherBroadcastsImport, $file);
        return redirect()->back()->with('message', 'Broadcast Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Broadcast ***********/
    public function destroy(Teacher $teacher ,Broadcast $teacher_broadcast)
    {
        if($teacher->id != $teacher_broadcast->teacher_id){
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
        $teacher_broadcast->delete();
        return redirect()->back()->with('message', 'Broadcast Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Broadcast ***********/
    public function destroyPermanently(Request $request,Teacher $teacher ,$teacher_broadcast)
    {
        $teacher_broadcast = Broadcast::withTrashed()->find($teacher_broadcast);
        if ($teacher_broadcast) {
            if ($teacher_broadcast->trashed()) {
                if ($teacher_broadcast->image && file_exists(public_path($teacher_broadcast->image))) {
                    unlink(public_path($teacher_broadcast->image));
                }
                $teacher_broadcast->forceDelete();
                return redirect()->back()->with('message', 'Broadcast Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Broadcast is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Broadcast***********/
    public function restore(Request $request,Teacher $teacher, $teacher_broadcast)
    {
        $teacher_broadcast = Broadcast::withTrashed()->find($teacher_broadcast);
        if ($teacher_broadcast->trashed()) {
            $teacher_broadcast->restore();
            return redirect()->back()->with('message', 'Broadcast Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
    }
}
