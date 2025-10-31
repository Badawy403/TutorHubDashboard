<?php

namespace App\Http\Controllers\Academies;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use App\Http\Requests\Academies\AcademyTeachers\CreateRequest;
use App\Http\Requests\Academies\AcademyTeachers\UpdateRequest;
use App\Http\Resources\Web\TeachersResource;
use App\Notifications\Auth\TeacherCredentialsNotification;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AcademyTeachersController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('academy');

      // $this->middleware('permission:academy_teachers.index');
      // $this->middleware('permission:academy_teachers.create',['only' => ['store']]);
      // $this->middleware('permission:academy_teachers.update',['only' => ['update']]);
      // $this->middleware('permission:academy_teachers.delete',['only' => ['destroy']]);
      // $this->middleware('permission:academy_teachers.export',['only' => ['export']]);
      // $this->middleware('permission:academy_teachers.import',['only' => ['import']])
      // $this->middleware('permission:academy_teachers.update|academy_teachers.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $academy = auth()->user()->academy;
    if($req != null){
      $academy_teachers =  $academy->academy_teachers()->withAll();
      if($req->trash && $req->trash == 'with'){
        $academy_teachers =  $academy_teachers->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $academy_teachers =  $academy_teachers->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $academy_teachers = $academy_teachers->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $academy_teachers = $academy_teachers->whereLike(['first_name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $academy_teachers = $academy_teachers->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $academy_teachers = $academy_teachers->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $academy_teachers = $academy_teachers->get();
        return $academy_teachers;
      }
      $totalAcademyTeachers = $academy_teachers->count();
      $academy_teachers = $academy_teachers->paginate($req->perPage);
      $academy_teachers = TeachersResource::collection($academy_teachers)->response()->getData(true);

      return $academy_teachers;
    }
    $academy_teachers = TeachersResource::collection($academy->academy_teachers()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $academy_teachers;
  }

  /********* FETCH ALL AcademyTeachers ***********/
    public function index()
    {
        $academy_teachers =  $this->getter();
        $response = generateResponse($academy_teachers,count($academy_teachers['data']) > 0 ? true:false,'Academy Teachers Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER AcademyTeachers FOR Search ***********/
   public function filter(Request $request){
     $academy_teachers = $this->getter($request);
     $response = generateResponse($academy_teachers,count($academy_teachers['data']) > 0 ? true:false,'Filter Academy Teachers Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW AcademyTeacher ***********/
    public function store(CreateRequest $request)
    {
      $academy = auth()->user()->academy;
      try{
    //   DB::beginTransaction();
      $data = $request->all();
        $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
        $data['password'] = Hash::make($request->password);
        $data['email'] = $request->email;
        $user = User::create($data);

        $user->roles()->attach(['teacher']);
        $pricing_plan = getTeacherDefaultPricingPlan();
        if ($request->image) {
            $data['image'] = uploadCroppedFile($request,'image','academy_teachers');
        }

        $teacher = $user->teacher()->create([
            'pricing_plan_id' => $pricing_plan->id ?? null,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'is_active' => $request['is_active'],
            'experience' => $request['experience'],
            'speciality' => $request['speciality'],
            'academy_id' => $academy->id,
            'user_name' => $request->user_name,
            'image' =>$data['image'] ?? null,
            'zip_code' => $data['zip_code'] ?? null
        ]);
        $teacher->teacher_categories()->attach($request->teacher_categories);
        $user->sendEmailVerificationNotification();
        $user->notify(new TeacherCredentialsNotification($user,$request->password));
      $academy_teacher = $academy->academy_teachers()->withAll()->find($academy->id);
      $academy_teacher = new TeachersResource($academy_teacher);
    //   DB::commit();
    }
      catch (\Exception $e) {
        // DB::rollBack();
        // request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
     }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $academy_teacher)
    {
        $academy = auth()->user()->academy;
        if($academy_teacher->academy_id != $academy->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $academy_teacher = $academy->academy_teachers()->withAll()->find($academy_teacher);
        if($academy_teacher){
          $academy_teacher = new TeachersResource($academy_teacher);
          $response = generateResponse($academy_teacher,true,'Academy Teacher Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'Academy Teacher Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE Academy Teacher ***********/
    public function update(UpdateRequest $request, Teacher $academy_teacher)
    {
        // dd($request->all());
        $academy = auth()->user()->academy;
        if($academy_teacher->academy_id != $academy->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
      try{
        DB::beginTransaction();
        $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        if ($request->image) {
            $data['image'] = uploadCroppedFile($request,'image','academy_teachers',$academy_teacher->image);
        } else {
            $data['image'] = $academy_teacher->image;
        }
        $academy_teacher->update($data);
        $academy_teacher->teacher_categories()->sync($request->teacher_categories);

        DB::commit();
      }
        catch (\Exception $e) {
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
       }
       return redirect()->back();
    }

    /********* UPDATE Academy Teacher Status***********/
    public function updateStatus(Request $request, Teacher $academy_teacher){
        $academy = auth()->user()->academy;
        if($academy_teacher->academy_id != $academy->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $academy_teacher->update([
          'is_active' => $academy_teacher->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'Academy Teacher Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE Academy Teacher ***********/
    public function destroy(Request $request,Teacher $academy_teacher)
    {
        $academy = auth()->user()->academy;
        if($academy_teacher->academy_id != $academy->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($academy_teacher->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            // dd($academy_teacher->teacher_categories());
            User::find($academy_teacher->user_id)->delete();

            $academy_teacher->teacher_categories()->sync([]);
            $academy_teacher->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE Academy Teacher ***********/
    public function destroyPermanently(Request $request,$academy_teacher)
    {
        $academy= auth()->user()->academy;
        $academy_teacher = $academy->academy_teachers()->withTrashed()->find($academy_teacher);
        if($academy_teacher){
            if($academy_teacher->academy_id != $academy->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
          if ($academy_teacher->trashed()) {
            $academy_teacher->forceDelete();
            $response = generateResponse(null,true,'Academy Teacher Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'Academy Teacher is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'Academy Teacher not found',null,'object');
        }
          return response()->json($response, 200);
    }
    /********* Restore Academy Teacher ***********/
    public function restore(Request $request,$academy_teacher)
    {
      $academy= auth()->user()->academy;
      $academy_teacher = $academy->academy_teachers()->withTrashed()->find($academy_teacher);
          if ($academy_teacher->trashed()) {
            $academy_teacher->restore();
            $response = generateResponse(null,true,'Academy Teacher Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'Academy Teacher is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
