<?php

namespace App\Http\Controllers\Academies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Broadcast;
use App\Http\Requests\Academies\AcademyBroadcasts\CreateRequest;
use App\Http\Resources\Web\BroadcastsResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AcademyBroadcastsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('academy');
        // $this->middleware('permission:academy_broadcasts.index');
        // $this->middleware('permission:academy_broadcasts.create',['only' => ['store']]);
        // $this->middleware('permission:academy_broadcasts.update',['only' => ['update']]);
        // $this->middleware('permission:academy_broadcasts.delete',['only' => ['destroy']]);
        // $this->middleware('permission:academy_broadcasts.export',['only' => ['export']]);
        // $this->middleware('permission:academy_broadcasts.import',['only' => ['import']])
        // $this->middleware('permission:academy_broadcasts.update|academy_broadcasts.is_active',['only' => ['updateStatus']]);
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        $academy = auth()->user()->academy;
        if ($req != null) {
            $academy_broadcasts =  $academy->academy_broadcasts()->withAll();
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
            if ($req->sort && $req->sort['field'] != null && $req->sort['type'] != null) {
                $academy_broadcasts = $academy_broadcasts->OrderBy($req->sort['field'], $req->sort['type']);
            } else {
                $academy_broadcasts = $academy_broadcasts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $academy_broadcasts = $academy_broadcasts->get();
                return $academy_broadcasts;
            }
            $totalAcademyBroadcasts = $academy_broadcasts->count();
            $academy_broadcasts = $academy_broadcasts->paginate($req->perPage);
            $academy_broadcasts = BroadcastsResource::collection($academy_broadcasts)->response()->getData(true);

            return $academy_broadcasts;
        }
        $academy_broadcasts = BroadcastsResource::collection($academy->academy_broadcasts()->withAll()->orderBy('id', 'desc')->paginate(10))->response()->getData(true);
        return $academy_broadcasts;
    }

    /********* FETCH ALL AcademyBroadcasts ***********/
    public function index()
    {
        $academy_broadcasts =  $this->getter();
        $response = generateResponse($academy_broadcasts, count($academy_broadcasts['data']) > 0 ? true : false, 'AcademyBroadcasts Fetched Successfully', null, 'collection');
        return response()->json($response, 200);
    }

    /********* FILTER AcademyBroadcasts FOR Search ***********/
    public function filter(Request $request)
    {
        $academy_broadcasts = $this->getter($request);
        $response = generateResponse($academy_broadcasts, count($academy_broadcasts['data']) > 0 ? true : false, 'Filter AcademyBroadcasts Successfully', null, 'collection');
        return response()->json($response, 200);
    }

    /********* ADD NEW AcademyBroadcast ***********/
    public function store(CreateRequest $request)
    {
        $academy = auth()->user()->academy;
        try {
            DB::beginTransaction();
            $request->merge(['created_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request, 'image', 'academy_broadcasts');
            $data['audio'] = uploadFile($request, 'audio', 'academy_broadcasts');
            $data['video'] = uploadFile($request, 'video', 'academy_broadcasts');
            $academy_broadcast = $academy->academy_broadcasts()->create($data);
            $academy_broadcast->slug = Str::slug($academy_broadcast->name . ' ' . $academy_broadcast->id, '-');
            $academy_broadcast->save();
            $academy_broadcast->tags()->sync($request->tag_ids);
            $academy_broadcast = $academy->academy_broadcasts()->withAll()->find($academy_broadcast->id);
            $academy_broadcast = new BroadcastsResource($academy_broadcast);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
        }
        return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show($academy_broadcast)
    {
        $academy = auth()->user()->academy;
        if ($academy_broadcast->academy_id != $academy->id) {
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $academy_broadcast = $academy->academy_broadcasts()->withAll()->find($academy_broadcast);
        if ($academy_broadcast) {
            $academy_broadcast = new BroadcastsResource($academy_broadcast);
            $response = generateResponse($academy_broadcast, true, 'AcademyBroadcast Fetched Successfully', null, 'object');
        } else {
            $response = generateResponse(null, false, 'AcademyBroadcast Not FOund', null, 'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE AcademyBroadcast ***********/
    public function update(CreateRequest $request, Broadcast $academy_broadcast)
    {
        // dd($request->all());
        $academy = auth()->user()->academy;
        if ($academy_broadcast->academy_id != $academy->id) {
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
                $data['image'] = uploadCroppedFile($request, 'image', 'academy_broadcasts', $academy_broadcast->image);
            } else {
                $data['image'] = $academy_broadcast->image;
            }

            if ($request->audio) {
                $data['audio'] = uploadFile($request, 'audio', 'academy_broadcasts');
            } else {
                $data['audio'] = $academy_broadcast->audio;
            }

            if ($request->video) {
                $data['video'] = uploadFile($request, 'video', 'academy_broadcasts');
            } else {
                $data['video'] = $academy_broadcast->video;
            }
            $academy_broadcast->update($data);
            $academy_broadcast = $academy_broadcast->find($academy_broadcast->id);
            $slug = Str::slug($academy_broadcast['name'] . ' ' . $academy_broadcast->id, '-');
            $academy_broadcast->update(
                [
                    'slug' => $slug
                ]
            );
            $academy_broadcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
        }
        return redirect()->back();
    }

    /********* UPDATE AcademyBroadcast Status***********/
    public function updateStatus(Request $request, Broadcast $academy_broadcast)
    {
        $academy = auth()->user()->academy;
        if ($academy_broadcast->academy_id != $academy->id) {
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $academy_broadcast->update([
            'is_active' => $academy_broadcast->is_active == 1 ? 0 : 1
        ]);
        $response = generateResponse(null, true, 'AcademyBroadcast Status Updated Successfully', null, 'object');
        return response()->json($response, 200);
    }


    /********* DELETE AcademyBroadcast ***********/
    public function destroy(Request $request, Broadcast $academy_broadcast)
    {
        $academy = auth()->user()->academy;
        if ($academy_broadcast->academy_id != $academy->id) {
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
            return redirect()->back();
        }
        if ($academy_broadcast->trashed()) {
            request()->session()->flash('alert', ['message' => 'Already in Trash', 'type' => 'error']);
        } else {
            $academy_broadcast->delete();
        }
        return redirect()->back();
    }
    /*********Permanently DELETE AcademyBroadcast ***********/
    public function destroyPermanently(Request $request, $academy_broadcast)
    {
        $academy = auth()->user()->academy;
        $academy_broadcast = $academy->academy_broadcasts()->withTrashed()->find($academy_broadcast);
        if ($academy_broadcast) {
            if ($academy_broadcast->academy_id != $academy->id) {
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
            if ($academy_broadcast->trashed()) {
                $academy_broadcast->forceDelete();
                $response = generateResponse(null, true, 'AcademyBroadcast Deleted Successfully', null, 'object');
            } else {
                $response = generateResponse(null, false, 'AcademyBroadcast is not in trash to delete permanently', null, 'object');
            }
        } else {
            $response = generateResponse(null, false, 'AcademyBroadcast not found', null, 'object');
        }
        return response()->json($response, 200);
    }
    /********* Restore AcademyBroadcast ***********/
    public function restore(Request $request, $academy_broadcast)
    {
        $academy = auth()->user()->academy;
        $academy_broadcast = $academy->academy_broadcasts()->withTrashed()->find($academy_broadcast);
        if ($academy_broadcast->trashed()) {
            $academy_broadcast->restore();
            $response = generateResponse(null, true, 'AcademyBroadcast Restored Successfully', null, 'object');
        } else {
            $response = generateResponse(null, false, 'AcademyBroadcast is not trashed', null, 'object');
        }
        return response()->json($response, 200);
    }
}
