<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\PodcastsExport;
use App\Exports\SuperAdmin\TeacherPodcastsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Podcasts\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\PodcastsImport;
use App\Imports\SuperAdmin\TeacherPodcastsImport;
use App\Models\Podcast;
use App\Models\PodcastCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class PodcastsController extends Controller
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
            $podcasts = Podcast::withAll();
            if ($req->trash && $req->trash == 'with') {
                $podcasts =  $podcasts->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $podcasts =  $podcasts->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $podcasts = $podcasts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $podcasts = $podcasts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $podcasts = $podcasts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $podcasts = $podcasts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $podcasts = $podcasts->get();
                return $podcasts;
            }
            $podcasts = $podcasts->paginate(10);
            return $podcasts;
        }
        $podcasts = Podcast::withAll()->orderBy('id', 'desc')->paginate(10);
        return $podcasts;
    }


    /*********View All Podcasts  ***********/
    public function index(Request $request)
    {
        $podcasts = $this->getter($request , null);
        return view('super_admins.podcasts.index' , compact('podcasts'));
    }

    /*********View Create Form of Podcast  ***********/
    public function create()
    {
        $podcast_categories = PodcastCategory::active()->get();
        $tags = Tag::active()->get();
        return view('super_admins.podcasts.create', compact('tags' , 'podcast_categories'));
    }

    /*********Store Podcast  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if($request->link_type == 'internal' && $request->file_type == 'audio'){
                $data['audio'] = uploadFile($request,'file','podcasts');
            }else{
                $data['video'] = uploadFile($request,'file','podcasts');
            }
            $data['image'] = uploadCroppedFile($request,'image','podcasts');
            $podcast = Podcast::create($data);
            $podcast->slug = Str::slug($podcast->name . ' ' . $podcast->id, '-');
            $podcast->save();
            $podcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.podcasts.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.podcasts.index')->with('message', 'Podcast Created Successfully')->with('message_type', 'success');
    }

    /*********View Podcast  ***********/
    public function show(Podcast $podcast)
    {
        return view('super_admins.podcasts.show', compact('podcast'));
    }

    /*********View Edit Form of Podcast  ***********/
    public function edit(Podcast $podcast)
    {
        $podcast_categories = PodcastCategory::active()->get();
        return view('super_admins.podcasts.edit', compact('podcast' , 'podcast_categories'));
    }

    /*********Update Podcast  ***********/
    public function update(CreateRequest $request, Podcast $podcast)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if($request->link_type == 'internal' && $request->file_type == 'audio'){
                if($request->file){
                    $data['audio'] = uploadFile($request,'file','podcasts');
                }else{
                    $data['audio'] = $podcast->audio;
                }
            }else{
                if($request->file){
                    $data['video'] = uploadFile($request,'file','podcasts');
                }else{
                    $data['video'] = $podcast->video;
                }
            }
            $podcast->update($data);
            $podcast = Podcast::find($podcast->id);
            $slug = Str::slug($podcast->name . ' ' . $podcast->id, '-');
            $podcast->update([
                'slug' => $slug
            ]);
            $podcast->tags()->sync($request->tag_ids);
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','podcasts',$podcast->image);
            } else {
                $data['image'] = $podcast->image;
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.podcasts.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.podcasts.index')->with('message', 'Podcast Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $podcasts = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "podcasts." . $extension;
        return Excel::download(new PodcastsExport($podcasts), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new PodcastsImport, $file);
        return redirect()->back()->with('message', 'Podcast imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Podcast ***********/
    public function destroy(Podcast $podcast)
    {
        $podcast->delete();
        return redirect()->back()->with('message', 'Podcast Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Podcast ***********/
    public function destroyPermanently(Request $request,$podcast)
    {
        $podcast = Podcast::withTrashed()->find($podcast);
        if ($podcast) {
            if ($podcast->trashed()) {
                if ($podcast->image && file_exists(public_path($podcast->image))) {
                    unlink(public_path($podcast->image));
                }
                $podcast->forceDelete();
                return redirect()->back()->with('message', 'Podcast Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Podcast is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Podcast***********/
    public function restore(Request $request,$podcast)
    {
        $podcast = Podcast::withTrashed()->find($podcast);
        if ($podcast->trashed()) {
            $podcast->restore();
            return redirect()->back()->with('message', 'Podcast Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
    }
}
