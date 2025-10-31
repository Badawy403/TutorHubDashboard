<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\API\APIGeneralController;
use App\Models\EventCategory;
use App\Models\PodcastCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdateStudentGeneralInfoRequest;
use App\Http\Requests\Account\UpdateTeacherGeneralInfoRequest;
use App\Http\Requests\Account\UpdateAcademyGeneralInfoRequest;
use App\Http\Resources\Web\AppointmentTypesResource;
use App\Http\Resources\Web\ArchiveCategoriesResource;
use App\Http\Resources\Web\BlogCategoriesResource;
use App\Http\Resources\Web\AcademiesResource;
use App\Http\Resources\Web\AcademyMainCategoriesResource;
use App\Http\Resources\Web\StudentsResource;
use App\Http\Resources\Web\EventCategoriesResource;
use App\Http\Resources\Web\TeacherMainCategoriesResource;
use App\Http\Resources\Web\TeachersResource;
use App\Http\Resources\Web\PodcastCategoriesResource;
use App\Http\Resources\Web\ServiceCategoriesResource;
use App\Http\Resources\Web\TagsResource;
use App\Models\AllLanguage;
use App\Models\AppointmentType;
use App\Models\ArchiveCategory;
use App\Models\BlogCategory;
use App\Models\Academy;
use App\Models\AcademyCategory;
use App\Models\AcademyMainCategory;
use App\Models\City;
use App\Models\Country;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherCategory;
use App\Models\TeacherMainCategory;
use App\Models\Role;
use App\Models\ServiceCategory;
use App\Models\State;
use App\Models\Tag;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
    public function showAccountPage(Request $request){
        $user = Auth::user();
        if($request->session()->get('logged_in_as') == 'teacher'){
            $teacher = $user->teacher;
            $teacher = Teacher::withChildrens()->withAll()->where('id',$teacher->id)->first();
            $teacher = new TeachersResource($teacher);
            $teacher_categories = TeacherMainCategory::active()->whereHas('categories',function($q){
                $q->active();
            })->withAll()->withChildrens()->get();
            $teacher_categories = TeacherMainCategoriesResource::collection($teacher_categories);
            // $teacher_categories = TeacherCategory::active()->get();
            $blog_categories = BlogCategory::active()->get();
            $blog_categories = BlogCategoriesResource::collection($blog_categories);
            $event_categories = EventCategory::active()->get();
            $event_categories = EventCategoriesResource::collection($event_categories);
            $podcast_categories = PodcastCategory::active()->get();
            $podcast_categories = PodcastCategoriesResource::collection($podcast_categories);
            $archive_categories = ArchiveCategory::active()->get();
            $archive_categories = ArchiveCategoriesResource::collection($archive_categories);
            $tags = Tag::active()->get();
            $tags = TagsResource::collection($tags);
            $countries = Country::active()->get();
            $states = State::active()->where('country_id',$teacher->country_id)->get();
            $cities = City::active()->where('state_id',$teacher->state_id)->get();
            $appointment_types = AppointmentType::active()->get();
            $appointment_types = AppointmentTypesResource::collection($appointment_types);
            $billing_states = State::active()->where('country_id',$teacher->billing_country_id)->get();
            $billing_cities = City::active()->where('state_id',$teacher->billing_state_id)->get();
            $shipping_states = State::active()->where('country_id',$teacher->shipping_country_id)->get();
            $shipping_cities = City::active()->where('state_id',$teacher->shipping_state_id)->get();
            $work_states = State::active()->where('country_id',$teacher->work_country_id)->get();
            $work_cities = City::active()->where('state_id',$teacher->work_state_id)->get();
            $languages = AllLanguage::active()->get();
            $service_categories = ServiceCategory::active()->get();
            $service_categories = ServiceCategoriesResource::collection($service_categories);
            $data = [
                'teacher' => $teacher,
                'teacher_categories' => $teacher_categories,
                'blog_categories' => $blog_categories,
                'event_categories' => $event_categories,
                'podcast_categories' => $podcast_categories,
                'archive_categories' => $archive_categories,
                'countries' => $countries,
                'states' => $states,
                'cities' => $cities,
                'tags' => $tags,
                'service_categories' => $service_categories,
                'billing_states' => $billing_states,
                'billing_cities' => $billing_cities,
                'shipping_states' => $shipping_states,
                'shipping_cities' => $shipping_cities,
                'work_states' => $work_states,
                'work_cities' => $work_cities,
                'languages' => $languages,
                'appointment_types' => $appointment_types
            ];
        }
        if($request->session()->get('logged_in_as') == 'academy'){
            $academy = $user->academy;
            $academy = Academy::withChildrens()->withAll()->where('id',$academy->id)->first();
            $academy = new AcademiesResource($academy);
            $academy_categories = AcademyMainCategory::active()->whereHas('categories',function($q){
                $q->active();
            })->withAll()->withChildrens()->get();
            $academy_categories = AcademyMainCategoriesResource::collection($academy_categories);
            $blog_categories = BlogCategory::active()->get();
            $blog_categories = BlogCategoriesResource::collection($blog_categories);
            $event_categories = EventCategory::active()->get();
            $event_categories = EventCategoriesResource::collection($event_categories);
            $podcast_categories = PodcastCategory::active()->get();
            $podcast_categories = PodcastCategoriesResource::collection($podcast_categories);
            $archive_categories = ArchiveCategory::active()->get();
            $archive_categories = ArchiveCategoriesResource::collection($archive_categories);
            $tags = Tag::active()->get();
            $tags = TagsResource::collection($tags);
            $countries = Country::active()->get();
            $service_categories = ServiceCategory::active()->get();
            $service_categories = ServiceCategoriesResource::collection($service_categories);
            $states = State::active()->where('country_id',$academy->country_id)->get();
            $cities = City::active()->where('state_id',$academy->state_id)->get();
            $billing_states = State::active()->where('country_id',$academy->billing_country_id)->get();
            $billing_cities = City::active()->where('state_id',$academy->billing_state_id)->get();
            $shipping_states = State::active()->where('country_id',$academy->shipping_country_id)->get();
            $shipping_cities = City::active()->where('state_id',$academy->shipping_state_id)->get();
            $work_states = State::active()->where('country_id',$academy->work_country_id)->get();
            $work_cities = City::active()->where('state_id',$academy->work_state_id)->get();
            $languages = AllLanguage::active()->get();
            $appointment_types = AppointmentType::active()->get();
            $appointment_types = AppointmentTypesResource::collection($appointment_types);
            $data = [
                'academy' => $academy,
                'academy_categories' => $academy_categories,
                'blog_categories' => $blog_categories,
                'event_categories' => $event_categories,
                'podcast_categories' => $podcast_categories,
                'archive_categories' => $archive_categories,
                'countries' => $countries,
                'states' => $states,
                'cities' => $cities,
                'billing_states' => $billing_states,
                'billing_cities' => $billing_cities,
                'shipping_states' => $shipping_states,
                'shipping_cities' => $shipping_cities,
                'work_states' => $work_states,
                'work_cities' => $work_cities,
                'tags' => $tags,
                'service_categories' => $service_categories,
                'languages' => $languages,
                'appointment_types' => $appointment_types
            ];
        }
        if($request->session()->get('logged_in_as') == 'student'){
            $student = $user->student;
            $student = Student::withChildrens()->withAll()->where('id',$student->id)->first();
            $student = new StudentsResource($student);
            $countries = Country::active()->get();
            $states = State::active()->where('country_id',$student->country_id)->get();
            $cities = City::active()->where('state_id',$student->state_id)->get();
            $data = [
                'student' => $student,
                'countries' => $countries,
                'states' => $states,
                'cities' => $cities,
            ];
        }

        return Inertia::render('Account',$data);
    }

    public function updateStudentGeneralInformation(UpdateStudentGeneralInfoRequest $request)
    {
        $user = auth()->user();
        $student = $user->student;
        if($student){
            $student->update($request->only(['first_name','last_name','user_name','description','country_id','state_id','city_id','address_line_1','address_line_2','zip_code']));
            $image = uploadCroppedFile($request,'image','profile_images',$student->image);
            $cover_image = uploadCroppedFile($request,'cover_image','cover_images',$student->cover_images);
            $student->update(['image' => $image]);
            $student->update(['cover_image' => $cover_image]);
        }
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Profile Updated Successfully',
        ]);
        return redirect()->back()->withResponseData([
            'message' => 'Profile Updated Successfully',
            'type' => 'success'
        ]);
    }

    public function updateTeacherGeneralInformation(UpdateTeacherGeneralInfoRequest $request)
    {
        $user = auth()->user();
        $teacher = $user->teacher;
        if($teacher){
            $teacher->update($request->only(['first_name','last_name','description','country_id','state_id','city_id','experience','speciality','address_line_1','address_line_2','longitude','latitude','zip_code','user_name','is_energy_exchange','is_co_creation',
            'prefix','suffix','home_phone','cell_phone','job_title','company','website','email',
            'billing_address_line_1','billing_address_line_2','billing_country_id', 'billing_state_id', 'billing_city_id','billing_zip_code',
            'shipping_address_line_1','shipping_address_line_2','shipping_country_id', 'shipping_state_id', 'shipping_city_id','shipping_zip_code',
            'work_address_line_1','work_address_line_2','work_country_id', 'work_state_id', 'work_city_id','work_zip_code']));
            $image = uploadCroppedFile($request,'image','profile_images',$teacher->image);
            $cover_image = uploadCroppedFile($request,'cover_image','cover_images',$teacher->cover_image);
            $teacher->update(['image' => $image]);
            $teacher->update(['cover_image' => $cover_image]);
            $teacher->teacher_categories()->sync($request->teacher_categories);
            $teacher->languages()->sync($request->languages);
            $teacher->tags()->sync($request->tags);
        }
        // $this->updateUserProifleCompletion('healer');

        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Profile Updated Successfully',
        ]);
        return redirect()->back()->withResponseData([
            'message' => 'Profile Updated Successfully',
            'type' => 'success'
        ]);
    }

    public function updateTeacherSettings(Request $request){
        $user = Auth::user();
        $teacher = $user->teacher;
        foreach($request->settings as $setting){
            $teacher->teacher_settings()->updateOrCreate(['name' => $setting['name']],$setting);
        }
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Settings Updated Successfully',
        ]);
        return redirect()->back()->withResponseData([
            'message' => 'Settings Updated Successfully',
            'type' => 'success'
        ]);
    }

    public function updateAcademyGeneralInformation(UpdateAcademyGeneralInfoRequest $request)
    {
        $user = auth()->user();
        $academy = $user->academy;
        if($academy){
            $academy->update($request->only(['academy_name','academy_website','first_name','last_name','description','country_id','state_id','city_id','address_line_1','address_line_2','zip_code','user_name','longitude','latitude','prefix','suffix','home_phone','cell_phone','job_title','company','website','email',
            'billing_address_line_1','billing_address_line_2','billing_country_id', 'billing_state_id', 'billing_city_id','billing_zip_code',
            'shipping_address_line_1','shipping_address_line_2','shipping_country_id', 'shipping_state_id', 'shipping_city_id','shipping_zip_code',
            'work_address_line_1','work_address_line_2','work_country_id', 'work_state_id', 'work_city_id','work_zip_code']));
            $image = uploadCroppedFile($request,'image','profile_images',$academy->image);
            $cover_image = uploadCroppedFile($request,'cover_image','cover_images',$academy->cover_image);

            $academy->update(['image' => $image]);
            $academy->update(['cover_image' => $cover_image]);

            $academy->academy_categories()->sync($request->academy_categories);
            $academy->languages()->sync($request->languages);
            $academy->tags()->sync($request->tags);
        }
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Profile Updated Successfully',
        ]);
        return redirect()->back()->withResponseData([
            'message' => 'Profile Updated Successfully',
            'type' => 'success'
        ]);
    }

    public function updateAcademySettings(Request $request){
        $user = Auth::user();
        $academy = $user->academy;
        foreach($request->settings as $setting){
            $academy->academy_settings()->updateOrCreate(['name' => $setting['name']],$setting);
        }
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Settings Updated Successfully',
        ]);
        return redirect()->back()->withResponseData([
            'message' => 'Settings Updated Successfully',
            'type' => 'success'
        ]);
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
        // $request->session()->put('logged_in_as', Role::$Teacher);
        // request()->session()->flash('alert', [
        //     'type' => 'success',
        //     'message' => 'Successfully Switched To '.ucfirst(Role::$Teacher),
        // ]);
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Now, You Are A Teacher Also',
        ]);
        return redirect()->back();
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
        // $request->session()->put('logged_in_as', Role::$Student);
        // request()->session()->flash('alert', [
        //     'type' => 'success',
        //     'message' => 'Successfully Switched To '.ucfirst(Role::$Student),
        // ]);
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Now, You Are A Student Also',
        ]);
        return redirect()->back();
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
        // $request->session()->put('logged_in_as', Role::$Academy);
        // request()->session()->flash('alert', [
        //     'type' => 'success',
        //     'message' => 'Successfully Switched To '.ucfirst(Role::$Academy),
        // ]);
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Now, You Are A Academy User Also',
        ]);
        return redirect()->back();
    }
    public function switchRole(Request $request,$role){
        $user = Auth::user();
        $logged_in_as = $request->session()->get('logged_in_as');
        $data = $user->{$logged_in_as};
        if($user->hasRole($role)){
            if(isset($data)){
                $data->update(['is_online' => 0]);
            }
            if(isset($user->{$role})){
                $user->{$role}->update(['is_online' => 1]);
            }
            $request->session()->put('logged_in_as', $role);
        }

        if(ucfirst($role) == 'Teacher'){
           $role = 'Tutor';
        }
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Successfully Switched To '.ucfirst($role),
        ]);
        return redirect()->back();
    }

    public function getStates(Request $request){
        $request->validate(['country_id' => 'exists:countries,id']);
        $states = APIGeneralController::getStates($request);
        $response = generateResponse($states,true,"States Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getCities(Request $request){
        $request->validate(['city_id' => 'exists:cities,id']);
        $cities = APIGeneralController::getCities($request);
        $response = generateResponse($cities,true,"Cities Fetched Successfully",null,'collection');
        return response()->json($response);
    }
}
