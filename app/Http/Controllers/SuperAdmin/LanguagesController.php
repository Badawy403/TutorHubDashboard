<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\LanguagesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Languages\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\LanguagesImport;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class LanguagesController extends Controller
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
            $languages =  Language::withAll();
            if ($req->trash && $req->trash == 'with') {
                $languages =  $languages->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $languages =  $languages->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $languages = $languages->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $languages = $languages->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $languages = $languages->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $languages = $languages->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $languages = $languages->get();
                return $languages;
            }
            $languages = $languages->get();
            return $languages;
        }
        $languages = Language::withAll()->orderBy('id', 'desc')->get();
        return $languages;
    }


    /*********View All Languages  ***********/
    public function index(Request $request)
    {
        $languages = $this->getter($request);
        return view('super_admins.languages.index')->with('languages', $languages);
    }

    /*********View Create Form of Language  ***********/
    public function create()
    {
        return view('super_admins.languages.create');
    }

    /*********Store Language  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','languages');

            $language = Language::create($data);
            if ($language->is_default) {
                $language->update(['is_active', 1]);
                Language::where('id', '!=', $language->id)->update(['is_default' => 0]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.languages.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.languages.index')->with('message', 'Language Created Successfully')->with('message_type', 'success');
    }

    /*********View Language  ***********/
    public function show(Language $language)
    {
        return view('super_admins.languages.show', compact('language'));
    }

    /*********View Edit Form of Language  ***********/
    public function edit(Language $language)
    {
        return view('super_admins.languages.edit', compact('language'));
    }

    /*********Update Language  ***********/
    public function update(CreateRequest $request, Language $language)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','languages',$language->image);
            } else {
                $data['image'] = $language->image;
            }
            $language->update($data);
            if ($language->is_default) {
                $language->update(['is_active', 1]);
                Language::where('id', '!=', $language->id)->update(['is_default' => 0]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.languages.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.languages.index')->with('message', 'Language Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $languages = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "languages." . $extension;
        return Excel::download(new LanguagesExport($languages), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new LanguagesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Language ***********/
    public function destroy(Language $language)
    {
        if ($language->is_default) {
            return redirect()->back()->with('message', 'Cannot Delete Default Language')->with('message_type', 'error');
        }
        $language->delete();
        return redirect()->back()->with('message', 'Language Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Language ***********/
    public function destroyPermanently(Request $request, $language)
    {
        $language = Language::withTrashed()->find($language);
        if ($language) {
            if ($language->trashed()) {
                if ($language->image && file_exists(public_path($language->image))) {
                    unlink(public_path($language->image));
                }
                $language->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Language***********/
    public function restore(Request $request, $language)
    {
        $language = Language::withTrashed()->find($language);
        if ($language->trashed()) {
            $language->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
