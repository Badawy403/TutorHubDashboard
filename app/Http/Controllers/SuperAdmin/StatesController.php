<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\StatesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\States\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\StatesImport;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class StatesController extends Controller
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
            $states =  State::withAll();
            if ($req->trash && $req->trash == 'with') {
                $states =  $states->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $states =  $states->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $states = $states->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $states = $states->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $states = $states->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $states = $states->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $states = $states->get();
                return $states;
            }
            $states = $states->get();
            return $states;
        }
        $states = State::withAll()->orderBy('id', 'desc')->get();
        return $states;
    }


    /*********View All States  ***********/
    public function index(Request $request)
    {
        $states = $this->getter($request);
        return view('super_admins.states.index')->with('states', $states);
    }

    /*********View Create Form of State  ***********/
    public function create()
    {
        $countries = Country::get();
        return view('super_admins.states.create')->with('countries', $countries);
    }

    /*********Store State  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','states');

            $state = State::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.states.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.states.index')->with('message', 'State Created Successfully')->with('message_type', 'success');
    }

    /*********View State  ***********/
    public function show(State $state)
    {
        return view('super_admins.states.show', compact('state'));
    }

    /*********View Edit Form of State  ***********/
    public function edit(State $state)
    {
        $countries = Country::get();
        return view('super_admins.states.edit', compact('state', 'countries'));
    }

    /*********Update State  ***********/
    public function update(CreateRequest $request, State $state)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','states',$state->image);

            } else {
                $data['image'] = $state->image;
            }
            $state->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.states.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.states.index')->with('message', 'State Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $states = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "states." . $extension;
        return Excel::download(new StatesExport($states), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new StatesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE State ***********/
    public function destroy(State $state)
    {
        $state->delete();
        return redirect()->back()->with('message', 'State Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE State ***********/
    public function destroyPermanently(Request $request, $state)
    {
        $state = State::withTrashed()->find($state);
        if ($state) {
            if ($state->trashed()) {
                if ($state->image && file_exists(public_path($state->image))) {
                    unlink(public_path($state->image));
                }
                $state->forceDelete();
                return redirect()->back()->with('message', 'State Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'State is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'State Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore State***********/
    public function restore(Request $request, $state)
    {
        $state = State::withTrashed()->find($state);
        if ($state->trashed()) {
            $state->restore();
            return redirect()->back()->with('message', 'State Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'State Not Found')->with('message_type', 'error');
        }
    }
}
