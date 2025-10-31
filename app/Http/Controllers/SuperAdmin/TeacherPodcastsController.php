<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\TeacherPodcastsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\TeacherPodcasts\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\TeacherPodcastsImport;
use App\Models\Podcast;
use App\Models\Teacher;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class TeacherPodcastsController extends Controller
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
            $teacher_podcasts =  $teacher->teacher_podcasts();
            if ($req->trash && $req->trash == 'with') {
                $teacher_podcasts =  $teacher_podcasts->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $teacher_podcasts =  $teacher_podcasts->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $teacher_podcasts = $teacher_podcasts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $teacher_podcasts = $teacher_podcasts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $teacher_podcasts = $teacher_podcasts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $teacher_podcasts = $teacher_podcasts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $teacher_podcasts = $teacher_podcasts->get();
                return $teacher_podcasts;
            }
            $teacher_podcasts = $teacher_podcasts->get();
            return $teacher_podcasts;
        }
        $teacher_podcasts = $teacher->teacher_podcasts()->withAll()->orderBy('id', 'desc')->get();
        return $teacher_podcasts;
    }


    /*********View All TeacherPodcasts  ***********/
    public function index(Request $request , Teacher $teacher)
    {
        $teacher_podcasts = $this->getter($request , null , $teacher);
        return view('super_admins.teachers.teacher_podcasts.index' , compact('teacher_podcasts' , 'teacher'));
    }

    /*********View Create Form of Podcast  ***********/
    public function create(Teacher $teacher)
    {
        $tags = Tag::active()->get();
        return view('super_admins.teachers.teacher_podcasts.create', compact('teacher' , 'tags'));
    }

    /*********Store Podcast  ***********/
    public function store(CreateRequest $request , Teacher $teacher)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if($request->link_type == 'internal' && $request->file_type == 'audio'){
                $data['audio'] = uploadFile($request,'file','teacher_podcasts');
            }else{
                $data['video'] = uploadFile($request,'file','teacher_podcasts');
            }
            //$data['image'] = uploadCroppedFile($request,'image','teacher_podcasts');
            $teacher_podcast = $teacher->teacher_podcasts()->create($data);
            $teacher_podcast->slug = Str::slug($teacher_podcast->name . ' ' . $teacher_podcast->id, '-');
            $teacher_podcast->save();
            $teacher_podcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_podcasts.index' , $teacher->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_podcasts.index' , $teacher->id)->with('message', 'Podcast Created Successfully')->with('message_type', 'success');
    }

    /*********View Podcast  ***********/
    public function show(Teacher $teacher ,Podcast $teacher_podcast)
    {
        if($teacher->id != $teacher_podcast->teacher_id){
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
        return view('super_admins.teachers.teacher_podcasts.show', compact('teacher_podcast' , 'teacher'));
    }

    /*********View Edit Form of Podcast  ***********/
    public function edit(Teacher $teacher ,Podcast $teacher_podcast)
    {
        if($teacher->id != $teacher_podcast->teacher_id){
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
        return view('super_admins.teachers.teacher_podcasts.edit', compact('teacher_podcast', 'teacher'));
    }

    /*********Update Podcast  ***********/
    public function update(CreateRequest $request,Teacher $teacher , Podcast $teacher_podcast)
    {
        if($teacher->id != $teacher_podcast->teacher_id){
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if($request->link_type == 'internal' && $request->file_type == 'audio'){
                if($request->file){
                    $data['audio'] = uploadFile($request,'file','teacher_podcasts');
                }else{
                    $data['audio'] = $teacher_podcast->audio;
                }
            }else{
                if($request->file){
                    $data['video'] = uploadFile($request,'file','teacher_podcasts');
                }else{
                    $data['video'] = $teacher_podcast->video;
                }
            }
            $teacher_podcast->update($data);
            $teacher_podcast = Podcast::find($teacher_podcast->id);
            $slug = Str::slug($teacher_podcast->name . ' ' . $teacher_podcast->id, '-');
            $teacher_podcast->update([
                'slug' => $slug
            ]);
            $teacher_podcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_podcasts.index' , $teacher->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_podcasts.index' , $teacher->id)->with('message', 'Podcast Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $teacher_podcasts = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "teacher_podcasts." . $extension;
        return Excel::download(new TeacherPodcastsExport($teacher_podcasts), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new TeacherPodcastsImport, $file);
        return redirect()->back()->with('message', 'Podcast Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Podcast ***********/
    public function destroy(Teacher $teacher ,Podcast $teacher_podcast)
    {
        if($teacher->id != $teacher_podcast->teacher_id){
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
        $teacher_podcast->delete();
        return redirect()->back()->with('message', 'Podcast Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Podcast ***********/
    public function destroyPermanently(Request $request,Teacher $teacher ,$teacher_podcast)
    {
        $teacher_podcast = Podcast::withTrashed()->find($teacher_podcast);
        if ($teacher_podcast) {
            if ($teacher_podcast->trashed()) {
                if ($teacher_podcast->image && file_exists(public_path($teacher_podcast->image))) {
                    unlink(public_path($teacher_podcast->image));
                }
                $teacher_podcast->forceDelete();
                return redirect()->back()->with('message', 'Podcast Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Podcast is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Podcast***********/
    public function restore(Request $request,Teacher $teacher, $teacher_podcast)
    {
        $teacher_podcast = Podcast::withTrashed()->find($teacher_podcast);
        if ($teacher_podcast->trashed()) {
            $teacher_podcast->restore();
            return redirect()->back()->with('message', 'Podcast Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
    }
}
