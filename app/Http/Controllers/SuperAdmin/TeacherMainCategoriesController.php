<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\TeacherMainCategoriesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\TeacherMainCategories\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\TeacherMainCategoriesImport;
use App\Models\TeacherMainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class TeacherMainCategoriesController extends Controller
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
            $teacher_main_categories =  TeacherMainCategory::withAll();
            if ($req->trash && $req->trash == 'with') {
                $teacher_main_categories =  $teacher_main_categories->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $teacher_main_categories =  $teacher_main_categories->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $teacher_main_categories = $teacher_main_categories->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $teacher_main_categories = $teacher_main_categories->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $teacher_main_categories = $teacher_main_categories->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $teacher_main_categories = $teacher_main_categories->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $teacher_main_categories = $teacher_main_categories->get();
                return $teacher_main_categories;
            }
            $teacher_main_categories = $teacher_main_categories->get();
            return $teacher_main_categories;
        }
        $teacher_main_categories = TeacherMainCategory::withAll()->orderBy('id', 'desc')->get();
        return $teacher_main_categories;
    }


    /*********View All TeacherMainCategories  ***********/
    public function index(Request $request)
    {
        $teacher_main_categories = $this->getter($request);
        return view('super_admins.teacher_main_categories.index')->with('teacher_main_categories', $teacher_main_categories);
    }

    /*********View Create Form of TeacherMainCategory  ***********/
    public function create()
    {

        return view('super_admins.teacher_main_categories.create');
    }

    /*********Store TeacherMainCategory  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if (!$request->is_featured) {
                $data['is_featured'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','teacher_main_categories');
            $data['icon'] = uploadCroppedFile($request,'icon','teacher_main_categories');

            $teacher_main_category = TeacherMainCategory::create($data);
            $teacher_main_category->slug = Str::slug($teacher_main_category->name . ' ' . $teacher_main_category->id, '-');
            $teacher_main_category->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_main_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_main_categories.index')->with('message', 'TeacherMainCategory Created Successfully')->with('message_type', 'success');
    }

    /*********View TeacherMainCategory  ***********/
    public function show(TeacherMainCategory $teacher_main_category)
    {
        return view('super_admins.teacher_main_categories.show', compact('teacher_main_category'));
    }

    /*********View Edit Form of TeacherMainCategory  ***********/
    public function edit(TeacherMainCategory $teacher_main_category)
    {
        return view('super_admins.teacher_main_categories.edit', compact('teacher_main_category'));
    }

    /*********Update TeacherMainCategory  ***********/
    public function update(CreateRequest $request, TeacherMainCategory $teacher_main_category)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if (!$request->is_featured) {
                $data['is_featured'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','teacher_main_categories',$teacher_main_category->image);
            } else {
                $data['image'] = $teacher_main_category->image;
            }
            if ($request->icon) {
                $data['icon'] = uploadCroppedFile($request,'icon','teacher_main_categories',$teacher_main_category->icon);
            } else {
                $data['icon'] = $teacher_main_category->icon;
            }
            $teacher_main_category->update($data);
            $teacher_main_category = TeacherMainCategory::find($teacher_main_category->id);
            $slug = Str::slug($teacher_main_category->name . ' ' . $teacher_main_category->id, '-');
            $teacher_main_category->update([
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_main_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_main_categories.index')->with('message', 'TeacherMainCategory Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $teacher_main_categories = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "teacher_main_categories." . $extension;
        return Excel::download(new TeacherMainCategoriesExport($teacher_main_categories), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new TeacherMainCategoriesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE TeacherMainCategory ***********/
    public function destroy(TeacherMainCategory $teacher_main_category)
    {
        $teacher_main_category->delete();
        return redirect()->back()->with('message', 'TeacherMainCategory Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE TeacherMainCategory ***********/
    public function destroyPermanently(Request $request, $teacher_main_category)
    {
        $teacher_main_category = TeacherMainCategory::withTrashed()->find($teacher_main_category);
        if ($teacher_main_category) {
            if ($teacher_main_category->trashed()) {
                if ($teacher_main_category->image && file_exists(public_path($teacher_main_category->image))) {
                    unlink(public_path($teacher_main_category->image));
                }
                $teacher_main_category->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore TeacherMainCategory***********/
    public function restore(Request $request, $teacher_main_category)
    {
        $teacher_main_category = TeacherMainCategory::withTrashed()->find($teacher_main_category);
        if ($teacher_main_category->trashed()) {
            $teacher_main_category->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
