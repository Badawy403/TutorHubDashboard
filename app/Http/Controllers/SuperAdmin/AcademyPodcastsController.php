<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\AcademyPodcastsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\AcademyPodcasts\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\AcademyPodcastsImport;
use App\Models\Podcast;
use App\Models\Academy;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class AcademyPodcastsController extends Controller
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
            $academy_podcasts =  $academy->academy_podcasts();
            if ($req->trash && $req->trash == 'with') {
                $academy_podcasts =  $academy_podcasts->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $academy_podcasts =  $academy_podcasts->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $academy_podcasts = $academy_podcasts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $academy_podcasts = $academy_podcasts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $academy_podcasts = $academy_podcasts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $academy_podcasts = $academy_podcasts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $academy_podcasts = $academy_podcasts->get();
                return $academy_podcasts;
            }
            $academy_podcasts = $academy_podcasts->get();
            return $academy_podcasts;
        }
        $academy_podcasts = $academy->academy_podcasts()->withAll()->orderBy('id', 'desc')->get();
        return $academy_podcasts;
    }


    /*********View All AcademyPodcasts  ***********/
    public function index(Request $request , Academy $academy)
    {
        $academy_podcasts = $this->getter($request , null , $academy);
        return view('super_admins.academies.academy_podcasts.index' , compact('academy_podcasts' , 'academy'));
    }

    /*********View Create Form of Podcast  ***********/
    public function create(Academy $academy)
    {
        $tags = Tag::active()->get();
        return view('super_admins.academies.academy_podcasts.create', compact('academy' , 'tags'));
    }

    /*********Store Podcast  ***********/
    public function store(CreateRequest $request , Academy $academy)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if($request->link_type == 'internal' && $request->file_type == 'audio'){
                $data['audio'] = uploadFile($request,'file','academy_podcasts');
            }else{
                $data['video'] = uploadFile($request,'file','academy_podcasts');
            }
            //$data['image'] = uploadCroppedFile($request,'image','academy_podcasts');
            $academy_podcast = $academy->academy_podcasts()->create($data);
            $academy_podcast->slug = Str::slug($academy_podcast->name . ' ' . $academy_podcast->id, '-');
            $academy_podcast->save();
            $academy_podcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academy_podcasts.index' , $academy->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academy_podcasts.index' , $academy->id)->with('message', 'Podcast Created Successfully')->with('message_type', 'success');
    }

    /*********View Podcast  ***********/
    public function show(Academy $academy ,Podcast $academy_podcast)
    {
        if($academy->id != $academy_podcast->academy_id){
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
        return view('super_admins.academies.academy_podcasts.show', compact('academy_podcast' , 'academy'));
    }

    /*********View Edit Form of Podcast  ***********/
    public function edit(Academy $academy ,Podcast $academy_podcast)
    {
        if($academy->id != $academy_podcast->academy_id){
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
        return view('super_admins.academies.academy_podcasts.edit', compact('academy_podcast', 'academy'));
    }

    /*********Update Podcast  ***********/
    public function update(CreateRequest $request,Academy $academy , Podcast $academy_podcast)
    {
        if($academy->id != $academy_podcast->academy_id){
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
                    $data['audio'] = uploadFile($request,'file','academy_podcasts');
                }else{
                    $data['audio'] = $academy_podcast->audio;
                }
            }else{
                if($request->file){
                    $data['video'] = uploadFile($request,'file','academy_podcasts');
                }else{
                    $data['video'] = $academy_podcast->video;
                }
            }
            $academy_podcast->update($data);
            $academy_podcast = Podcast::find($academy_podcast->id);
            $slug = Str::slug($academy_podcast->name . ' ' . $academy_podcast->id, '-');
            $academy_podcast->update([
                'slug' => $slug
            ]);
            $academy_podcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academy_podcasts.index' , $academy->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academy_podcasts.index' , $academy->id)->with('message', 'Podcast Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $academy_podcasts = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "academy_podcasts." . $extension;
        return Excel::download(new AcademyPodcastsExport($academy_podcasts), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new AcademyPodcastsImport, $file);
        return redirect()->back()->with('message', 'Podcast Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Podcast ***********/
    public function destroy(Academy $academy ,Podcast $academy_podcast)
    {
        if($academy->id != $academy_podcast->academy_id){
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
        $academy_podcast->delete();
        return redirect()->back()->with('message', 'Podcast Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Podcast ***********/
    public function destroyPermanently(Request $request,Academy $academy ,$academy_podcast)
    {
        $academy_podcast = Podcast::withTrashed()->find($academy_podcast);
        if ($academy_podcast) {
            if ($academy_podcast->trashed()) {
                if ($academy_podcast->image && file_exists(public_path($academy_podcast->image))) {
                    unlink(public_path($academy_podcast->image));
                }
                $academy_podcast->forceDelete();
                return redirect()->back()->with('message', 'Podcast Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Podcast is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Podcast***********/
    public function restore(Request $request,Academy $academy, $academy_podcast)
    {
        $academy_podcast = Podcast::withTrashed()->find($academy_podcast);
        if ($academy_podcast->trashed()) {
            $academy_podcast->restore();
            return redirect()->back()->with('message', 'Podcast Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
    }
}
