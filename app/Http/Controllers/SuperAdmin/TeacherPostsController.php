<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\PostsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Posts\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\PostsImport;
use App\Models\Post;
use App\Models\Teacher;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class TeacherPostsController extends Controller
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
            $teacher_posts =  $teacher->teacher_posts();
            if ($req->trash && $req->trash == 'with') {
                $teacher_posts =  $teacher_posts->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $teacher_posts =  $teacher_posts->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $teacher_posts = $teacher_posts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $teacher_posts = $teacher_posts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $teacher_posts = $teacher_posts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $teacher_posts = $teacher_posts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $teacher_posts = $teacher_posts->get();
                return $teacher_posts;
            }
            $teacher_posts = $teacher_posts->get();
            return $teacher_posts;
        }
        $teacher_posts = $teacher->teacher_posts()->withAll()->orderBy('id', 'desc')->get();
        return $teacher_posts;
    }


    /*********View All Posts  ***********/
    public function index(Request $request , Teacher $teacher)
    {
        $teacher_posts = $this->getter($request , null , $teacher);
        return view('super_admins.teachers.teacher_posts.index' , compact('teacher_posts' , 'teacher'));
    }

    /*********View Create Form of Post  ***********/
    public function create(Teacher $teacher)
    {
        $blog_categories = BlogCategory::active()->get();
        $tags = Tag::active()->get();
        
        return view('super_admins.teachers.teacher_posts.create', compact('blog_categories' , 'teacher' , 'tags'));
    }

    /*********Store Post  ***********/
    public function store(CreateRequest $request , Teacher $teacher)
    {
        
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['created_by_user_id'=>auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request,'image','teacher_posts');
            $teacher_post = $teacher->teacher_posts()->create($data);
            $teacher_post->slug = Str::slug($teacher_post->name . ' ' . $teacher_post->id, '-');
            $teacher_post->save();
            $teacher_post = $teacher->teacher_posts()->withAll()->find($teacher_post->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_posts.index' , $teacher->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_posts.index' , $teacher->id)->with('message', 'Post Created Successfully')->with('message_type', 'success');
    }

    /*********View Post  ***********/
    public function show(Teacher $teacher ,Post $teacher_post)
    {
        if($teacher->id != $teacher_post->teacher_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        return view('super_admins.teachers.teacher_posts.show', compact('teacher_post' , 'teacher'));
    }

    /*********View Edit Form of Post  ***********/
    public function edit(Teacher $teacher ,Post $teacher_post)
    {
        if($teacher->id != $teacher_post->teacher_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        $blog_categories = BlogCategory::active()->get();
        $tags = Tag::active()->get();
        return view('super_admins.teachers.teacher_posts.edit', compact('teacher_post','blog_categories' , 'teacher' , 'tags'));
    }

    /*********Update Post  ***********/
    public function update(CreateRequest $request,Teacher $teacher , Post $teacher_post)
    {
        if($teacher->id != $teacher_post->teacher_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
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
                $data['image'] = uploadCroppedFile($request,'image','teacher_posts',$teacher_post->image);
            } else {
                $data['image'] = $teacher_post->image;
            }
            $teacher_post->update($data);
            $teacher_post = Post::find($teacher_post->id);
            $slug = Str::slug($teacher_post->name . ' ' . $teacher_post->id, '-');
            $teacher_post->update([
                'slug' => $slug
            ]);
            $teacher_post->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_posts.index' , $teacher->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_posts.index' , $teacher->id)->with('message', 'Post Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $teacher_posts = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "teacher_posts." . $extension;
        return Excel::download(new PostsExport($teacher_posts), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new PostsImport, $file);
        return redirect()->back()->with('message', 'Post Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Post ***********/
    public function destroy(Teacher $teacher ,Post $teacher_post)
    {
        if($teacher->id != $teacher_post->teacher_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        $teacher_post->delete();
        return redirect()->back()->with('message', 'Post Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Post ***********/
    public function destroyPermanently(Request $request,Teacher $teacher ,$teacher_post)
    {
        if($teacher->id != $teacher_post->teacher_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        $teacher_post = Post::withTrashed()->find($teacher_post);
        if ($teacher_post) {
            if ($teacher_post->trashed()) {
                if ($teacher_post->image && file_exists(public_path($teacher_post->image))) {
                    unlink(public_path($teacher_post->image));
                }
                $teacher_post->forceDelete();
                return redirect()->back()->with('message', 'Post Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Post Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Post Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Post***********/
    public function restore(Request $request,Teacher $teacher, $teacher_post)
    {
        if($teacher->id != $teacher_post->teacher_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        $teacher_post = Post::withTrashed()->find($teacher_post);
        if ($teacher_post->trashed()) {
            $teacher_post->restore();
            return redirect()->back()->with('message', 'Post Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Post Category Not Found')->with('message_type', 'error');
        }
    }
}
