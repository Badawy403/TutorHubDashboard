<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\BlogCategoriesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\BlogCategories\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\BlogCategoriesImport;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class BlogCategoriesController extends Controller
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
            $blog_categories =  BlogCategory::withAll();
            if ($req->trash && $req->trash == 'with') {
                $blog_categories =  $blog_categories->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $blog_categories =  $blog_categories->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $blog_categories = $blog_categories->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $blog_categories = $blog_categories->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $blog_categories = $blog_categories->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $blog_categories = $blog_categories->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $blog_categories = $blog_categories->get();
                return $blog_categories;
            }
            $blog_categories = $blog_categories->get();
            return $blog_categories;
        }
        $blog_categories = BlogCategory::withAll()->orderBy('id', 'desc')->get();
        return $blog_categories;
    }


    /*********View All BlogCategories  ***********/
    public function index(Request $request)
    {
        $blog_categories = $this->getter($request);
        return view('super_admins.blog_categories.index')->with('blog_categories', $blog_categories);
    }

    /*********View Create Form of BlogCategory  ***********/
    public function create()
    {
        return view('super_admins.blog_categories.create');
    }

    /*********Store BlogCategory  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','blog_categories');
            $blog_category = BlogCategory::create($data);
            $blog_category->slug = Str::slug($blog_category->name . ' ' . $blog_category->id, '-');
            $blog_category->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.blog_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.blog_categories.index')->with('message', 'BlogCategory Created Successfully')->with('message_type', 'success');
    }

    /*********View BlogCategory  ***********/
    public function show(BlogCategory $blog_category)
    {
        return view('super_admins.blog_categories.show', compact('blog_category'));
    }

    /*********View Edit Form of BlogCategory  ***********/
    public function edit(BlogCategory $blog_category)
    {
        return view('super_admins.blog_categories.edit', compact('blog_category'));
    }

    /*********Update BlogCategory  ***********/
    public function update(CreateRequest $request, BlogCategory $blog_category)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','blog_categories',$blog_category->image);
            } else {
                $data['image'] = $blog_category->image;
            }
            $blog_category->update($data);
            $blog_category = BlogCategory::find($blog_category->id);
            $slug = Str::slug($blog_category->name . ' ' . $blog_category->id, '-');
            $blog_category->update([
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.blog_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.blog_categories.index')->with('message', 'BlogCategory Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $blog_categories = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "blog_categories." . $extension;
        return Excel::download(new BlogCategoriesExport($blog_categories), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new BlogCategoriesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE BlogCategory ***********/
    public function destroy(BlogCategory $blog_category)
    {
        // if ($blog_category->Has('posts')) {
        //     $blog_category->news()->delete();
        // }
        $blog_category->delete();
        return redirect()->back()->with('message', 'BlogCategory Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE BlogCategory ***********/
    public function destroyPermanently(Request $request, $blog_category)
    {
        $blog_category = BlogCategory::withTrashed()->find($blog_category);
        if ($blog_category) {
            if ($blog_category->trashed()) {
                if ($blog_category->image && file_exists(public_path($blog_category->image))) {
                    unlink(public_path($blog_category->image));
                }
                $blog_category->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore BlogCategory***********/
    public function restore(Request $request, $blog_category)
    {
        $blog_category = BlogCategory::withTrashed()->find($blog_category);
        if ($blog_category->trashed()) {
            $blog_category->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
