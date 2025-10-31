<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\TeacherEducationsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\TeacherExperience\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\TeacherEducationsImport;
use App\Models\TeacherExperience;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TeacherExperiencesController extends Controller
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
            $teacher_experiences =  $teacher->teacher_experiences();
            if ($req->trash && $req->trash == 'with') {
                $teacher_experiences =  $teacher_experiences->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $teacher_experiences =  $teacher_experiences->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $teacher_experiences = $teacher_experiences->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $teacher_experiences = $teacher_experiences->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $teacher_experiences = $teacher_experiences->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $teacher_experiences = $teacher_experiences->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $teacher_experiences = $teacher_experiences->get();
                return $teacher_experiences;
            }
            $teacher_experiences = $teacher_experiences->get();
            return $teacher_experiences;
        }
        $teacher_experiences = $teacher->teacher_experiences()->withAll()->orderBy('id', 'desc')->get();
        return $teacher_experiences;
    }


    /*********View All TeacherExperience  ***********/
    public function index(Request $request , Teacher $teacher)
    {
        $teacher_experiences = $this->getter($request , null , $teacher);
        return view('super_admins.teachers.teacher_experiences.index' , compact('teacher_experiences' , 'teacher'));
    }

    /*********View Create Form of TeacherExperience  ***********/
    public function create(Teacher $teacher)
    {
        return view('super_admins.teachers.teacher_experiences.create', compact('teacher'));
    }

    /*********Store TeacherExperience  ***********/
    public function store(CreateRequest $request , Teacher $teacher)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data = $request->all();
            $data['image'] = uploadFile($request,'file','teacher_experiences');
            $teacher_experience = $teacher->teacher_experiences()->create($data);
            $teacher_experience = $teacher->teacher_experiences()->withAll()->find($teacher_experience->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_experiences.index' , $teacher->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_experiences.index' , $teacher->id)->with('message', 'Experience Created Successfully')->with('message_type', 'success');
    }

    /*********View TeacherExperience  ***********/
    public function show(Teacher $teacher ,TeacherExperience $teacher_experience)
    {
        if($teacher->id != $teacher_experience->teacher_id){
            return redirect()->back()->with('message', 'TeacherExperience Not Found')->with('message_type', 'error');
        }
        return view('super_admins.teachers.teacher_experiences.show', compact('teacher_experience' , 'teacher'));
    }

    /*********View Edit Form of TeacherExperience  ***********/
    public function edit(Teacher $teacher ,TeacherExperience $teacher_experience)
    {
        if($teacher->id != $teacher_experience->teacher_id){
            return redirect()->back()->with('message', 'TeacherExperience Not Found')->with('message_type', 'error');
        }
        return view('super_admins.teachers.teacher_experiences.edit', compact('teacher_experience', 'teacher'));
    }

    /*********Update TeacherExperience  ***********/
    public function update(CreateRequest $request,Teacher $teacher , TeacherExperience $teacher_experience)
    {
        if($teacher->id != $teacher_experience->teacher_id){
            return redirect()->back()->with('message', 'TeacherExperience Not Found')->with('message_type', 'error');
        }
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data = $request->all();
            if ($request->file) {
                $data['image'] = uploadFile($request,'file','teacher_experiences',$teacher_experience->image);
            } else {
                $data['image'] = $teacher_experience->image;
            }
            $teacher_experience->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_experiences.index' , $teacher->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_experiences.index' , $teacher->id)->with('message', 'TeacherExperience Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $teacher_experiences = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "teacher_experiences." . $extension;
        return Excel::download(new TeacherEducationsExport($teacher_experiences), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new TeacherEducationsImport, $file);
        return redirect()->back()->with('message', 'TeacherExperience Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE TeacherExperience ***********/
    public function destroy(Teacher $teacher ,TeacherExperience $teacher_experience)
    {
        if($teacher->id != $teacher_experience->teacher_id){
            return redirect()->back()->with('message', 'TeacherExperience Not Found')->with('message_type', 'error');
        }
        $teacher_experience->delete();
        return redirect()->back()->with('message', 'TeacherExperience Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE TeacherExperience ***********/
    public function destroyPermanently(Request $request,Teacher $teacher ,$teacher_experience)
    {
        $teacher_experience = TeacherExperience::withTrashed()->find($teacher_experience);
        if ($teacher_experience) {
            if ($teacher_experience->trashed()) {
                if ($teacher_experience->image && file_exists(public_path($teacher_experience->image))) {
                    unlink(public_path($teacher_experience->image));
                }
                $teacher_experience->forceDelete();
                return redirect()->back()->with('message', 'TeacherExperience Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'TeacherExperience is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'TeacherExperience Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore TeacherExperience***********/
    public function restore(Request $request,Teacher $teacher, $teacher_experience)
    {
        $teacher_experience = TeacherExperience::withTrashed()->find($teacher_experience);
        if ($teacher_experience->trashed()) {
            $teacher_experience->restore();
            return redirect()->back()->with('message', 'TeacherExperience Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'TeacherExperience Not Found')->with('message_type', 'error');
        }
    }
}
