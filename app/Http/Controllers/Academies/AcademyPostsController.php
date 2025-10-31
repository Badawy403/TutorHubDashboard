<?php

namespace App\Http\Controllers\Academies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\Academies\AcademyPosts\CreateRequest;
use App\Http\Resources\Web\PostsResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AcademyPostsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('academy');
        // $this->middleware('permission:academy_posts.index');
        // $this->middleware('permission:academy_posts.create',['only' => ['store']]);
        // $this->middleware('permission:academy_posts.update',['only' => ['update']]);
        // $this->middleware('permission:academy_posts.delete',['only' => ['destroy']]);
        // $this->middleware('permission:academy_posts.export',['only' => ['export']]);
        // $this->middleware('permission:academy_posts.import',['only' => ['import']])
        // $this->middleware('permission:academy_posts.update|academy_posts.is_active',['only' => ['updateStatus']]);
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        $academy = auth()->user()->academy;
        if ($req != null) {
            $academy_posts =  $academy->academy_posts()->withAll();
            if ($req->trash && $req->trash == 'with') {
                $academy_posts =  $academy_posts->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $academy_posts =  $academy_posts->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $academy_posts = $academy_posts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $academy_posts = $academy_posts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort && $req->sort['field'] != null && $req->sort['type'] != null) {
                $academy_posts = $academy_posts->OrderBy($req->sort['field'], $req->sort['type']);
            } else {
                $academy_posts = $academy_posts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $academy_posts = $academy_posts->get();
                return $academy_posts;
            }
            $totalAcademyPosts = $academy_posts->count();
            $academy_posts = $academy_posts->paginate($req->perPage);
            $academy_posts = PostsResource::collection($academy_posts)->response()->getData(true);

            return $academy_posts;
        }
        $academy_posts = PostsResource::collection($academy->academy_posts()->withAll()->orderBy('id', 'desc')->paginate(10))->response()->getData(true);
        return $academy_posts;
    }

    /********* FETCH ALL AcademyPosts ***********/
    public function index()
    {
        $academy_posts =  $this->getter();
        $response = generateResponse($academy_posts, count($academy_posts['data']) > 0 ? true : false, 'AcademyPosts Fetched Successfully', null, 'collection');
        return response()->json($response, 200);
    }

    /********* FILTER AcademyPosts FOR Search ***********/
    public function filter(Request $request)
    {
        $academy_posts = $this->getter($request);
        $response = generateResponse($academy_posts, count($academy_posts['data']) > 0 ? true : false, 'Filter AcademyPosts Successfully', null, 'collection');
        return response()->json($response, 200);
    }

    /********* ADD NEW AcademyPost ***********/
    public function store(CreateRequest $request)
    {
        $academy = auth()->user()->academy;
        try {
            DB::beginTransaction();
            $request->merge(['created_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request, 'image', 'academy_posts');
            $academy_post = $academy->academy_posts()->create($data);
            $academy_post->slug = Str::slug($academy_post->name . ' ' . $academy_post->id, '-');
            $academy_post->save();
            $academy_post = $academy->academy_posts()->withAll()->find($academy_post->id);
            $academy_post = new PostsResource($academy_post);
            $academy_post->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
        }
        return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show($academy_post)
    {
        $academy = auth()->user()->academy;
        if ($academy_post->academy_id != $academy->id) {
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $academy_post = $academy->academy_posts()->withAll()->find($academy_post);
        if ($academy_post) {
            $academy_post = new PostsResource($academy_post);
            $response = generateResponse($academy_post, true, 'AcademyPost Fetched Successfully', null, 'object');
        } else {
            $response = generateResponse(null, false, 'AcademyPost Not FOund', null, 'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE AcademyPost ***********/
    public function update(CreateRequest $request, Post $academy_post)
    {
        // dd($request->all());
        $academy = auth()->user()->academy;
        if ($academy_post->academy_id != $academy->id) {
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
                $data['image'] = uploadCroppedFile($request, 'image', 'academy_posts', $academy_post->image);
            } else {
                $data['image'] = $academy_post->image;
            }
            $academy_post->update($data);
            $academy_post = $academy_post->find($academy_post->id);
            $slug = Str::slug($academy_post['name'] . ' ' . $academy_post->id, '-');
            $academy_post->update(
                [
                    'slug' => $slug
                ]
            );
            $academy_post->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
        }
        return redirect()->back();
    }

    /********* UPDATE AcademyPost Status***********/
    public function updateStatus(Request $request, Post $academy_post)
    {
        $academy = auth()->user()->academy;
        if ($academy_post->academy_id != $academy->id) {
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $academy_post->update([
            'is_active' => $academy_post->is_active == 1 ? 0 : 1
        ]);
        $response = generateResponse(null, true, 'AcademyPost Status Updated Successfully', null, 'object');
        return response()->json($response, 200);
    }


    /********* DELETE AcademyPost ***********/
    public function destroy(Request $request, Post $academy_post)
    {
        $academy = auth()->user()->academy;
        if ($academy_post->academy_id != $academy->id) {
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
            return redirect()->back();
        }
        if ($academy_post->trashed()) {
            request()->session()->flash('alert', ['message' => 'Already in Trash', 'type' => 'error']);
        } else {
            $academy_post->delete();
        }
        return redirect()->back();
    }
    /*********Permanently DELETE AcademyPost ***********/
    public function destroyPermanently(Request $request, $academy_post)
    {
        $academy = auth()->user()->academy;
        $academy_post = $academy->academy_posts()->withTrashed()->find($academy_post);
        if ($academy_post) {
            if ($academy_post->academy_id != $academy->id) {
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
            if ($academy_post->trashed()) {
                $academy_post->forceDelete();
                $response = generateResponse(null, true, 'AcademyPost Deleted Successfully', null, 'object');
            } else {
                $response = generateResponse(null, false, 'AcademyPost is not in trash to delete permanently', null, 'object');
            }
        } else {
            $response = generateResponse(null, false, 'AcademyPost not found', null, 'object');
        }
        return response()->json($response, 200);
    }
    /********* Restore AcademyPost ***********/
    public function restore(Request $request, $academy_post)
    {
        $academy = auth()->user()->academy;
        $academy_post = $academy->academy_posts()->withTrashed()->find($academy_post);
        if ($academy_post->trashed()) {
            $academy_post->restore();
            $response = generateResponse(null, true, 'AcademyPost Restored Successfully', null, 'object');
        } else {
            $response = generateResponse(null, false, 'AcademyPost is not trashed', null, 'object');
        }
        return response()->json($response, 200);
    }
}
