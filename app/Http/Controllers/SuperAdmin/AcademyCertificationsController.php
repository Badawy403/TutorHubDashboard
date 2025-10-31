<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\TeacherEducationsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\AcademyCertifications\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\AcademyEducationsImport;
use App\Models\Certification;
use App\Models\Academy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AcademyCertificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null , $academy)
    {
        if ($req != null) {
            $academy_certifications =  $academy->academy_certifications();
            if ($req->trash && $req->trash == 'with') {
                $academy_certifications =  $academy_certifications->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $academy_certifications =  $academy_certifications->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $academy_certifications = $academy_certifications->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $academy_certifications = $academy_certifications->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $academy_certifications = $academy_certifications->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $academy_certifications = $academy_certifications->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $academy_certifications = $academy_certifications->get();
                return $academy_certifications;
            }
            $academy_certifications = $academy_certifications->get();
            return $academy_certifications;
        }
        $academy_certifications = $academy->academy_certifications()->withAll()->orderBy('id', 'desc')->get();
        return $academy_certifications;
    }


    /*********View All AcademyCertifications  ***********/
    public function index(Request $request , Academy $academy)
    {
        $academy_certifications = $this->getter($request , null , $academy);
        return view('super_admins.academies.academy_certifications.index' , compact('academy_certifications' , 'academy'));
    }

    /*********View Create Form of Certification  ***********/
    public function create(Academy $academy)
    {
        return view('super_admins.academies.academy_certifications.create', compact('academy'));
    }

    /*********Store Certification  ***********/
    public function store(CreateRequest $request , Academy $academy)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data = $request->all();
            $data['image'] = uploadFile($request,'file','academy_certifications');
            $academy_certification = $academy->academy_certifications()->create($data);
            $academy_certification = $academy->academy_certifications()->withAll()->find($academy_certification->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academy_certifications.index' , $academy->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academy_certifications.index' , $academy->id)->with('message', 'Certificate Created Successfully')->with('message_type', 'success');
    }

    /*********View Certification  ***********/
    public function show(Academy $academy ,Certification $academy_certification)
    {
        if($academy->id != $academy_certification->academy_id){
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
        return view('super_admins.academies.academy_certifications.show', compact('academy_certification' , 'academy'));
    }

    /*********View Edit Form of Certification  ***********/
    public function edit(Academy $academy ,Certification $academy_certification)
    {
        if($academy->id != $academy_certification->academy_id){
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
        return view('super_admins.academies.academy_certifications.edit', compact('academy_certification', 'academy'));
    }

    /*********Update Certification  ***********/
    public function update(CreateRequest $request,Academy $academy , Certification $academy_certification)
    {
        if($academy->id != $academy_certification->academy_id){
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
                $data['image'] = uploadFile($request,'file','academy_certifications',$academy_certification->image);
            } else {
                $data['image'] = $academy_certification->image;
            }
            $academy_certification->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academy_certifications.index' , $academy->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academy_certifications.index' , $academy->id)->with('message', 'Certification Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $academy_certifications = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "academy_certifications." . $extension;
        return Excel::download(new TeacherEducationsExport($academy_certifications), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new AcademyEducationsImport, $file);
        return redirect()->back()->with('message', 'Certification Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Certification ***********/
    public function destroy(Academy $academy ,Certification $academy_certification)
    {
        if($academy->id != $academy_certification->academy_id){
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
        $academy_certification->delete();
        return redirect()->back()->with('message', 'Certification Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Certification ***********/
    public function destroyPermanently(Request $request,Academy $academy ,$academy_certification)
    {
        $academy_certification = Certification::withTrashed()->find($academy_certification);
        if ($academy_certification) {
            if ($academy_certification->trashed()) {
                if ($academy_certification->image && file_exists(public_path($academy_certification->image))) {
                    unlink(public_path($academy_certification->image));
                }
                $academy_certification->forceDelete();
                return redirect()->back()->with('message', 'Certification Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Certification is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Certification***********/
    public function restore(Request $request,Academy $academy, $academy_certification)
    {
        $academy_certification = Certification::withTrashed()->find($academy_certification);
        if ($academy_certification->trashed()) {
            $academy_certification->restore();
            return redirect()->back()->with('message', 'Certification Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
    }
}
