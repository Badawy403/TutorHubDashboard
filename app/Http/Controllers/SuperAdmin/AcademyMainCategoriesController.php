<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\AcademyMainCategoriesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\AcademyMainCategories\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\AcademyMainCategoriesImport;
use App\Models\AcademyMainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AcademyMainCategoriesController extends Controller
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
            $academy_main_categories =  AcademyMainCategory::withAll();
            if ($req->trash && $req->trash == 'with') {
                $academy_main_categories =  $academy_main_categories->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $academy_main_categories =  $academy_main_categories->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $academy_main_categories = $academy_main_categories->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $academy_main_categories = $academy_main_categories->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $academy_main_categories = $academy_main_categories->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $academy_main_categories = $academy_main_categories->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $academy_main_categories = $academy_main_categories->get();
                return $academy_main_categories;
            }
            $academy_main_categories = $academy_main_categories->get();
            return $academy_main_categories;
        }
        $academy_main_categories = AcademyMainCategory::withAll()->orderBy('id', 'desc')->get();
        return $academy_main_categories;
    }


    /*********View All AcademyMainCategories  ***********/
    public function index(Request $request)
    {
        $academy_main_categories = $this->getter($request);
        return view('super_admins.academy_main_categories.index')->with('academy_main_categories', $academy_main_categories);
    }

    /*********View Create Form of AcademyMainCategory  ***********/
    public function create()
    {

        return view('super_admins.academy_main_categories.create');
    }

    /*********Store AcademyMainCategory  ***********/
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
            $data['image'] = uploadCroppedFile($request,'image','academy_main_categories');
            $data['icon'] = uploadCroppedFile($request,'icon','academy_main_categories');

            $academy_main_category = AcademyMainCategory::create($data);
            $academy_main_category->slug = Str::slug($academy_main_category->name . ' ' . $academy_main_category->id, '-');
            $academy_main_category->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academy_main_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academy_main_categories.index')->with('message', 'AcademyMainCategory Created Successfully')->with('message_type', 'success');
    }

    /*********View AcademyMainCategory  ***********/
    public function show(AcademyMainCategory $academy_main_category)
    {
        return view('super_admins.academy_main_categories.show', compact('academy_main_category'));
    }

    /*********View Edit Form of AcademyMainCategory  ***********/
    public function edit(AcademyMainCategory $academy_main_category)
    {
        return view('super_admins.academy_main_categories.edit', compact('academy_main_category'));
    }

    /*********Update AcademyMainCategory  ***********/
    public function update(CreateRequest $request, AcademyMainCategory $academy_main_category)
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
                $data['image'] = uploadCroppedFile($request,'image','academy_main_categories',$academy_main_category->image);
            } else {
                $data['image'] = $academy_main_category->image;
            }
            if ($request->icon) {
                $data['icon'] = uploadCroppedFile($request,'icon','academy_main_categories',$academy_main_category->icon);
            } else {
                $data['icon'] = $academy_main_category->icon;
            }
            $academy_main_category->update($data);
            $academy_main_category = AcademyMainCategory::find($academy_main_category->id);
            $slug = Str::slug($academy_main_category->name . ' ' . $academy_main_category->id, '-');
            $academy_main_category->update([
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academy_main_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academy_main_categories.index')->with('message', 'AcademyMainCategory Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $academy_main_categories = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "academy_main_categories." . $extension;
        return Excel::download(new AcademyMainCategoriesExport($academy_main_categories), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new AcademyMainCategoriesImport, $file);
        return redirect()->back()->with('message', 'Academy Main Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE AcademyMainCategory ***********/
    public function destroy(AcademyMainCategory $academy_main_category)
    {
        $academy_main_category->delete();
        return redirect()->back()->with('message', 'AcademyMainCategory Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE AcademyMainCategory ***********/
    public function destroyPermanently(Request $request, $academy_main_category)
    {
        $academy_main_category = AcademyMainCategory::withTrashed()->find($academy_main_category);
        if ($academy_main_category) {
            if ($academy_main_category->trashed()) {
                if ($academy_main_category->image && file_exists(public_path($academy_main_category->image))) {
                    unlink(public_path($academy_main_category->image));
                }
                $academy_main_category->forceDelete();
                return redirect()->back()->with('message', 'Academy Main Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Academy Main Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Academy Main Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore AcademyMainCategory***********/
    public function restore(Request $request, $academy_main_category)
    {
        $academy_main_category = AcademyMainCategory::withTrashed()->find($academy_main_category);
        if ($academy_main_category->trashed()) {
            $academy_main_category->restore();
            return redirect()->back()->with('message', 'Academy Main Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Academy Main Category Not Found')->with('message_type', 'error');
        }
    }
}
