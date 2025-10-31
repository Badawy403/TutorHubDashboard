<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\PostsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Posts\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\PostsImport;
use App\Models\Post;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class PostsController extends Controller
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
            $posts =  Post::withAll();
            if ($req->trash && $req->trash == 'with') {
                $posts =  $posts->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $posts =  $posts->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $posts = $posts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $posts = $posts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $posts = $posts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $posts = $posts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $posts = $posts->get();
                return $posts;
            }
            $posts = $posts->get();
            return $posts;
        }
        $posts = Post::withAll()->orderBy('id', 'desc')->get();
        return $posts;
    }


    /*********View All Posts  ***********/
    public function index(Request $request)
    {
        $posts = $this->getter($request, null);
        return view('super_admins.posts.index', compact('posts'));
    }

    /*********View Create Form of Post  ***********/
    public function create()
    {
        $blog_categories = BlogCategory::active()->get();
        $tags = Tag::active()->get();
        return view('super_admins.posts.create', compact('blog_categories', 'tags'));
    }

    /*********Store Post  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['created_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request, 'image', 'posts');
            $post = Post::create($data);
            $post->slug = Str::slug($post->name . ' ' . $post->id, '-');
            $post->save();
            $post = Post::withAll()->find($post->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.posts.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.posts.index')->with('message', 'Post Created Successfully')->with('message_type', 'success');
    }

    /*********View Post  ***********/
    public function show(Post $post)
    {
        return view('super_admins.posts.show', compact('post'));
    }

    /*********View Edit Form of Post  ***********/
    public function edit(Post $post)
    {
        $blog_categories = BlogCategory::active()->get();
        $tags = Tag::active()->get();
        return view('super_admins.posts.edit', compact('post', 'blog_categories', 'tags'));
    }

    /*********Update Post  ***********/
    public function update(CreateRequest $request, Post $post)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['last_updated_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request, 'image', 'posts', $post->image);
            } else {
                $data['image'] = $post->image;
            }
            $post->update($data);
            $post = Post::find($post->id);
            $slug = Str::slug($post->name . ' ' . $post->id, '-');
            $post->update([
                'slug' => $slug
            ]);
            $post->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.posts.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.posts.index')->with('message', 'Post Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $posts = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "posts." . $extension;
        return Excel::download(new PostsExport($posts), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new PostsImport, $file);
        return redirect()->back()->with('message', 'Post imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Post ***********/
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->with('message', 'Post Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Post ***********/
    public function destroyPermanently(Request $request, $post)
    {
        $post = Post::withTrashed()->find($post);
        if ($post) {
            if ($post->trashed()) {
                if ($post->image && file_exists(public_path($post->image))) {
                    unlink(public_path($post->image));
                }
                $post->forceDelete();
                return redirect()->back()->with('message', 'Post Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Post Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Post Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Post***********/
    public function restore(Request $request, $post)
    {
        $post = Post::withTrashed()->find($post);
        if ($post->trashed()) {
            $post->restore();
            return redirect()->back()->with('message', 'Post Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Post Category Not Found')->with('message_type', 'error');
        }
    }
}
