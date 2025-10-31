<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\CountriesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Countries\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\CountriesImport;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class CountriesController extends Controller
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
            $countries =  Country::withAll();
            if ($req->trash && $req->trash == 'with') {
                $countries =  $countries->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $countries =  $countries->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $countries = $countries->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $countries = $countries->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $countries = $countries->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $countries = $countries->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $countries = $countries->get();
                return $countries;
            }
            $countries = $countries->get();
            return $countries;
        }
        $countries = Country::withAll()->orderBy('id', 'desc')->get();
        return $countries;
    }


    /*********View All Countries  ***********/
    public function index(Request $request)
    {
        $countries = $this->getter($request);
        return view('super_admins.countries.index')->with('countries', $countries);
    }

    /*********View Create Form of Country  ***********/
    public function create()
    {
        return view('super_admins.countries.create');
    }

    /*********Store Country  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','countries');

            $country = Country::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.countries.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.countries.index')->with('message', 'Country Created Successfully')->with('message_type', 'success');
    }

    /*********View Country  ***********/
    public function show(Country $country)
    {
        return view('super_admins.countries.show', compact('country'));
    }

    /*********View Edit Form of Country  ***********/
    public function edit(Country $country)
    {
        return view('super_admins.countries.edit', compact('country'));
    }

    /*********Update Country  ***********/
    public function update(CreateRequest $request, Country $country)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','countries',$country->image);
            } else {
                $data['image'] = $country->image;
            }
            $country->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.countries.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.countries.index')->with('message', 'Country Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $countries = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "countries." . $extension;
        return Excel::download(new CountriesExport($countries), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new CountriesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Country ***********/
    public function destroy(Country $country)
    {
        // if ($country->Has('posts')) {
        //     $country->news()->delete();
        // }
        $country->delete();
        return redirect()->back()->with('message', 'Country Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Country ***********/
    public function destroyPermanently(Request $request, $country)
    {
        $country = Country::withTrashed()->find($country);
        if ($country) {
            if ($country->trashed()) {
                if ($country->image && file_exists(public_path($country->image))) {
                    unlink(public_path($country->image));
                }
                $country->forceDelete();
                return redirect()->back()->with('message', 'Country Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Country is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Country Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Country***********/
    public function restore(Request $request, $country)
    {
        $country = Country::withTrashed()->find($country);
        if ($country->trashed()) {
            $country->restore();
            return redirect()->back()->with('message', 'Country Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Country Not Found')->with('message_type', 'error');
        }
    }
}
