<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\PostsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Posts\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\PostsImport;
use App\Models\Post;
use App\Models\Academy;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AcademyPostsController extends Controller
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
            $academy_posts =  $academy->academy_posts();
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
            if ($req->sort_field != null && $req->sort_type != null) {
                $academy_posts = $academy_posts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $academy_posts = $academy_posts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $academy_posts = $academy_posts->get();
                return $academy_posts;
            }
            $academy_posts = $academy_posts->get();
            return $academy_posts;
        }
        $academy_posts = $academy->academy_posts()->withAll()->orderBy('id', 'desc')->get();
        return $academy_posts;
    }


    /*********View All Posts  ***********/
    public function index(Request $request , Academy $academy)
    {
        $academy_posts = $this->getter($request , null , $academy);
        return view('super_admins.academies.academy_posts.index' , compact('academy_posts' , 'academy'));
    }

    /*********View Create Form of Post  ***********/
    public function create(Academy $academy)
    {
        $blog_categories = BlogCategory::active()->get();
        $tags = Tag::active()->get();
        
        return view('super_admins.academies.academy_posts.create', compact('blog_categories' , 'academy' , 'tags'));
    }

    /*********Store Post  ***********/
    public function store(CreateRequest $request , Academy $academy)
    {
        
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['created_by_user_id'=>auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request,'image','academy_posts');
            $academy_post = $academy->academy_posts()->create($data);
            $academy_post->slug = Str::slug($academy_post->name . ' ' . $academy_post->id, '-');
            $academy_post->save();
            $academy_post = $academy->academy_posts()->withAll()->find($academy_post->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academy_posts.index' , $academy->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academy_posts.index' , $academy->id)->with('message', 'Post Created Successfully')->with('message_type', 'success');
    }

    /*********View Post  ***********/
    public function show(Academy $academy ,Post $academy_post)
    {
        if($academy->id != $academy_post->academy_id){
            return redirect()->back()->with('message', 'AcademyEducation Not Found')->with('message_type', 'error');
        }
        return view('super_admins.academies.academy_posts.show', compact('academy_post' , 'academy'));
    }

    /*********View Edit Form of Post  ***********/
    public function edit(Academy $academy ,Post $academy_post)
    {
        if($academy->id != $academy_post->academy_id){
            return redirect()->back()->with('message', 'AcademyEducation Not Found')->with('message_type', 'error');
        }
        $blog_categories = BlogCategory::active()->get();
        $tags = Tag::active()->get();
        return view('super_admins.academies.academy_posts.edit', compact('academy_post','blog_categories' , 'academy' , 'tags'));
    }

    /*********Update Post  ***********/
    public function update(CreateRequest $request,Academy $academy , Post $academy_post)
    {
        if($academy->id != $academy_post->academy_id){
            return redirect()->back()->with('message', 'AcademyEducation Not Found')->with('message_type', 'error');
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
                $data['image'] = uploadCroppedFile($request,'image','academy_posts',$academy_post->image);
            } else {
                $data['image'] = $academy_post->image;
            }
            $academy_post->update($data);
            $academy_post = Post::find($academy_post->id);
            $slug = Str::slug($academy_post->name . ' ' . $academy_post->id, '-');
            $academy_post->update([
                'slug' => $slug
            ]);
            $academy_post->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academy_posts.index' , $academy->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academy_posts.index' , $academy->id)->with('message', 'Post Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $academy_posts = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "academy_posts." . $extension;
        return Excel::download(new PostsExport($academy_posts), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new PostsImport, $file);
        return redirect()->back()->with('message', 'Post Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Post ***********/
    public function destroy(Academy $academy ,Post $academy_post)
    {
        if($academy->id != $academy_post->academy_id){
            return redirect()->back()->with('message', 'AcademyEducation Not Found')->with('message_type', 'error');
        }
        $academy_post->delete();
        return redirect()->back()->with('message', 'Post Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Post ***********/
    public function destroyPermanently(Request $request,Academy $academy ,$academy_post)
    {
        if($academy->id != $academy_post->academy_id){
            return redirect()->back()->with('message', 'AcademyEducation Not Found')->with('message_type', 'error');
        }
        $academy_post = Post::withTrashed()->find($academy_post);
        if ($academy_post) {
            if ($academy_post->trashed()) {
                if ($academy_post->image && file_exists(public_path($academy_post->image))) {
                    unlink(public_path($academy_post->image));
                }
                $academy_post->forceDelete();
                return redirect()->back()->with('message', 'Post Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Post Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Post Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Post***********/
    public function restore(Request $request,Academy $academy, $academy_post)
    {
        if($academy->id != $academy_post->academy_id){
            return redirect()->back()->with('message', 'AcademyEducation Not Found')->with('message_type', 'error');
        }
        $academy_post = Post::withTrashed()->find($academy_post);
        if ($academy_post->trashed()) {
            $academy_post->restore();
            return redirect()->back()->with('message', 'Post Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Post Category Not Found')->with('message_type', 'error');
        }
    }
}
