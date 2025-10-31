<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\AcademyCategoriesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\AcademyCategories\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\AcademyCategoriesImport;
use App\Models\AcademyCategory;
use App\Models\AcademyMainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AcademyCategoriesController extends Controller
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
            $academy_categories =  AcademyCategory::withAll();
            if ($req->trash && $req->trash == 'with') {
                $academy_categories =  $academy_categories->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $academy_categories =  $academy_categories->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $academy_categories = $academy_categories->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $academy_categories = $academy_categories->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $academy_categories = $academy_categories->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $academy_categories = $academy_categories->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $academy_categories = $academy_categories->get();
                return $academy_categories;
            }
            $academy_categories = $academy_categories->get();
            return $academy_categories;
        }
        $academy_categories = AcademyCategory::withAll()->orderBy('id', 'desc')->get();
        return $academy_categories;
    }


    /*********View All AcademyCategories  ***********/
    public function index(Request $request)
    {
        $academy_categories = $this->getter($request);
        return view('super_admins.academy_categories.index')->with('academy_categories', $academy_categories);
    }

    /*********View Create Form of AcademyCategory  ***********/
    public function create()
    {
        $academy_main_categories = AcademyMainCategory::active()->get();
        return view('super_admins.academy_categories.create',compact('academy_main_categories'));
    }

    /*********Store AcademyCategory  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','academy_categories');

            $academy_category = AcademyCategory::create($data);
            $academy_category->slug = Str::slug($academy_category->name . ' ' . $academy_category->id, '-');
            $academy_category->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academy_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academy_categories.index')->with('message', 'AcademyCategory Created Successfully')->with('message_type', 'success');
    }

    /*********View AcademyCategory  ***********/
    public function show(AcademyCategory $academy_category)
    {
        return view('super_admins.academy_categories.show', compact('academy_category'));
    }

    /*********View Edit Form of AcademyCategory  ***********/
    public function edit(AcademyCategory $academy_category)
    {
        $academy_main_categories = AcademyMainCategory::active()->get();
        return view('super_admins.academy_categories.edit', compact('academy_category','academy_main_categories'));
    }

    /*********Update AcademyCategory  ***********/
    public function update(CreateRequest $request, AcademyCategory $academy_category)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','academy_categories',$academy_category->image);
            } else {
                $data['image'] = $academy_category->image;
            }
            $academy_category->update($data);
            $academy_category = AcademyCategory::find($academy_category->id);
            $slug = Str::slug($academy_category->name . ' ' . $academy_category->id, '-');
            $academy_category->update([
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academy_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academy_categories.index')->with('message', 'AcademyCategory Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $academy_categories = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "academy_categories." . $extension;
        return Excel::download(new AcademyCategoriesExport($academy_categories), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new AcademyCategoriesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE AcademyCategory ***********/
    public function destroy(AcademyCategory $academy_category)
    {
        $academy_category->delete();
        return redirect()->back()->with('message', 'AcademyCategory Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE AcademyCategory ***********/
    public function destroyPermanently(Request $request, $academy_category)
    {
        $academy_category = AcademyCategory::withTrashed()->find($academy_category);
        if ($academy_category) {
            if ($academy_category->trashed()) {
                if ($academy_category->image && file_exists(public_path($academy_category->image))) {
                    unlink(public_path($academy_category->image));
                }
                $academy_category->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore AcademyCategory***********/
    public function restore(Request $request, $academy_category)
    {
        $academy_category = AcademyCategory::withTrashed()->find($academy_category);
        if ($academy_category->trashed()) {
            $academy_category->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
