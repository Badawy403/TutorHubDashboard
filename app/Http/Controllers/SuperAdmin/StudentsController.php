<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\StudentsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Students\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\SuperAdmin\Students\UpdateRequest;
use App\Imports\SuperAdmin\StudentsImport;
use App\Models\Student;
use App\Models\PricingPlan;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class StudentsController extends Controller
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
            $students =  Student::withAll();
            if ($req->trash && $req->trash == 'with') {
                $students =  $students->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $students =  $students->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $students = $students->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $students = $students->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $students = $students->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $students = $students->OrderBy('id', 'desc');

            }
            if ($export != null) { // for export do not paginate
                $students = $students->get();
                return $students;
            }
            $students = $students->get();
            return $students;
        }
        $students = Student::withAll()->OrderBy('id', 'desc')->get();
        return $students;
    }


    /*********View All Students  ***********/
    public function index(Request $request)
    {
        $students = $this->getter($request);
        return view('super_admins.students.index')->with('students', $students);
    }

    /*********View Create Form of Student  ***********/
    public function create()
    {
        return view('super_admins.students.create');
    }

    /*********Store Student  ***********/
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
            $data['image'] = uploadCroppedFile($request,'image','students');

            $student = Student::create($data);
            $user = User::where('email',$request->email)->first();
            if($user){
                $user->roles()->attach(['student']);
                $student->update(['user_id' => $user->id]);
            }
            else{
                $user = $student->user()->create([
                    'name' => $student->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $user->markEmailAsVerified();
                $student->update(['user_id' => $user->id]);
                $user->roles()->attach(['student']);
            }
            $student->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.students.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.students.index')->with('message', 'Student Created Successfully')->with('message_type', 'success');
    }

    /*********View Student  ***********/
    public function show(Student $student)
    {
        return view('super_admins.students.show', compact('student'));
    }

    /*********View Edit Form of Student  ***********/
    public function edit(Student $student)
    {
        return view('super_admins.students.edit', compact('student'));
    }

    /*********Update Student  ***********/
    public function update(UpdateRequest $request, Student $student)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','students',$student->image);

            } else {
                $data['image'] = $student->image;
            }
            $student->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.students.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.students.index')->with('message', 'Student Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $students = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "students." . $extension;
        return Excel::download(new StudentsExport($students), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new StudentsImport, $file);
        return redirect()->back()->with('message', 'Students imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Student ***********/
    public function destroy(Student $student)
    {
        $user = $student->user;
        $user->roles()->detach([Role::$Student]);
        if(!$user->hasRole(Role::$Academy) && !$user->hasRole(Role::$Teacher) && !$user->hasRole(Role::$SuperAdmin)){
            $user->delete();
        }
        $student->delete();
        return redirect()->back()->with('message', 'Student Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Student ***********/
    public function destroyPermanently(Request $request, $student)
    {
        $student = Student::withTrashed()->find($student);
        if ($student) {
            if ($student->trashed()) {
                if ($student->image && file_exists(public_path($student->image))) {
                    unlink(public_path($student->image));
                }
                $student->forceDelete();
                return redirect()->back()->with('message', 'Student Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Student is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Student Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Student***********/
    public function restore(Request $request, $student)
    {
        $student = Student::withTrashed()->find($student);
        if ($student->trashed()) {
            $student->restore();
            return redirect()->back()->with('message', 'Student Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Student Not Found')->with('message_type', 'error');
        }
    }
        /*********Approve Student ***********/
        public function approve(Student $student)
        {
            if(!$student->is_approved){
                $student->update(['is_approved' => 1,'approved_at' => now()]);
            }
        NotificationSettingsController::fireNotificationEvent($student,'approve_or_reject_student',[[$student]],'super_admin/students','student Approved Successfully');

            return redirect()->back()->with('message', 'Student Approved Successfully')->with('message_type', 'success');
        }
}
