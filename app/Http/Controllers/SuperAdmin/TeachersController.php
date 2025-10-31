<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\TeachersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Teachers\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\SuperAdmin\Teachers\UpdateRequest;
use App\Imports\SuperAdmin\TeachersImport;
use App\Http\Resources\Web\TeachersResource;
use Inertia\Inertia;
use App\Models\Teacher;
use App\Models\Academy;
use App\Models\TeacherMainCategory;
use App\Models\TeacherCategory;
use App\Models\PricingPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class TeachersController extends Controller
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
            $teachers =  Teacher::withAll();
            if ($req->trash && $req->trash == 'with') {
                $teachers =  $teachers->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $teachers =  $teachers->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                    $teachers = $teachers->whereLike($req->column, $req->search);

            } else if ($req->search && $req->search != null) {

                $teachers = $teachers->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $teachers = $teachers->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $teachers = $teachers->OrderBy('is_approved', 'ASC');

            }
            if ($export != null) { // for export do not paginate
                $teachers = $teachers->get();
                return $teachers;
            }
            $teachers = $teachers->get();
            return $teachers;
        }
        $teachers = Teacher::withAll()->OrderBy('is_approved', 'ASC')->get();
        return $teachers;
    }


    /*********View All Teachers  ***********/
    public function index(Request $request)
    {
        $teachers = $this->getter($request);
        $academies = Academy::approved()->active()->get();
        return view('super_admins.teachers.index' , compact('teachers' , 'academies'));
    }

    /*********View Create Form of Teacher  ***********/
    public function create()
    {
        $academies = Academy::active()->approved()->get();
        $teacher_categories = TeacherCategory::active()->get();
        $pricing_plans = PricingPlan::teacher()->get();
        return view('super_admins.teachers.create',compact('pricing_plans' , 'academies' , 'teacher_categories'));
    }

    /*********Store Teacher  ***********/
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
            if (!$request->is_premium) {
                $data['is_premium'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','teachers');

            $teacher = Teacher::create($data);
            $user = User::where('email',$request->email)->first();
            if($user){
                $user->roles()->attach(['teacher']);
                $teacher->update(['user_id' => $user->id]);
            }
            else{
                $user = $teacher->user()->create([
                    'name' => $teacher->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $user->markEmailAsVerified();
                $teacher->update(['user_id' => $user->id]);
                $user->roles()->attach(['teacher']);
            }
            $teacher->teacher_categories()->attach($request->teacher_category_ids);
            $teacher->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teachers.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teachers.index')->with('message', 'Teacher Created Successfully')->with('message_type', 'success');
    }

    /*********View Teacher  ***********/
    public function show(Teacher $teacher)
    {
        $teacher = Teacher::withAll()->find($teacher->id);
        return view('super_admins.teachers.show', compact('teacher'));
    }

    /*********View Edit Form of Teacher  ***********/
    public function edit(Teacher $teacher)
    {
        $pricing_plans = PricingPlan::teacher()->get();
        $teacher_categories = TeacherCategory::active()->get();
        $academies = Academy::active()->approved()->get();
        return view('super_admins.teachers.edit', compact('teacher','pricing_plans' , 'academies' , 'teacher_categories'));
    }

    /*********Update Teacher  ***********/
    public function update(UpdateRequest $request, Teacher $teacher)
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
            if (!$request->is_premium) {
                $data['is_premium'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','teachers',$teacher->image);

            } else {
                $data['image'] = $teacher->image;
            }
            if(isset($request->teacher_category_ids)){
                $teacher->teacher_categories()->sync($request->teacher_category_ids);
            }
            $teacher->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.teachers.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.teachers.index')->with('message', 'Teacher Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $teachers = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "teachers." . $extension;
        return Excel::download(new TeachersExport($teachers), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new TeachersImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }

    public function viewBlogs(Teacher $teacher)
    {
        $teacher_blogs = $teacher->teacher_posts()->get();
        $teacher_id = $teacher->id;
        return view('super_admins.teachers.show_blogs', compact('teacher_blogs' , 'teacher_id'));
    }
    public function viewEvents(Teacher $teacher)
    {
        $teacher_events = $teacher->teacher_events()->get();
        $teacher_id = $teacher->id;
        return view('super_admins.teachers.show_events', compact('teacher_events' , 'teacher_id'));
    }
    public function viewSocialLinks(Teacher $teacher)
    {
        $teacher_settings = $teacher->teacher_settings()->get();
        $teacher_id = $teacher->id;
        return view('super_admins.teachers.show_social', compact('teacher_settings' , 'teacher_id'));
    }

    public function profile(Request $request,$teacher)
    {
        $teacher = teacher::withChildrens()->withAll()->where('id',$teacher)->first();
        if(!$teacher){
            abort(404);
        }
        $teacher = new TeachersResource($teacher);
        return Inertia::render('Teachers/Profile',[
            'teacher' => $teacher
        ]);
    }


    /*********Soft DELETE Teacher ***********/
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->back()->with('message', 'Teacher Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Teacher ***********/
    public function destroyPermanently(Request $request, $teacher)
    {
        $teacher = Teacher::withTrashed()->find($teacher);
        if ($teacher) {
            if ($teacher->trashed()) {
                if ($teacher->image && file_exists(public_path($teacher->image))) {
                    unlink(public_path($teacher->image));
                }
                $teacher->forceDelete();
                return redirect()->back()->with('message', 'Teacher Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Teacher is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Teacher Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Teacher***********/
    public function restore(Request $request, $teacher)
    {
        $teacher = Teacher::withTrashed()->find($teacher);
        if ($teacher->trashed()) {
            $teacher->restore();
            return redirect()->back()->with('message', 'Teacher Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Teacher Not Found')->with('message_type', 'error');
        }
    }
        /*********Approve Teacher ***********/
        public function approve(Teacher $teacher)
        {
            if(!$teacher->is_approved){
                $teacher->update(['is_approved' => 1,'approved_at' => now()]);
            }
        NotificationSettingsController::fireNotificationEvent($teacher,'approve_or_reject_tutor',[[$teacher]],'super_admin/teachers','Tutor Approved Successfully');

            return redirect()->back()->with('message', 'Teacher Approved Successfully')->with('message_type', 'success');
        }
        public function bulkActionTeachers(Request $request , $type)
        {
            if($type == 'approve'){
                Teacher::whereIn('id' , $request->selected_ids)->update([
                    'is_approved' => 1
                ]);
            }
            elseif ($type == 'disapprove') {
                Teacher::whereIn('id', $request->selected_ids)->update([
                    'is_approved' => 0
                ]);
            }
            elseif($type == 'inactive'){
                Teacher::whereIn('id' , $request->selected_ids)->update([
                    'is_active' => 0
                ]);
            }
            elseif($type == 'active'){
                Teacher::whereIn('id' , $request->selected_ids)->update([
                    'is_active' => 1
                ]);
            }
            elseif($type == 'delete'){
                foreach ($request->selected_ids as $userId){
                    $teacher = Teacher::where('id' , $userId)->first();
                    $this->destroy($teacher);
                }
            }
            elseif($type == 'feature'){
                Teacher::whereIn('id' , $request->selected_ids)->update([
                    'is_featured' => 1
                ]);
            }
            else{
                Session::flash('message', 'Some Thing Went Wrong !');
                return response()->json('Success' , 200);
            }
            Session::flash('message', 'Updated Successfully');
            return response()->json('Success' , 200);
        }
}
