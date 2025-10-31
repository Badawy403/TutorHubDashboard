<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\BroadcastsExport;
use App\Exports\SuperAdmin\TeacherPodcastsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Broadcasts\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\BroadcastsImport;
use App\Imports\SuperAdmin\TeacherPodcastsImport;
use App\Models\Broadcast;
use App\Models\BroadcastCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class BroadcastsController extends Controller
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
            $broadcasts = Broadcast::withAll();
            if ($req->trash && $req->trash == 'with') {
                $broadcasts =  $broadcasts->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $broadcasts =  $broadcasts->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $broadcasts = $broadcasts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $broadcasts = $broadcasts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $broadcasts = $broadcasts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $broadcasts = $broadcasts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $broadcasts = $broadcasts->get();
                return $broadcasts;
            }
            $broadcasts = $broadcasts->get();
            return $broadcasts;
        }
        $broadcasts = Broadcast::withAll()->orderBy('id', 'desc')->get();
        return $broadcasts;
    }


    /*********View All Podcasts  ***********/
    public function index(Request $request)
    {
        $broadcasts = $this->getter($request , null);
        return view('super_admins.broadcasts.index' , compact('broadcasts'));
    }

    /*********View Create Form of Broadcast  ***********/
    public function create()
    {
        $broadcast_categories = BroadcastCategory::active()->get();
        $tags = Tag::active()->get();
        return view('super_admins.broadcasts.create', compact('tags' , 'broadcast_categories'));
    }

    /*********Store Broadcast  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if($request->link_type == 'internal' && $request->file_type == 'audio'){
                $data['audio'] = uploadFile($request,'file','broadcasts');
            }else{
                $data['video'] = uploadFile($request,'file','broadcasts');
            }
            $data['image'] = uploadCroppedFile($request,'image','broadcasts');
            $broadcast = Broadcast::create($data);
            $broadcast->slug = Str::slug($broadcast->name . ' ' . $broadcast->id, '-');
            $broadcast->save();
            $broadcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.broadcasts.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.broadcasts.index')->with('message', 'Broadcast Created Successfully')->with('message_type', 'success');
    }

    /*********View Broadcast  ***********/
    public function show(Broadcast $broadcast)
    {
        return view('super_admins.broadcasts.show', compact('broadcast'));
    }

    /*********View Edit Form of Broadcast  ***********/
    public function edit(Broadcast $broadcast)
    {
        $broadcast_categories = BroadcastCategory::active()->get();
        return view('super_admins.broadcasts.edit', compact('broadcast' , 'broadcast_categories'));
    }

    /*********Update Broadcast  ***********/
    public function update(CreateRequest $request, Broadcast $broadcast)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if($request->link_type == 'internal' && $request->file_type == 'audio'){
                if($request->file){
                    $data['audio'] = uploadFile($request,'file','broadcasts');
                }else{
                    $data['audio'] = $broadcast->audio;
                }
            }else{
                if($request->file){
                    $data['video'] = uploadFile($request,'file','broadcasts');
                }else{
                    $data['video'] = $broadcast->video;
                }
            }
            $broadcast->update($data);
            $broadcast = Broadcast::find($broadcast->id);
            $slug = Str::slug($broadcast->name . ' ' . $broadcast->id, '-');
            $broadcast->update([
                'slug' => $slug
            ]);
            $broadcast->tags()->sync($request->tag_ids);
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','broadcasts',$broadcast->image);
            } else {
                $data['image'] = $broadcast->image;
            }
            $broadcast->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.broadcasts.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.broadcasts.index')->with('message', 'Broadcast Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $broadcasts = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "broadcasts." . $extension;
        return Excel::download(new BroadcastsExport($broadcasts), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new BroadcastsImport, $file);
        return redirect()->back()->with('message', 'Broadcast imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Broadcast ***********/
    public function destroy(Broadcast $broadcast)
    {
        $broadcast->delete();
        return redirect()->back()->with('message', 'Broadcast Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Broadcast ***********/
    public function destroyPermanently(Request $request,$broadcast)
    {
        $broadcast = Broadcast::withTrashed()->find($broadcast);
        if ($broadcast) {
            if ($broadcast->trashed()) {
                if ($broadcast->image && file_exists(public_path($broadcast->image))) {
                    unlink(public_path($broadcast->image));
                }
                $broadcast->forceDelete();
                return redirect()->back()->with('message', 'Broadcast Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Broadcast is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Broadcast***********/
    public function restore(Request $request,$broadcast)
    {
        $broadcast = Broadcast::withTrashed()->find($broadcast);
        if ($broadcast->trashed()) {
            $broadcast->restore();
            return redirect()->back()->with('message', 'Broadcast Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
    }
}
