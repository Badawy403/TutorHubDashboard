<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\CompanyPagesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\CompanyPages\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\CompanyPagesImport;
use App\Models\CompanyPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class CompanyPagesController extends Controller
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
            $company_pages =  CompanyPage::withAll();
            if ($req->trash && $req->trash == 'with') {
                $company_pages =  $company_pages->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $company_pages =  $company_pages->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $company_pages = $company_pages->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $company_pages = $company_pages->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $company_pages = $company_pages->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $company_pages = $company_pages->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $company_pages = $company_pages->get();
                return $company_pages;
            }
            $company_pages = $company_pages->get();
            return $company_pages;
        }
        $company_pages = CompanyPage::withAll()->orderBy('id', 'desc')->get();
        return $company_pages;
    }


    /*********View All CompanyPages  ***********/
    public function index(Request $request)
    {
        $company_pages = $this->getter($request);
        return view('super_admins.company_pages.index')->with('company_pages', $company_pages);
    }

    /*********View Create Form of CompanyPage  ***********/
    public function create()
    {
        return view('super_admins.company_pages.create');
    }

    /*********Store CompanyPage  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','company_pages');
            $company_page = CompanyPage::create($data);
            $slug = Str::slug($company_page->name . ' ' . $company_page->id, '-');
            $exists = CompanyPage::where('slug' , $slug)->first();
            if($exists){
               $slug = $slug . '-'; 
            }
            $company_page->slug = $slug;
            $company_page->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.company_pages.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.company_pages.index')->with('message', 'CompanyPage Created Successfully')->with('message_type', 'success');
    }

    /*********View CompanyPage  ***********/
    public function show(CompanyPage $company_page)
    {
        return view('super_admins.company_pages.show', compact('company_page'));
    }

    /*********View Edit Form of CompanyPage  ***********/
    public function edit(CompanyPage $company_page)
    {

        return view('super_admins.company_pages.edit', compact('company_page'));
    }

    /*********Update CompanyPage  ***********/
    public function update(CreateRequest $request, CompanyPage $company_page)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','company_pages',$company_page->image);

            } else {
                $data['image'] = $company_page->image;
            }
            $company_page->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.company_pages.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.company_pages.index')->with('message', 'CompanyPage Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $company_pages = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "company_pages." . $extension;
        return Excel::download(new CompanyPagesExport($company_pages), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new CompanyPagesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE CompanyPage ***********/
    public function destroy(CompanyPage $company_page)
    {
        // if ($company_page->Has('posts')) {
        //     $company_page->news()->delete();
        // }
        $company_page->delete();
        return redirect()->back()->with('message', 'CompanyPage Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE CompanyPage ***********/
    public function destroyPermanently(Request $request, $company_page)
    {
        $company_page = CompanyPage::withTrashed()->find($company_page);
        if ($company_page) {
            if ($company_page->trashed()) {
                if ($company_page->image && file_exists(public_path($company_page->image))) {
                    unlink(public_path($company_page->image));
                }
                $company_page->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore CompanyPage***********/
    public function restore(Request $request, $company_page)
    {
        $company_page = CompanyPage::withTrashed()->find($company_page);
        if ($company_page->trashed()) {
            $company_page->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
