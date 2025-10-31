<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\TeacherEducationsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\TeacherEducations\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\TeacherEducationsImport;
use App\Models\TeacherEducation;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TeacherEducationsController extends Controller
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
            $teacher_educations =  $teacher->teacher_educations();
            if ($req->trash && $req->trash == 'with') {
                $teacher_educations =  $teacher_educations->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $teacher_educations =  $teacher_educations->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $teacher_educations = $teacher_educations->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $teacher_educations = $teacher_educations->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $teacher_educations = $teacher_educations->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $teacher_educations = $teacher_educations->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $teacher_educations = $teacher_educations->get();
                return $teacher_educations;
            }
            $teacher_educations = $teacher_educations->get();
            return $teacher_educations;
        }
        $teacher_educations = $teacher->teacher_educations()->withAll()->orderBy('id', 'desc')->get();
        return $teacher_educations;
    }


    /*********View All TeacherEducations  ***********/
    public function index(Request $request , Teacher $teacher)
    {
        $teacher_educations = $this->getter($request , null , $teacher);
        return view('super_admins.teachers.teacher_educations.index' , compact('teacher_educations' , 'teacher'));
    }

    /*********View Create Form of TeacherEducation  ***********/
    public function create(Teacher $teacher)
    {
        return view('super_admins.teachers.teacher_educations.create', compact('teacher'));
    }

    /*********Store TeacherEducation  ***********/
    public function store(CreateRequest $request , Teacher $teacher)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data = $request->all();
            $data['image'] = uploadFile($request,'file','teacher_educations');
            $teacher_education = $teacher->teacher_educations()->create($data);
            $teacher_education = $teacher->teacher_educations()->withAll()->find($teacher_education->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_educations.index' , $teacher->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_educations.index' , $teacher->id)->with('message', 'Education Created Successfully')->with('message_type', 'success');
    }

    /*********View TeacherEducation  ***********/
    public function show(Teacher $teacher ,TeacherEducation $teacher_education)
    {
        if($teacher->id != $teacher_education->teacher_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        return view('super_admins.teachers.teacher_educations.show', compact('teacher_education' , 'teacher'));
    }

    /*********View Edit Form of TeacherEducation  ***********/
    public function edit(Teacher $teacher ,TeacherEducation $teacher_education)
    {
        if($teacher->id != $teacher_education->teacher_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        return view('super_admins.teachers.teacher_educations.edit', compact('teacher_education', 'teacher'));
    }

    /*********Update TeacherEducation  ***********/
    public function update(CreateRequest $request,Teacher $teacher , TeacherEducation $teacher_education)
    {
        if($teacher->id != $teacher_education->teacher_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data = $request->all();
            if ($request->file) {
                $data['image'] = uploadFile($request,'file','teacher_educations',$teacher_education->image);
            } else {
                $data['image'] = $teacher_education->image;
            }
            $teacher_education->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teacher_educations.index' , $teacher->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teacher_educations.index' , $teacher->id)->with('message', 'TeacherEducation Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $teacher_educations = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "teacher_educations." . $extension;
        return Excel::download(new TeacherEducationsExport($teacher_educations), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new TeacherEducationsImport, $file);
        return redirect()->back()->with('message', 'TeacherEducation Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE TeacherEducation ***********/
    public function destroy(Teacher $teacher ,TeacherEducation $teacher_education)
    {
        if($teacher->id != $teacher_education->teacher_id){
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
        $teacher_education->delete();
        return redirect()->back()->with('message', 'TeacherEducation Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE TeacherEducation ***********/
    public function destroyPermanently(Request $request,Teacher $teacher ,$teacher_education)
    {
        $teacher_education = TeacherEducation::withTrashed()->find($teacher_education);
        if ($teacher_education) {
            if ($teacher_education->trashed()) {
                if ($teacher_education->image && file_exists(public_path($teacher_education->image))) {
                    unlink(public_path($teacher_education->image));
                }
                $teacher_education->forceDelete();
                return redirect()->back()->with('message', 'TeacherEducation Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'TeacherEducation is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore TeacherEducation***********/
    public function restore(Request $request,Teacher $teacher, $teacher_education)
    {
        $teacher_education = TeacherEducation::withTrashed()->find($teacher_education);
        if ($teacher_education->trashed()) {
            $teacher_education->restore();
            return redirect()->back()->with('message', 'TeacherEducation Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'TeacherEducation Not Found')->with('message_type', 'error');
        }
    }
}
