<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\AcademyBroadcastsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\AcademyBroadcasts\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\AcademyBroadcastsImport;
use App\Models\Broadcast;
use App\Models\Academy;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class AcademyBroadcastsController extends Controller
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
            $academy_broadcasts =  $academy->academy_broadcasts();
            if ($req->trash && $req->trash == 'with') {
                $academy_broadcasts =  $academy_broadcasts->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $academy_broadcasts =  $academy_broadcasts->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $academy_broadcasts = $academy_broadcasts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $academy_broadcasts = $academy_broadcasts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $academy_broadcasts = $academy_broadcasts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $academy_broadcasts = $academy_broadcasts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $academy_broadcasts = $academy_broadcasts->get();
                return $academy_broadcasts;
            }
            $academy_broadcasts = $academy_broadcasts->get();
            return $academy_broadcasts;
        }
        $academy_broadcasts = $academy->academy_broadcasts()->withAll()->orderBy('id', 'desc')->get();
        return $academy_broadcasts;
    }


    /*********View All AcademyBroadcasts  ***********/
    public function index(Request $request , Academy $academy)
    {
        $academy_broadcasts = $this->getter($request , null , $academy);
        return view('super_admins.academies.academy_broadcasts.index' , compact('academy_broadcasts' , 'academy'));
    }

    /*********View Create Form of Broadcast  ***********/
    public function create(Academy $academy)
    {
        $tags = Tag::active()->get();
        return view('super_admins.academies.academy_broadcasts.create', compact('academy' , 'tags'));
    }

    /*********Store Broadcast  ***********/
    public function store(CreateRequest $request , Academy $academy)
    {

        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if($request->link_type == 'internal' && $request->file_type == 'audio'){
                $data['audio'] = uploadFile($request,'file','academy_broadcasts');
            }else{
                $data['video'] = uploadFile($request,'file','academy_broadcasts');
            }
            //$data['image'] = uploadCroppedFile($request,'image','academy_broadcasts');
            $academy_broadcast = $academy->academy_broadcasts()->create($data);
            $academy_broadcast->slug = Str::slug($academy_broadcast->name . ' ' . $academy_broadcast->id, '-');
            $academy_broadcast->save();
            $academy_broadcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academy_broadcasts.index' , $academy->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academy_broadcasts.index' , $academy->id)->with('message', 'Broadcast Created Successfully')->with('message_type', 'success');
    }

    /*********View Broadcast  ***********/
    public function show(Academy $academy ,Broadcast $academy_broadcast)
    {
        if($academy->id != $academy_broadcast->academy_id){
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
        return view('super_admins.academies.academy_broadcasts.show', compact('academy_broadcast' , 'academy'));
    }

    /*********View Edit Form of Broadcast  ***********/
    public function edit(Academy $academy ,Broadcast $academy_broadcast)
    {
        if($academy->id != $academy_broadcast->academy_id){
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
        return view('super_admins.academies.academy_broadcasts.edit', compact('academy_broadcast', 'academy'));
    }

    /*********Update Broadcast  ***********/
    public function update(CreateRequest $request,Academy $academy , Broadcast $academy_broadcast)
    {
        if($academy->id != $academy_broadcast->academy_id){
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
                    $data['audio'] = uploadFile($request,'file','academy_broadcasts');
                }else{
                    $data['audio'] = $academy_broadcast->audio;
                }
            }else{
                if($request->file){
                    $data['video'] = uploadFile($request,'file','academy_broadcasts');
                }else{
                    $data['video'] = $academy_broadcast->video;
                }
            }
            $academy_broadcast->update($data);
            $academy_broadcast = Broadcast::find($academy_broadcast->id);
            $slug = Str::slug($academy_broadcast->name . ' ' . $academy_broadcast->id, '-');
            $academy_broadcast->update([
                'slug' => $slug
            ]);
            $academy_broadcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academy_broadcasts.index' , $academy->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academy_broadcasts.index' , $academy->id)->with('message', 'Broadcast Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $academy_broadcasts = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "academy_broadcasts." . $extension;
        return Excel::download(new AcademyBroadcastsExport($academy_broadcasts), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new AcademyBroadcastsImport, $file);
        return redirect()->back()->with('message', 'Broadcast Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Broadcast ***********/
    public function destroy(Academy $academy ,Broadcast $academy_broadcast)
    {
        if($academy->id != $academy_broadcast->academy_id){
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
        $academy_broadcast->delete();
        return redirect()->back()->with('message', 'Broadcast Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Broadcast ***********/
    public function destroyPermanently(Request $request,Academy $academy ,$academy_broadcast)
    {
        $academy_broadcast = Broadcast::withTrashed()->find($academy_broadcast);
        if ($academy_broadcast) {
            if ($academy_broadcast->trashed()) {
                if ($academy_broadcast->image && file_exists(public_path($academy_broadcast->image))) {
                    unlink(public_path($academy_broadcast->image));
                }
                $academy_broadcast->forceDelete();
                return redirect()->back()->with('message', 'Broadcast Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Broadcast is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Broadcast***********/
    public function restore(Request $request,Academy $academy, $academy_broadcast)
    {
        $academy_broadcast = Broadcast::withTrashed()->find($academy_broadcast);
        if ($academy_broadcast->trashed()) {
            $academy_broadcast->restore();
            return redirect()->back()->with('message', 'Broadcast Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
    }
}
