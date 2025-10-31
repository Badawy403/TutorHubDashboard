<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\FAQCategoriesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\FAQCategories\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\FAQCategoriesImport;
use App\Models\FAQCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class FAQCategoriesController extends Controller
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
            $faq_categories =  FAQCategory::withAll();
            if ($req->trash && $req->trash == 'with') {
                $faq_categories =  $faq_categories->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $faq_categories =  $faq_categories->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $faq_categories = $faq_categories->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $faq_categories = $faq_categories->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $faq_categories = $faq_categories->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $faq_categories = $faq_categories->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $faq_categories = $faq_categories->get();
                return $faq_categories;
            }
            $faq_categories = $faq_categories->get();
            return $faq_categories;
        }
        $faq_categories = FAQCategory::withAll()->orderBy('id', 'desc')->get();
        return $faq_categories;
    }


    /*********View All FAQCategories  ***********/
    public function index(Request $request)
    {
        $faq_categories = $this->getter($request);
        return view('super_admins.faq_categories.index')->with('faq_categories', $faq_categories);
    }

    /*********View Create Form of FAQCategory  ***********/
    public function create()
    {
        return view('super_admins.faq_categories.create');
    }

    /*********Store FAQCategory  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','faq_categories');

            $faq_category = FAQCategory::create($data);
            $faq_category->slug = Str::slug($faq_category->name . ' ' . $faq_category->id, '-');
            $faq_category->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.faq_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.faq_categories.index')->with('message', 'FAQCategory Created Successfully')->with('message_type', 'success');
    }

    /*********View FAQCategory  ***********/
    public function show(FAQCategory $faq_category)
    {
        return view('super_admins.faq_categories.show', compact('faq_category'));
    }

    /*********View Edit Form of FAQCategory  ***********/
    public function edit(FAQCategory $faq_category)
    {
        return view('super_admins.faq_categories.edit', compact('faq_category'));
    }

    /*********Update FAQCategory  ***********/
    public function update(CreateRequest $request, FAQCategory $faq_category)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','faq_categories',$faq_category->image);

            } else {
                $data['image'] = $faq_category->image;
            }
            $faq_category->update($data);
            $faq_category = FAQCategory::find($faq_category->id);
            $slug = Str::slug($faq_category->name . ' ' . $faq_category->id, '-');
            $faq_category->update([
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.faq_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.faq_categories.index')->with('message', 'FAQCategory Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $faq_categories = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "faq_categories." . $extension;
        return Excel::download(new FAQCategoriesExport($faq_categories), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new FAQCategoriesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE FAQCategory ***********/
    public function destroy(FAQCategory $faq_category)
    {
        // if ($faq_category->Has('posts')) {
        //     $faq_category->news()->delete();
        // }
        $faq_category->delete();
        return redirect()->back()->with('message', 'FAQCategory Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE FAQCategory ***********/
    public function destroyPermanently(Request $request, $faq_category)
    {
        $faq_category = FAQCategory::withTrashed()->find($faq_category);
        if ($faq_category) {
            if ($faq_category->trashed()) {
                if ($faq_category->image && file_exists(public_path($faq_category->image))) {
                    unlink(public_path($faq_category->image));
                }
                $faq_category->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore FAQCategory***********/
    public function restore(Request $request, $faq_category)
    {
        $faq_category = FAQCategory::withTrashed()->find($faq_category);
        if ($faq_category->trashed()) {
            $faq_category->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
