<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\CompanyPages\CreateRequest;
use App\Models\BookAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class BookedAppointmentsController extends Controller
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
            $booked_appointments =  BookAppointment::withAll();
            if ($req->trash && $req->trash == 'with') {
                $booked_appointments =  $booked_appointments->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $booked_appointments =  $booked_appointments->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $booked_appointments = $booked_appointments->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $booked_appointments = $booked_appointments->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $booked_appointments = $booked_appointments->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $booked_appointments = $booked_appointments->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $booked_appointments = $booked_appointments->get();
                return $booked_appointments;
            }
            $booked_appointments = $booked_appointments->get();
            return $booked_appointments;
        }
        $booked_appointments = BookAppointment::withAll()->orderBy('id', 'desc')->get();
        return $booked_appointments;
    }


    /*********View All CompanyPages  ***********/
    public function index(Request $request)
    {
        $booked_appointments = $this->getter($request);
        return view('super_admins.booked_appointments.index')->with('booked_appointments', $booked_appointments);
    }

    /*********View Create Form of BookAppointment  ***********/
    public function create()
    {
        return view('super_admins.booked_appointments.create');
    }

    /*********Store BookAppointment  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','booked_appointments');
            $booked_appointment = BookAppointment::create($data);
            $booked_appointment->slug = Str::slug($booked_appointment->name . ' ' . $booked_appointment->id, '-');
            $booked_appointment->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.booked_appointments.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.booked_appointments.index')->with('message', 'BookAppointment Created Successfully')->with('message_type', 'success');
    }

    /*********View BookAppointment  ***********/
    public function show(BookAppointment $booked_appointment)
    {
        $booked_appointment = BookAppointment::withAll()->find($booked_appointment->id);
        return view('super_admins.booked_appointments.show', compact('booked_appointment'));
    }

    /*********View Edit Form of BookAppointment  ***********/
    public function edit(BookAppointment $booked_appointment)
    {

        return view('super_admins.booked_appointments.edit', compact('booked_appointment'));
    }

    /*********Update BookAppointment  ***********/
    public function update(CreateRequest $request, BookAppointment $booked_appointment)
    {
        $data = $request->all();
        // dd($data);

        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','booked_appointments',$booked_appointment->image);

            } else {
                $data['image'] = $booked_appointment->image;
            }
            $booked_appointment->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.booked_appointments.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.booked_appointments.index')->with('message', 'BookAppointment Updated Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE BookAppointment ***********/
    public function destroy(BookAppointment $booked_appointment)
    {
        // if ($booked_appointment->Has('posts')) {
        //     $booked_appointment->news()->delete();
        // }
        $booked_appointment->delete();
        return redirect()->back()->with('message', 'BookAppointment Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE BookAppointment ***********/
    public function destroyPermanently(Request $request, $booked_appointment)
    {
        $booked_appointment = BookAppointment::withTrashed()->find($booked_appointment);
        if ($booked_appointment) {
            if ($booked_appointment->trashed()) {
                if ($booked_appointment->image && file_exists(public_path($booked_appointment->image))) {
                    unlink(public_path($booked_appointment->image));
                }
                $booked_appointment->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore BookAppointment***********/
    public function restore(Request $request, $booked_appointment)
    {
        $booked_appointment = BookAppointment::withTrashed()->find($booked_appointment);
        if ($booked_appointment->trashed()) {
            $booked_appointment->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
