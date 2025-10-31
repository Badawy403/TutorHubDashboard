<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\TeacherCategoriesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\TeacherCategories\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\TeacherCategoriesImport;
use App\Models\TeacherCategory;
use App\Models\TeacherMainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class TeacherCategoriesController extends Controller
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
            $teacher_categories =  TeacherCategory::withAll();
            if ($req->trash && $req->trash == 'with') {
                $teacher_categories =  $teacher_categories->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $teacher_categories =  $teacher_categories->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $teacher_categories = $teacher_categories->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $teacher_categories = $teacher_categories->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $teacher_categories = $teacher_categories->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $teacher_categories = $teacher_categories->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $teacher_categories = $teacher_categories->get();
                return $teacher_categories;
            }
            $teacher_categories = $teacher_categories->get();
            return $teacher_categories;
        }
        $teacher_categories = TeacherCategory::withAll()->orderBy('id', 'desc')->get();
        return $teacher_categories;
    }


    /*********View All TeacherCategories  ***********/
    public function index(Request $request)
    {
        $teacher_categories = $this->getter($request);
        return view('super_admins.teacher_categories.index')->with('teacher_categories', $teacher_categories);
    }

    /*********View Create Form of TeacherCategory  ***********/
    public function create()
    {
        $teacher_main_categories = TeacherMainCategory::active()->get();

        return view('super_admins.teacher_categories.create',compact('teacher_main_categories'));
    }

    /*********Store TeacherCategory  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','teacher_categories');

            $teacher_category = TeacherCategory::create($data);
            $teacher_category->slug = Str::slug($teacher_category->name . ' ' . $teacher_category->id, '-');
            $teacher_category->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_categories.index')->with('message', 'TeacherCategory Created Successfully')->with('message_type', 'success');
    }

    /*********View TeacherCategory  ***********/
    public function show(TeacherCategory $teacher_category)
    {
        return view('super_admins.teacher_categories.show', compact('teacher_category'));
    }

    /*********View Edit Form of TeacherCategory  ***********/
    public function edit(TeacherCategory $teacher_category)
    {
        $teacher_main_categories = TeacherMainCategory::active()->get();

        return view('super_admins.teacher_categories.edit', compact('teacher_category','teacher_main_categories'));
    }

    /*********Update TeacherCategory  ***********/
    public function update(CreateRequest $request, TeacherCategory $teacher_category)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','teacher_categories',$teacher_category->image);
            } else {
                $data['image'] = $teacher_category->image;
            }
            $teacher_category->update($data);
            $teacher_category = TeacherCategory::find($teacher_category->id);
            $slug = Str::slug($teacher_category->name . ' ' . $teacher_category->id, '-');
            $teacher_category->update([
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_categories.index')->with('message', 'TeacherCategory Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $teacher_categories = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "teacher_categories." . $extension;
        return Excel::download(new TeacherCategoriesExport($teacher_categories), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new TeacherCategoriesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE TeacherCategory ***********/
    public function destroy(TeacherCategory $teacher_category)
    {
        $teacher_category->delete();
        return redirect()->back()->with('message', 'TeacherCategory Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE TeacherCategory ***********/
    public function destroyPermanently(Request $request, $teacher_category)
    {
        $teacher_category = TeacherCategory::withTrashed()->find($teacher_category);
        if ($teacher_category) {
            if ($teacher_category->trashed()) {
                if ($teacher_category->image && file_exists(public_path($teacher_category->image))) {
                    unlink(public_path($teacher_category->image));
                }
                $teacher_category->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore TeacherCategory***********/
    public function restore(Request $request, $teacher_category)
    {
        $teacher_category = TeacherCategory::withTrashed()->find($teacher_category);
        if ($teacher_category->trashed()) {
            $teacher_category->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
