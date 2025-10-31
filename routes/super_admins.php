<?php

use App\Http\Controllers\SuperAdmin\AJAXController;
use App\Http\Controllers\SuperAdmin\ArchiveCategoriesController;
use App\Http\Controllers\SuperAdmin\Auth\ForgotPasswordController;
use App\Http\Controllers\SuperAdmin\Auth\LoginController;
use App\Http\Controllers\SuperAdmin\RolesController;
use App\Http\Controllers\SuperAdmin\UsersController;
use App\Http\Controllers\SuperAdmin\StudentsController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\GeneralSettingsController;
use App\Http\Controllers\SuperAdmin\ProfileController;
use App\Http\Controllers\SuperAdmin\BlogCategoriesController;
use App\Http\Controllers\SuperAdmin\CitiesController;
use App\Http\Controllers\SuperAdmin\CompanyPagesController;
use App\Http\Controllers\SuperAdmin\CountriesController;
use App\Http\Controllers\SuperAdmin\FAQCategoriesController;
use App\Http\Controllers\SuperAdmin\EventsController;
use App\Http\Controllers\SuperAdmin\FAQSController;
use App\Http\Controllers\SuperAdmin\LanguagesController;
use App\Http\Controllers\SuperAdmin\StatesController;
use App\Http\Controllers\SuperAdmin\PricingPlansController;
use App\Http\Controllers\SuperAdmin\TagsController;
use App\Http\Controllers\SuperAdmin\TestimonialsController;
use App\Http\Controllers\SuperAdmin\PagesContentsController;
use App\Http\Controllers\SuperAdmin\ContactsController;
use App\Http\Controllers\SuperAdmin\PostsController;
use App\Http\Controllers\SuperAdmin\ArchivesController;
use App\Http\Controllers\SuperAdmin\PodcastsController;
use App\Http\Controllers\SuperAdmin\BroadcastsController;
use App\Http\Controllers\SuperAdmin\BroadcastCategoriesController;
use App\Http\Controllers\SuperAdmin\EventCategoriesController;
use App\Http\Controllers\SuperAdmin\PodcastCategoriesController;
use App\Http\Controllers\SuperAdmin\BookedAppointmentsController;
use App\Http\Controllers\SuperAdmin\CurruncyController;
use App\Http\Controllers\SuperAdmin\GatewaysController;
//Academy
use App\Http\Controllers\SuperAdmin\AcademyCategoriesController;
use App\Http\Controllers\SuperAdmin\AcademyMainCategoriesController;
use App\Http\Controllers\SuperAdmin\AcademiesController;
use App\Http\Controllers\SuperAdmin\AcademyPostsController;
use App\Http\Controllers\SuperAdmin\AcademyEventsController;
use App\Http\Controllers\SuperAdmin\AcademyCertificationsController;
use App\Http\Controllers\SuperAdmin\AcademyBroadcastsController;
use App\Http\Controllers\SuperAdmin\AcademyPodcastsController;
use App\Http\Controllers\SuperAdmin\AcademyArchivesController;
use App\Http\Controllers\SuperAdmin\BankAccountsController;
use App\Http\Controllers\SuperAdmin\BankTransactionsController;
use App\Http\Controllers\SuperAdmin\CommissionSettingsController;
use App\Http\Controllers\SuperAdmin\NotificationSettingsController;
//Academy
//Teacher
use App\Http\Controllers\SuperAdmin\TeacherPostsController;
use App\Http\Controllers\SuperAdmin\TeacherEventsController;
use App\Http\Controllers\SuperAdmin\TeacherEducationsController;
use App\Http\Controllers\SuperAdmin\TeacherExperiencesController;
use App\Http\Controllers\SuperAdmin\TeacherCertificationsController;
use App\Http\Controllers\SuperAdmin\TeacherBroadcastsController;
use App\Http\Controllers\SuperAdmin\TeacherPodcastsController;
use App\Http\Controllers\SuperAdmin\TeacherArchivesController;
use App\Http\Controllers\SuperAdmin\TeacherCategoriesController;
use App\Http\Controllers\SuperAdmin\TeacherMainCategoriesController;
use App\Http\Controllers\SuperAdmin\TeachersController;
use App\Http\Controllers\SuperAdmin\PaymentMethodsController;
use App\Http\Controllers\SuperAdmin\ServiceCategoriesController;
use App\Http\Controllers\SuperAdmin\ServicesController;
use App\Http\Controllers\SuperAdmin\VersionUpgradesController;
use App\Http\Controllers\SuperAdmin\WithdrawRequestsController;
//Teacher

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->prefix('super_admin')->name('super_admin.')->group(function () {
    Route::post('login', [LoginController::class, 'login'])->name('submit_login');
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('reset_password', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset_password');
    Route::get('forgot_password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot_password');
    Route::post('submit_reset_password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('submit_reset_password');
    Route::post('submit_forgot_password', [ForgotPasswordController::class, 'submitForgotPasswordForm'])->name('submit_forgot_password');
});

Route::middleware(['auth', 'super_admin'])->prefix('super_admin')->name('super_admin.')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'home'])->name('dashboard');
    Route::resource('users', UsersController::class);
    Route::crudRoutes('students', StudentsController::class);
    Route::crudRoutes('teachers', TeachersController::class);
    Route::get('teachers/blogs/{teacher}', [TeachersController::class, 'viewBlogs'])->name('teachers.blog');
    Route::get('teachers/events/{teacher}', [TeachersController::class, 'viewEvents'])->name('teachers.event');
    Route::put('teachers/{teacher}/approve', [TeachersController::class, 'approve'])->name('teachers.approve');
    Route::put('teachers-bulk/{type}', [TeachersController::class, 'bulkActionTeachers'])->name('teachers.bulk');
    Route::crudRoutes('academies', AcademiesController::class);
    Route::put('academies/{academy}/approve', [AcademiesController::class, 'approve'])->name('academies.approve');
    Route::put('academies-bulk/{type}', [AcademiesController::class, 'bulkActionAcademies'])->name('academies.bulk');
    Route::crudRoutes('events', EventsController::class);
    Route::put('events/{event}/approve', [EventsController::class, 'approve'])->name('events.approve');

    Route::crudRoutes('tags', TagsController::class);
    Route::crudRoutes('testimonials', TestimonialsController::class);
    Route::crudRoutes('company_pages', CompanyPagesController::class);
    Route::crudRoutes('teacher_categories', TeacherCategoriesController::class);
    Route::crudRoutes('teacher_main_categories', TeacherMainCategoriesController::class);
    Route::crudRoutes('academy_categories', AcademyCategoriesController::class);
    Route::crudRoutes('academy_main_categories', AcademyMainCategoriesController::class);
    Route::crudRoutes('blog_categories', BlogCategoriesController::class);
    Route::crudRoutes('event_categories', EventCategoriesController::class);
    Route::crudRoutes('faq_categories', FAQCategoriesController::class);
    Route::crudRoutes('podcast_categories', PodcastCategoriesController::class);
    Route::crudRoutes('broadcast_categories', BroadcastCategoriesController::class);
    Route::crudRoutes('faqs', FAQSController::class);
    Route::crudRoutes('posts', PostsController::class);
    Route::crudRoutes('archives', ArchivesController::class);
    Route::crudRoutes('booked_appointments', BookedAppointmentsController::class);
    Route::crudRoutes('podcasts', PodcastsController::class);
    Route::crudRoutes('broadcasts', BroadcastsController::class);


    Route::dependentCrudRoutes('teacher_posts/{teacher}', TeacherPostsController::class);
    Route::dependentCrudRoutes('teacher_events/{teacher}', TeacherEventsController::class);
    Route::dependentCrudRoutes('teacher_educations/{teacher}', TeacherEducationsController::class);
    Route::dependentCrudRoutes('teacher_experiences/{teacher}', TeacherExperiencesController::class);
    Route::dependentCrudRoutes('teacher_certifications/{teacher}', TeacherCertificationsController::class);
    Route::dependentCrudRoutes('teacher_broadcasts/{teacher}', TeacherBroadcastsController::class);
    Route::dependentCrudRoutes('teacher_podcasts/{teacher}', TeacherPodcastsController::class);
    Route::dependentCrudRoutes('teacher_archives/{teacher}', TeacherArchivesController::class);

    //Law firm
    Route::dependentCrudRoutes('academy_posts/{academy}', AcademyPostsController::class);
    Route::dependentCrudRoutes('academy_events/{academy}', AcademyEventsController::class);
    // Route::dependentCrudRoutes('academy_educations/{academy}', AcademyEducationsController::class);
    // Route::dependentCrudRoutes('academy_experiences/{academy}', AcademyExperiencesController::class);
    Route::dependentCrudRoutes('academy_certifications/{academy}', AcademyCertificationsController::class);
    Route::dependentCrudRoutes('academy_broadcasts/{academy}', AcademyBroadcastsController::class);
    Route::dependentCrudRoutes('academy_podcasts/{academy}', AcademyPodcastsController::class);
    Route::dependentCrudRoutes('academy_archives/{academy}', AcademyArchivesController::class);

    Route::prefix('teachers')->name('teachers.')->group(function () {
        Route::get('profile/{teacher}', [TeachersController::class, 'profile'])->name('profile');
    });
    Route::prefix('academies')->name('academies.')->group(function () {
        Route::get('profile/{academy}', [AcademiesController::class, 'profile'])->name('profile');
    });

    Route::crudRoutes('bank_accounts', BankAccountsController::class);
    Route::crudRoutes('bank_transactions', BankTransactionsController::class);
    Route::put('bank_transactions/{bank_transaction}/approve', [BankTransactionsController::class, 'approve'])->name('bank_transactions.approve');
    Route::put('bank_transactions-bulk/{type}', [BankTransactionsController::class, 'approveapprove'])->name('bank_transactions.bulk');

    Route::crudRoutes('archive_categories', ArchiveCategoriesController::class);
    Route::crudRoutes('languages', LanguagesController::class);
    Route::crudRoutes('countries', CountriesController::class);
    Route::crudRoutes('states', StatesController::class);
    Route::crudRoutes('cities', CitiesController::class);
    Route::get('cities_states', [AJAXController::class, 'getStatesByCountry'])->name('getStatesByCountry');

    Route::crudRoutes('pricing_plans', PricingPlansController::class);
    Route::post('pricing_plans_syn', [PricingPlansController::class, 'syncPlans'])->name('pricing_plans.sync');

    Route::get('commission', [CommissionSettingsController::class, 'index'])->name('commission.index');
    Route::post('commission', [CommissionSettingsController::class, 'commissionUpdate'])->name('commission.update');

    Route::get('version', [VersionUpgradesController::class, 'index'])->name('version_upgrade.index');
    Route::post('version_upgrade', [VersionUpgradesController::class, 'upgrade'])->name('version_upgrade.upgrade');

    // General Settings route
    Route::get('general_settings', [GeneralSettingsController::class, 'index'])->name('general_settings.index');
    Route::get('social_media_settings', [GeneralSettingsController::class, 'getSocialLinksSettings'])->name('specific_settings.social_media_settings');
    Route::get('payment_method_settings', [GeneralSettingsController::class, 'getPaymentMethodsSettings'])->name('specific_settings.payment_method_settings');
    Route::get('footer_settings', [GeneralSettingsController::class, 'getFooterSettings'])->name('specific_settings.footer_settings');
    Route::get('configurations', [GeneralSettingsController::class, 'getconfigurationsSettings'])->name('specific_settings.configurations');
    Route::get('home_page_statistics_settings', [GeneralSettingsController::class, 'getHomePageStatisticsSettings'])->name('specific_settings.home_page_statistics_settings');

    Route::put('general_settings', [GeneralSettingsController::class, 'update'])->name('general_settings.update');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('roles', RolesController::class);
    Route::get('get_permissions_except_role', [RolesController::class, 'getPermissionsExceptRole'])->name('getPermissionsExceptRole');
    Route::get('view_notifications/{type}', [DashboardController::class, 'viewNotification'])->name('viewNotifications');

    // Content Pages
    Route::get('pages_contents/{section}', [PagesContentsController::class, 'getPageContent'])->name('pages_contents.get');
    Route::put('pages_contents', [PagesContentsController::class, 'update'])->name('pages_contents.update');

    //Contact
    Route::crudRoutes('contacts', ContactsController::class);


    Route::crudRoutes('gateways', GatewaysController::class);
    Route::crudRoutes('currencies', CurruncyController::class);
    Route::crudRoutes('withdraw_requests', WithdrawRequestsController::class);
    Route::resource('notification_settings', NotificationSettingsController::class);

    // Quick By Services
    Route::crudRoutes('service_categories', ServiceCategoriesController::class);
    Route::crudRoutes('services', ServicesController::class);
    Route::put('services/{service}/approve', [ServicesController::class, 'approve'])->name('services.approve');
    Route::put('services-bulk/{type}', [ServicesController::class, 'bulkActionServices'])->name('services.bulk');


    // Route::get('payment-methods', 'Admin\PaymentMethodController@index')->name('payment.methods');
    // Route::post('payment-methods/deactivate', 'Admin\PaymentMethodController@deactivate')->name('payment.methods.deactivate');
    // Route::get('payment-methods/deactivate', 'Admin\PaymentMethodController@deactivate')->name('payment.methods.deactivate');
    // Route::post('sort-payment-methods', 'Admin\PaymentMethodController@sortPaymentMethods')->name('sort.payment.methods');
    // Route::get('payment-methods/edit/{id}', 'Admin\PaymentMethodController@edit')->name('edit.payment.methods');
    // Route::put('payment-methods/update/{id}', 'Admin\PaymentMethodController@update')->name('update.payment.methods');
});
