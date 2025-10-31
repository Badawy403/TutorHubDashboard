<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\TeacherEducationsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\TeacherCertifications\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\TeacherEducationsImport;
use App\Models\Certification;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TeacherCertificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null , $teacher)
    {
        if ($req != null) {
            $teacher_certifications =  $teacher->teacher_certifications();
            if ($req->trash && $req->trash == 'with') {
                $teacher_certifications =  $teacher_certifications->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $teacher_certifications =  $teacher_certifications->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $teacher_certifications = $teacher_certifications->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $teacher_certifications = $teacher_certifications->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $teacher_certifications = $teacher_certifications->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $teacher_certifications = $teacher_certifications->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $teacher_certifications = $teacher_certifications->get();
                return $teacher_certifications;
            }
            $teacher_certifications = $teacher_certifications->get();
            return $teacher_certifications;
        }
        $teacher_certifications = $teacher->teacher_certifications()->withAll()->orderBy('id', 'desc')->get();
        return $teacher_certifications;
    }


    /*********View All TeacherCertifications  ***********/
    public function index(Request $request , Teacher $teacher)
    {
        $teacher_certifications = $this->getter($request , null , $teacher);
        return view('super_admins.teachers.teacher_certifications.index' , compact('teacher_certifications' , 'teacher'));
    }

    /*********View Create Form of Certification  ***********/
    public function create(Teacher $teacher)
    {
        return view('super_admins.teachers.teacher_certifications.create', compact('teacher'));
    }

    /*********Store Certification  ***********/
    public function store(CreateRequest $request , Teacher $teacher)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data = $request->all();
            $data['image'] = uploadFile($request,'file','teacher_certifications');
            $teacher_certification = $teacher->teacher_certifications()->create($data);
            $teacher_certification = $teacher->teacher_certifications()->withAll()->find($teacher_certification->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_certifications.index' , $teacher->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_certifications.index' , $teacher->id)->with('message', 'Certificate Created Successfully')->with('message_type', 'success');
    }

    /*********View Certification  ***********/
    public function show(Teacher $teacher ,Certification $teacher_certification)
    {
        if($teacher->id != $teacher_certification->teacher_id){
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
        return view('super_admins.teachers.teacher_certifications.show', compact('teacher_certification' , 'teacher'));
    }

    /*********View Edit Form of Certification  ***********/
    public function edit(Teacher $teacher ,Certification $teacher_certification)
    {
        if($teacher->id != $teacher_certification->teacher_id){
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
        return view('super_admins.teachers.teacher_certifications.edit', compact('teacher_certification', 'teacher'));
    }

    /*********Update Certification  ***********/
    public function update(CreateRequest $request,Teacher $teacher , Certification $teacher_certification)
    {
        if($teacher->id != $teacher_certification->teacher_id){
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data = $request->all();
            if ($request->file) {
                $data['image'] = uploadFile($request,'file','teacher_certifications',$teacher_certification->image);
            } else {
                $data['image'] = $teacher_certification->image;
            }
            $teacher_certification->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_certifications.index' , $teacher->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_certifications.index' , $teacher->id)->with('message', 'Certification Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $teacher_certifications = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "teacher_certifications." . $extension;
        return Excel::download(new TeacherEducationsExport($teacher_certifications), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new TeacherEducationsImport, $file);
        return redirect()->back()->with('message', 'Certification Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Certification ***********/
    public function destroy(Teacher $teacher ,Certification $teacher_certification)
    {
        if($teacher->id != $teacher_certification->teacher_id){
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
        $teacher_certification->delete();
        return redirect()->back()->with('message', 'Certification Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Certification ***********/
    public function destroyPermanently(Request $request,Teacher $teacher ,$teacher_certification)
    {
        $teacher_certification = Certification::withTrashed()->find($teacher_certification);
        if ($teacher_certification) {
            if ($teacher_certification->trashed()) {
                if ($teacher_certification->image && file_exists(public_path($teacher_certification->image))) {
                    unlink(public_path($teacher_certification->image));
                }
                $teacher_certification->forceDelete();
                return redirect()->back()->with('message', 'Certification Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Certification is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Certification***********/
    public function restore(Request $request,Teacher $teacher, $teacher_certification)
    {
        $teacher_certification = Certification::withTrashed()->find($teacher_certification);
        if ($teacher_certification->trashed()) {
            $teacher_certification->restore();
            return redirect()->back()->with('message', 'Certification Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
    }
}
