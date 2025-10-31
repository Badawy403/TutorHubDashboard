<?php

namespace App\Http\Controllers\API\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\UsersResource;
use App\Models\User;
use App\Http\Requests\API\Account\UpdateStudentGeneralInfoRequest;
use App\Http\Requests\API\Account\UpdateTeacherGeneralInfoRequest;
use App\Http\Requests\API\Account\UpdateAcademyGeneralInfoRequest;
use App\Models\Role;

class APIAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api','auth:api','verified','api_setting']);
        $this->middleware(['student.api'])->only(['updateStudentGeneralInformation']);
        $this->middleware(['teacher.api'])->only(['updateTeacherGeneralInformation' , 'updateTeacherSettings']);
        $this->middleware(['academy.api'])->only(['updateAcademyGeneralInformation' , 'updateAcademySettings']);
    }

    public function updateStudentGeneralInformation(UpdateStudentGeneralInfoRequest $request)
    {
        $user = auth()->user();
        $student = $user->student;
        if($student){
            $student->update($request->only(['first_name','last_name','user_name','description','country_id','state_id','city_id','address_line_1','address_line_2','zip_code']));
            if(!empty($request->image) && !is_null($request->image)){
                $image = uploadFile($request,'image','profile_images');
                $student->update(['image' => $image]);
            }

            $user = User::withAll()->where('email', $user->email)->first();
            $user = new UsersResource($user);
            $response = generateResponse($user,true,"Profile Updated Successfully",null,'collection');
        }else{
            $response = generateResponse(null,true,"User Not Found",null,'collection');
        }
        return response()->json($response);
    }

    public function updateTeacherGeneralInformation(UpdateTeacherGeneralInfoRequest $request)
    {
        $user = auth()->user();
        $teacher = $user->teacher;
        if($teacher){
            $teacher->update($request->only(
                ['first_name',
                'last_name',
                'description',
                'country_id',
                'state_id',
                'city_id',
                'address_line_1',
                'address_line_2',
                'zip_code',
                'user_name',
                'speciality',
                'home_phone',
                'cell_phone',
                'job_title',
                'website',
                'company',
                'email',
                'work_country_id',
                'work_state_id',
                'work_city_id',
                'work_address_line_1',
                'work_address_line_2',
                'work_zip_code',
                'shipping_country_id',
                'shipping_state_id',
                'shipping_city_id',
                'shipping_address_line_1',
                'shipping_address_line_2',
                'shipping_zip_code',
                'billing_country_id',
                'billing_state_id',
                'billing_city_id',
                'billing_address_line_1',
                'billing_address_line_2',
                'billing_zip_code'
                ]));

                if(!empty($request->image) && !is_null($request->image)){
                    $image = uploadFile($request,'image','profile_images');
                    $teacher->update(['image' => $image]);
                }
                if(!empty($request->cover_image) && !is_null($request->cover_image)){
                    $cover_image = uploadFile($request,'cover_image','profile_images');
                    $teacher->update(['cover_image' => $cover_image]);
                }
            $teacher->teacher_categories()->sync($request->teacher_categories);
            $teacher->languages()->sync($request->languages);
            $teacher->tags()->sync($request->tags);
            $user = User::withAll()->where('email', $user->email)->first();
            $user = new UsersResource($user);
            $response = generateResponse($user,true,"Profile Updated Successfully",null,'collection');
        }else{
            $response = generateResponse(null,true,"User Not Found",null,'collection');
        }
        return response()->json($response);
    }

    public function updateTeacherSettings(Request $request){
        $user = Auth::user();
        $teacher = $user->teacher;
        foreach($request->settings as $setting){
            $teacher->teacher_settings()->updateOrCreate(['name' => $setting['name']],$setting);
        }
        $response = generateResponse(null,true,"Settings Updated Successfully",null,'collection');
        return response()->json($response);
    }

    public function updateAcademyGeneralInformation(UpdateAcademyGeneralInfoRequest $request)
    {
        $user = auth()->user();
        $academy = $user->academy;
        if($academy){
            $academy->update($request->only(['academy_name','academy_website','first_name','last_name','description','country_id','state_id','city_id','address_line_1','address_line_2','zip_code','user_name']));
            $image = uploadCroppedFile($request,'image','profile_images');
            $academy->update(['image' => $image]);
            $academy->academy_categories()->sync($request->academy_categories);
            $response = generateResponse($academy,true,"Profile Updated Successfully",null,'collection');
        }else{
            $response = generateResponse(null,true,"User Not Found",null,'collection');
        }
        return response()->json($response);
    }

    public function updateAcademySettings(Request $request){
        $user = Auth::user();
        $academy = $user->academy;
        foreach($request->settings as $setting){
            $academy->academy_settings()->updateOrCreate(['name' => $setting['name']],$setting);
        }
        $response = generateResponse(null,true,"Settings Updated Successfully",null,'collection');
        return response()->json($response);
    }

    public function becomeTeacher(Request $request){
        $user = Auth::user();
        $logged_in_as = $request->session()->get('logged_in_as');
        $data = $user->{$logged_in_as};
        $pricing_plan = getTeacherDefaultPricingPlan();

        if(!$user->hasRole(Role::$Teacher)){
            $user->roles()->attach([Role::$Teacher]);
            $user->teacher()->create([
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'description' => $data->description,
                'country_id' => $data->country_id,
                'state_id' => $data->state_id,
                'city_id' => $data->city_id,
                'address_line_1' => $data->address_line_1,
                'address_line_2' => $data->address_line_2,
                'zip_code' => $data->zip_code,
                'pricing_plan_id' => $pricing_plan->id ?? null
            ]);
        }
        $response = generateResponse(null,true,"You are Now A Teacher",null,'collection');
        return response()->json($response);
    }
    public function becomeUser(Request $request){
        $user = Auth::user();
        $logged_in_as = $request->session()->get('logged_in_as');
        $data = $user->{$logged_in_as};
        if(!$user->hasRole(Role::$Student)){
            $user->roles()->attach([Role::$Student]);
            $user->student()->create([
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'description' => $data->description,
                'country_id' => $data->country_id,
                'state_id' => $data->state_id,
                'city_id' => $data->city_id,
                'address_line_1' => $data->address_line_1,
                'address_line_2' => $data->address_line_2,
                'zip_code' => $data->zip_code,

            ]);
        }
        $response = generateResponse(null,true,"You are Now A Cusomer",null,'collection');
        return response()->json($response);
    }
    public function becomeAcademy(Request $request){
        $user = Auth::user();
        $logged_in_as = $request->session()->get('logged_in_as');
        $data = $user->{$logged_in_as};
        $pricing_plan = getAcademyDefaultPricingPlan();
        if(!$user->hasRole(Role::$Academy)){
            $user->roles()->attach([Role::$Academy]);
            $user->academy()->create([
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'description' => $data->description,
                'country_id' => $data->country_id,
                'state_id' => $data->state_id,
                'city_id' => $data->city_id,
                'address_line_1' => $data->address_line_1,
                'address_line_2' => $data->address_line_2,
                'zip_code' => $data->zip_code,
                'pricing_plan_id' => $pricing_plan->id ?? null
            ]);
        }
        $response = generateResponse(null,true,"You are Now A Law Firm User Also",null,'collection');
        return response()->json($response);
    }
}
