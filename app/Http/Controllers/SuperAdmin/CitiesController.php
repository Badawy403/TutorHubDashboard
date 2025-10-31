<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\CitiesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Cities\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\CitiesImport;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class CitiesController extends Controller
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
            $cities =  City::withAll();
            if ($req->trash && $req->trash == 'with') {
                $cities =  $cities->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $cities =  $cities->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $cities = $cities->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $cities = $cities->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $cities = $cities->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $cities = $cities->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $cities = $cities->get();
                return $cities;
            }
            $cities = $cities->get();
            return $cities;
        }
        $cities = City::withAll()->orderBy('id', 'desc')->get();
        return $cities;
    }


    /*********View All Cities  ***********/
    public function index(Request $request)
    {
        ini_set('memory_limit', '2048M');
        $cities = City::withAll();
        if($request->country_id){
            $cities = $cities->where('country_id',$request->country_id);
        $cities = $cities->get();
        return view('super_admins.cities.index',compact('cities'));
        }
        $countries = Country::get();
        return view('super_admins.cities.list',compact('countries'));
    }

    /*********View Create Form of City  ***********/
    public function create()
    {
        $countries = Country::get();
        $states = [];
        return view('super_admins.cities.create')->with('states', $states)->with('countries', $countries);
    }

    /*********Store City  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','cities');

            $city = City::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.cities.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.cities.index')->with('message', 'City Created Successfully')->with('message_type', 'success');
    }

    /*********View City  ***********/
    public function show(City $city)
    {
        return view('super_admins.cities.show', compact('city'));
    }

    /*********View Edit Form of City  ***********/
    public function edit(City $city)
    {
        $countries = Country::get();
        $states = State::where('country_id', $city->country_id ?? null)->get();
        return view('super_admins.cities.edit', compact('city', 'states', 'countries'));
    }

    /*********Update City  ***********/
    public function update(CreateRequest $request, City $city)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','cities',$city->image);
            } else {
                $data['image'] = $city->image;
            }
            $city->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.cities.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.cities.index')->with('message', 'City Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $cities = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "cities." . $extension;
        return Excel::download(new CitiesExport($cities), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new CitiesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE City ***********/
    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->back()->with('message', 'City Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE City ***********/
    public function destroyPermanently(Request $request, $city)
    {
        $city = City::withTrashed()->find($city);
        if ($city) {
            if ($city->trashed()) {
                if ($city->image && file_exists(public_path($city->image))) {
                    unlink(public_path($city->image));
                }
                $city->forceDelete();
                return redirect()->back()->with('message', 'City Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'City is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'City Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore City***********/
    public function restore(Request $request, $city)
    {
        $city = City::withTrashed()->find($city);
        if ($city->trashed()) {
            $city->restore();
            return redirect()->back()->with('message', 'City Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'City Not Found')->with('message_type', 'error');
        }
    }
}
