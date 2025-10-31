<?php

namespace App\Http\Middleware;

use App\Http\Resources\Web\AcademiesResource;
use App\Http\Resources\Web\StudentsResource;
use App\Http\Resources\Web\TeachersResource;
use App\Models\CompanyPage;
use App\Models\Currency;
use App\Models\Academy;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Support\Facades\File;
class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {

         if (!File::exists(storage_path('installed'))) {
                 return array_merge(parent::share($request), [
             ]);
        }
        $languages = Language::active()->get();
        $locale = app()->getLocale();
        $company_pages = CompanyPage::active()->notDefault()->get();
        $all_company_pages = [];
        foreach ($company_pages as $company_page) {
            $temp['name'] = $company_page->getTranslation('name' , session()->get('locale') ?? app()->getLocale());
            $temp['heading'] = $company_page->getTranslation('heading' , session()->get('locale') ?? app()->getLocale());
            $temp['description'] = $company_page->getTranslation('description' , session()->get('locale') ?? app()->getLocale());
            $temp['slug'] = $company_page->slug;
            $all_company_pages[] = $temp;
        }
        $user = Auth::user();
        $logged_in_as = $request->session()->get('logged_in_as');
        if($logged_in_as == 'teacher'){
            config(['cashier.model' => 'App\Models\Teacher']);
            $teacher = Teacher::withAll()->where('id',$user->teacher->id)->first();
            if($teacher->pricing_plan){
                $pricing_plan = $teacher->pricing_plan;
                $teacher_modules = $pricing_plan->teacher_modules()->pluck('pricing_plan_modules.module_code')->toArray();
            }else{
                $teacher_modules = [];
            }
            $login_info = new TeachersResource($teacher);
        }else if($logged_in_as == 'academy'){
            config(['cashier.model' => 'App\Models\Academy']);
            $academy = Academy::withAll()->where('id',$user->academy->id)->first();
            if($academy->pricing_plan){
                $pricing_plan = $academy->pricing_plan;
                $academy_modules = $pricing_plan->academy_modules()->pluck('pricing_plan_modules.module_code')->toArray();
            }else{
                $academy_modules = [];
            }
            $login_info = new AcademiesResource($academy);
        }else if($logged_in_as == 'student'){
            $student = Student::withAll()->where('id',$user->student->id)->first();
            $login_info = new StudentsResource($student);
        }
        else{
            $login_info = null;
        }
        $all_pages_content = pagesTranslations();
        $settings = generalSettings();

        return array_merge(parent::share($request), [
            'locale' => function () {
                return app()->getLocale();
            },
            'flash' => [
                'alert' => $request->session()->get('alert'),
                'status' => $request->session()->get('status')
            ],
            'response_data' => $request->session()->get('response_data'),
            'translation_languages' => $languages,
            'default_currency' => Currency::where('is_default',1)->first(),
            'company_pages' => $all_company_pages,
            'all_pages_content' => $all_pages_content,
            'language' => function () {
                return translations(
                    resource_path('lang/' . app()->getLocale() . '.json')
                );
            },
            'settings' => $settings,
            'auth' => $user ? [
                'user' => $user,
                'roles' => $user->roles()->pluck('roles.role_code')->toArray(),
                'teacher_modules' => $teacher_modules ?? [],
                'academy_modules' => $academy_modules ?? [],
                $logged_in_as => $login_info,
                'logged_in_as' => $request->session()->get('logged_in_as')
            ] : null
        ]);
    }
}
