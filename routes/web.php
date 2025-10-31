<?php

use App\Http\Controllers\AgoraController;
use App\Http\Controllers\API\APIController;
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\WebAPIController;
use App\Http\Controllers\Academies\AcademyArchivesController;
use App\Http\Controllers\Academies\AcademyBroadcastsController;
use App\Http\Controllers\Academies\AcademyEventsController;
use App\Http\Controllers\Academies\AcademyPodcastsController;
use App\Http\Controllers\Academies\AcademyPostsController;
use App\Http\Controllers\Academies\AcademyProfileController;
use App\Http\Controllers\CompanyPagesController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\Students\ReviewsController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\Teachers\TeacherArchivesController;
use App\Http\Controllers\Teachers\TeacherBroadcastsController;
use App\Http\Controllers\Teachers\TeacherEventsController;
use App\Http\Controllers\Teachers\TeacherPodcastsController;
use App\Http\Controllers\Teachers\TeacherPostsController;
use App\Http\Controllers\Teachers\TeacherProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\PricingPlansController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\PusherBeam\PusherBeamService;
use App\Http\Controllers\Teachers\AppointmentScheduleController;
use App\Http\Controllers\Teachers\BookAppointmentController as TeachersBookAppointmentController;
use App\Http\Controllers\Students\BookAppointmentController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppointmentRatingsController;
use App\Http\Controllers\Academies\AppointmentScheduleController as AcademiesAppointmentScheduleController;
use App\Http\Controllers\Academies\BookAppointmentController as AcademiesBookAppointmentController;
use App\Http\Controllers\ChatMessagesController;
use App\Http\Controllers\Academies\AcademyCertificationsController;
use App\Http\Controllers\Academies\AcademyTeachersController;
use App\Http\Controllers\Academies\AcademyServicesController;
use App\Http\Controllers\Teachers\TeacherServicesController;
use App\Http\Controllers\Teachers\TeacherCertificationsController;
use App\Http\Controllers\Teachers\TeacherExperiencesController;
use App\Http\Controllers\Teachers\TeacherEducationsController;
use App\Http\Middleware\API\Teacher;
use App\Models\Archive;
use App\Models\Broadcast;
use App\Models\Event;
use App\Models\Academy;
use App\Models\Teacher as ModelsTeacher;
use App\Models\Podcast;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\Students\BookedServicesController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\Teachers\BookedServicesController as TeachersBookedServicesController;
use App\Http\Controllers\Academies\BookedServicesController as AcademiesBookedServicesController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\PaymentMethods\StripePaymentsController;
use App\Http\Controllers\ServiceRatingsController;
use App\Models\BankAccount;

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

Route::get('gateways', [PaymentController::class,'gateways']);
Route::get('add_fund_request', [PaymentController::class,'addFundRequest'])->name('user.addFund');
Route::get('add_fund_confirm/{transaction}', [PaymentController::class,'depositConfirm'])->name('user.addFund.confirm');
Route::match(['get', 'post'], 'success', [PaymentController::class,'success'])->name('success');
Route::match(['get', 'post'], 'failed', [PaymentController::class,'failed'])->name('failed');
Route::match(['get', 'post'], 'payment/{code}/{trx?}/{type?}', [PaymentController::class,'gatewayIpn'])->name('ipn');

Route::get('/email/verify', [VerificationController::class, 'showEmailVerificationPage'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [VerificationController::class, 'resendVerificationEmail'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/start', function () {
    return Inertia::render('Auth/SelectRole');
})->name('start');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/forgot_password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot_password');
Route::get('/reset_password', [AuthController::class, 'showResetPasswordForm'])->name('reset_password');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/login', [AuthController::class, 'submitLoginForm'])->name('submit.login');
Route::post('/register', [AuthController::class, 'submitRegisterForm'])->name('submit.register');
Route::post('/forgot_password', [AuthController::class, 'submitForgotPasswordForm'])->name('password.forgot');
Route::post('/reset_password', [AuthController::class, 'submitResetPasswordForm'])->name('password.reset');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/social_auth/{provider}', [SocialAuthController::class, 'redirectToProvider'])->name('social_redirect');
Route::get('/social_auth/{provider}/callback', [SocialAuthController::class, 'providerCallback'])->name('social_callback');

Route::get('language/{language}', function (Request $request, $language) {
    session()->put('locale', $language);
    request()->session()->flash('alert', [
        'type' => 'info',
        'message' => 'Language Switched Successfully',
    ]);
    return redirect()->back();
})->name('language');

Route::prefix('teachers')->name('teachers.')->group(function () {
    Route::post('update_general_info', [AccountController::class, 'updateTeacherGeneralInformation'])->name('update_general_info');
    Route::post('update_settings', [AccountController::class, 'updateTeacherSettings'])->name('update_settings');

    Route::apiCrudRoutes('teacher_broadcasts', TeacherBroadcastsController::class);
    Route::apiCrudRoutes('teacher_podcasts', TeacherPodcastsController::class);
    Route::apiCrudRoutes('teacher_events', TeacherEventsController::class);
    Route::apiCrudRoutes('teacher_archives', TeacherArchivesController::class);
    Route::apiCrudRoutes('teacher_posts', TeacherPostsController::class);
    Route::apiCrudRoutes('teacher_certifications', TeacherCertificationsController::class);
    Route::apiCrudRoutes('teacher_experiences', TeacherExperiencesController::class);
    Route::apiCrudRoutes('teacher_educations', TeacherEducationsController::class);
    Route::apiCrudRoutes('teacher_services', TeacherServicesController::class);
});
Route::prefix('academies')->name('academies.')->group(function () {
    Route::post('update_general_info', [AccountController::class, 'updateAcademyGeneralInformation'])->name('update_general_info');
    Route::post('update_settings', [AccountController::class, 'updateAcademySettings'])->name('update_settings');
    Route::apiCrudRoutes('academy_services', AcademyServicesController::class);
    Route::apiCrudRoutes('academy_broadcasts', AcademyBroadcastsController::class);
    Route::apiCrudRoutes('academy_podcasts', AcademyPodcastsController::class);
    Route::apiCrudRoutes('academy_events', AcademyEventsController::class);
    Route::apiCrudRoutes('academy_archives', AcademyArchivesController::class);
    Route::apiCrudRoutes('academy_posts', AcademyPostsController::class);
    Route::apiCrudRoutes('academy_certifications', AcademyCertificationsController::class);
    Route::apiCrudRoutes('academy_teachers', AcademyTeachersController::class);
});
Route::prefix('students')->name('students.')->group(function () {
    Route::post('add_teacher_review', [ReviewsController::class, 'addTeacherReview'])->name('add_teacher_review');
    Route::post('add_academy_review', [ReviewsController::class, 'addAcademyReview'])->name('add_academy_review');
});

Route::prefix('students')->name('students.')->group(function () {
    Route::post('update_general_info', [AccountController::class, 'updateStudentGeneralInformation'])->name('update_general_info');
    Route::post('book_appointment', [BookAppointmentController::class, 'bookAppointment'])->name('book_appointment');
    Route::get('appointment_bank_transfers/{appointment_id}', [BookAppointmentController::class, 'getBankTransfers'])->name('appointment_bank_transfers');
    Route::post('fund_bank_transfer',[BookAppointmentController::class,'fundBankTransfer'])->name('fund_bank_transfer');

    Route::post('book_service', [BookedServicesController::class, 'bookService'])->name('book_service');
    Route::get('service_bank_transfers/{service_id}', [BookedServicesController::class, 'getBankTransfers'])->name('service_bank_transfers');

    Route::get('appointment_stripe_transfers/{appointment_id}', [StripePaymentsController::class, 'getStripeAccount'])->name('appointment_stripe_transfers');
    Route::get('service_stripe_transfers/{service_id}', [StripePaymentsController::class, 'getServiceStripeAccount'])->name('service_stripe_transfers');
    Route::get('wallet_stripe_transfers', [StripePaymentsController::class, 'getStripeAccountForWallet'])->name('appointment_stripe_transfers_for_wallet');
});
Route::get('book_service/{service}', [BookedServicesController::class, 'showBookServicePage'])->name('book_service_display')->middleware(['auth','student']);

Route::prefix('teacher')->name('teacher.')->group(function () {
    Route::get('profile', [TeacherProfileController::class, 'myProfile'])->name('my_profile');
    Route::get('profile/{user_name}', [TeacherProfileController::class, 'profile'])->name('profile');
    Route::get('reviews/{user_name}', [TeacherProfileController::class, 'reviews'])->name('reviews');

    Route::post('save_appointment_schedules', [AppointmentScheduleController::class, 'saveAppointmentSchedule'])->name('save_appointment_schedules');
    Route::post('add_new_appointment_schedules', [AppointmentScheduleController::class, 'addNewAppointmentSchedule'])->name('add_new_appointment_schedules');
    Route::post('delete_appointment_slots', [AppointmentScheduleController::class, 'deleteAppointmentScheduleSlots'])->name('delete_appointment_slots');
    Route::get('/api_appointment_schedules', [AppointmentScheduleController::class, 'getAppointmentSchedules'])->name('getApiAppointmentSchedules');
    Route::get('/get_appointment_commission', [AppointmentScheduleController::class, 'getAppointmentCommission'])->name('getApiAppointmentCommission');
    Route::get('profile/{user_name}/book_appointment', [TeacherProfileController::class, 'bookAppointment'])->name('book_appointment')->middleware(['auth','student']);
});
Route::prefix('academy')->name('academy.')->group(function () {
    Route::get('profile', [AcademyProfileController::class, 'myProfile'])->name('my_profile');
    Route::get('profile/{user_name}', [AcademyProfileController::class, 'profile'])->name('profile');
    Route::get('reviews/{user_name}', [AcademyProfileController::class, 'reviews'])->name('reviews');
    Route::post('save_appointment_schedules', [AcademiesAppointmentScheduleController::class, 'saveAppointmentSchedule'])->name('save_appointment_schedules');
    Route::post('add_new_appointment_schedules', [AcademiesAppointmentScheduleController::class, 'addNewAppointmentSchedule'])->name('add_new_appointment_schedules');
    Route::post('delete_appointment_slots', [AcademiesAppointmentScheduleController::class, 'deleteAppointmentScheduleSlots'])->name('delete_appointment_slots');
    Route::get('/api_appointment_schedules', [AcademiesAppointmentScheduleController::class, 'getAppointmentSchedules'])->name('getApiAppointmentSchedules');
    Route::get('/get_appointment_commission', [AcademiesAppointmentScheduleController::class, 'getAppointmentCommission'])->name('getApiAppointmentCommission');
    Route::get('profile/{user_name}/book_appointment', [AcademyProfileController::class, 'bookAppointment'])->name('book_appointment')->middleware(['auth','student']);
});

Route::post('add_appointment_rating', [AppointmentRatingsController::class, 'addAppointmentRating'])->name('add_appointment_rating');
Route::post('add_service_rating', [ServiceRatingsController::class, 'addServiceRating'])->name('add_service_rating');
Route::get('/account', [AccountController::class, 'showAccountPage'])->name('account');
Route::post('/account_become_teacher', [AccountController::class, 'becomeTeacher'])->name('account.become_teacher');
Route::post('/account_become_user', [AccountController::class, 'becomeUser'])->name('account.become_user');
Route::post('/account_become_academy', [AccountController::class, 'becomeAcademy'])->name('account.become_academy');
Route::post('/account_switch_role/{role}', [AccountController::class, 'switchRole'])->name('account.switch_role');
Route::get('/account_states', [AccountController::class, 'getStates'])->name('account.getStates');
Route::get('/account_cities', [AccountController::class, 'getCities'])->name('account.getCities');

Route::get('/api_countries', [WebAPIController::class, 'getCountries'])->name('getApiCountries');
Route::get('/api_teacher_categories', [WebAPIController::class, 'getTeacherCategories'])->name('getApiTeacherCategories');
Route::get('/api_featured_teacher_categories', [WebAPIController::class, 'getFeaturedTeacherCategories'])->name('getApiFeaturedTeacherCategories');
Route::get('/api_teacher_main_categories', [APIController::class, 'getTeacherMainCategoriesWithChildrens'])->name('getApiTeacherMainCategories');

Route::get('/api_academy_categories', [WebAPIController::class, 'getAcademyCategories'])->name('getApiAcademyCategories');
Route::get('/api_featured_teachers', [WebAPIController::class, 'getFeaturedTeachers'])->name('getApiFeaturedTeachers');
Route::get('/api_top_rated_teachers', [WebAPIController::class, 'getTopRatedTeachers'])->name('getApiTopRatedTeachers');
Route::get('/api_premium_teachers', [WebAPIController::class, 'getPremiumTeachers'])->name('getApiPremiumTeachers');

Route::get('/api_featured_academies', [WebAPIController::class, 'getFeaturedAcademies'])->name('getApiFeaturedAcademies');
Route::get('/api_featured_events', [WebAPIController::class, 'getFeaturedEvents'])->name('getApiFeaturedEvents');
Route::get('/api_featured_tags', [WebAPIController::class, 'getFeaturedTags'])->name('getApiFeaturedTags');
Route::post('/api_teachers', [WebAPIController::class, 'getTeachers'])->name('getApiTeachers');
Route::post('/api_academies', [WebAPIController::class, 'getAcademies'])->name('getApiAcademies');
Route::post('/api_teacher_reviews/{user_name}', [WebAPIController::class, 'getTeacherReviews'])->name('getApiTeacherReviews');
Route::post('/api_academy_reviews/{user_name}', [WebAPIController::class, 'getAcademyReviews'])->name('getApiAcademyReviews');

Route::get('/api_testimonials', [WebAPIController::class, 'getTestimonials'])->name('getApiTestimonials');

Route::post('/api_events', [WebAPIController::class, 'getEvents'])->name('getApiEvents');
Route::get('/api_blog_categories', [WebAPIController::class, 'getBlogCategories'])->name('getApiBlogCategories');
Route::get('/api_tags', [WebAPIController::class, 'getTags'])->name('getApiTags');
Route::get('/api_archive_categories', [WebAPIController::class, 'getArchiveCategories'])->name('getApiArchiveCategories');
Route::post('/api_posts', [WebAPIController::class, 'getPosts'])->name('getApiPosts');
Route::post('/api_archives', [WebAPIController::class, 'getArchives'])->name('getApiArchives');
Route::get('/api_archive_courses', [WebAPIController::class, 'getCourses'])->name('getApiCourses');
Route::post('/api_broadcasts', [WebAPIController::class, 'getBroadcasts'])->name('getApiBroadcasts');
Route::post('/api_podcasts', [WebAPIController::class, 'getPodcasts'])->name('getApiPodcasts');
Route::get('/api_faqs', [WebAPIController::class, 'getFaqs'])->name('getApiFaqs');

Route::get('/api_service_categories', [WebAPIController::class, 'getServiceCategories'])->name('getApiServiceCategories');
Route::post('/api_services', [WebAPIController::class, 'getServices'])->name('getApiServices');

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/pricing/{type}', [PricingPlansController::class, 'index'])->name('pricing');
Route::get('/pricing/{type}/{slug}', [PricingPlansController::class, 'show'])->name('pricing.show');
Route::post('/subscription/{type}/{slug}', [PricingPlansController::class, 'subscription'])->name('pricing.subscription');

Route::get('teachers', [ListingController::class, 'teacherListing'])->name('teachers.listing');
Route::post('teachers', [ListingController::class, 'teacherListing'])->name('teachers.listing');
Route::get('academies', [ListingController::class, 'academyListing'])->name('academies.listing');
Route::get('events', [ListingController::class, 'eventListing'])->name('events.listing');
Route::get('blogs', [ListingController::class, 'blogListing'])->name('blogs.listing');
Route::get('courses', [ListingController::class, 'archiveListing'])->name('archives.listing');
Route::get('podcasts', [ListingController::class, 'podcastListing'])->name('podcasts.listing');
Route::get('media', [ListingController::class, 'broadcastListing'])->name('broadcasts.listing');
Route::get('tags', [ListingController::class, 'tagListing'])->name('tags.listing');
Route::get('services', [ListingController::class, 'serviceListing'])->name('services.listing');
Route::get('services/{slug}', [DetailController::class, 'serviceDetail'])->name('services.detail');

Route::get('blogs/{slug}', [DetailController::class, 'blogDetail'])->name('blogs.detail');
Route::get('courses/{slug}', [DetailController::class, 'archiveDetail'])->name('archives.detail');
Route::get('podcasts/{slug}', [DetailController::class, 'podcastDetail'])->name('podcasts.detail');
Route::get('media/{slug}', [DetailController::class, 'broadcastDetail'])->name('broadcasts.detail');
Route::get('events/{slug}', [DetailController::class, 'eventDetail'])->name('events.detail');
Route::get('tags/{slug}', [DetailController::class, 'tagDetail'])->name('tags.detail');

Route::get('/appointment_log', [AppointmentController::class, 'showAppointmentLogPage'])->name('appointment_log');
Route::get('/appointment_log/detail/{id}', [BookAppointmentController::class, 'showAppointmentLogDetailPage'])->name('student.appointment_log.detail');
Route::post('/api_get_filter_appointment_logs', [BookAppointmentController::class, 'getFilteredAppointmentlogs'])->name('getApiFilterAppointmentLogs');
Route::post('/api_teacher_get_filter_appointment_logs', [TeachersBookAppointmentController::class, 'getTeacherFilteredAppointmentlogs'])->name('getApiTeacherFilterAppointmentLogs');
Route::get('/teacher_appointment_log/detail/{id}', [TeachersBookAppointmentController::class, 'showTeacherAppointmentLogDetailPage'])->name('teacher.appointment_log.detail');
Route::post('/update_appointment_status', [TeachersBookAppointmentController::class, 'updateAppointmentStatus'])->name('appointment_detail.updateStatus');
Route::post('/update_appointment_started', [TeachersBookAppointmentController::class, 'updateAppointmentStarted'])->name('appointment_detail.updateStarted');

Route::post('/api_academy_get_filter_appointment_logs', [AcademiesBookAppointmentController::class, 'getAcademiesFilteredAppointmentlogs'])->name('getApiAcademiesFilterAppointmentLogs');
Route::get('/academy_appointment_log/detail/{id}', [AcademiesBookAppointmentController::class, 'showAcademiesAppointmentLogDetailPage'])->name('academy.appointment_log.detail');
Route::post('/update_appointment_status_academy', [AcademiesBookAppointmentController::class, 'updateAppointmentStatus'])->name('academy.appointment_detail.updateStatus');
Route::post('/update_appointment_started_academy', [AcademiesBookAppointmentController::class, 'updateAppointmentStarted'])->name('academy.appointment_detail.updateStarted');
Route::get('/api_get_appointment_slots', [APIController::class, 'getAppointmentScheduleSlots'])->name('getApiAppointmentScheduleSlots');
Route::get('/api_get_academy_appointment_slots', [APIController::class, 'getAcademyAppointmentScheduleSlots'])->name('getApiAcademyAppointmentScheduleSlots');


Route::get('/service_log', [ServicesController::class, 'showServiceLogsPage'])->name('service_log');
Route::get('/service_log/detail/{id}', [BookedServicesController::class, 'showServiceLogDetailPage'])->name('student.service_log.detail');
Route::post('/api_get_filter_service_logs', [BookedServicesController::class, 'getFilteredServiceLogs'])->name('getApiFilterServiceLogs');
Route::post('/api_teacher_get_filter_service_logs', [TeachersBookedServicesController::class, 'getTeacherFilteredServiceLogs'])->name('getApiTeacherFilterServiceLogs');
Route::get('/teacher_service_log/detail/{id}', [TeachersBookedServicesController::class, 'showTeacherServiceLogDetailPage'])->name('teacher.service_log.detail');
Route::post('/update_service_status', [TeachersBookedServicesController::class, 'updateServiceStatus'])->name('service_detail.updateStatus');
Route::post('/update_service_started', [TeachersBookedServicesController::class, 'updateServiceStarted'])->name('service_detail.updateStarted');
Route::post('/api_academy_get_filter_service_logs', [AcademiesBookedServicesController::class, 'getAcademyFilteredServiceLogs'])->name('getApiAcademyFilterServiceLogs');
Route::get('/academy_service_log/detail/{id}', [AcademiesBookedServicesController::class, 'showAcademyServiceLogDetailPage'])->name('academy.service_log.detail');
Route::post('/update_service_status_academy', [AcademiesBookedServicesController::class, 'updateServiceStatus'])->name('academy.service_detail.updateStatus');
Route::post('/update_service_started_academy', [AcademiesBookedServicesController::class, 'updateServiceStarted'])->name('academy.service_detail.updateStarted');

Route::get('/api_get_chat_messages', [ChatMessagesController::class, 'getChatMessages'])->name('getApiChatMessages');
Route::post('/api_send_chat_message', [ChatMessagesController::class, 'sendChatMessage'])->name('postApiSendMessage');

Route::get('/api_generate_agora_token', [AgoraController::class, 'generateAgoraToken'])->name('getAgoraToken');
Route::post('/api_make_agora_call', [AgoraController::class, 'makeAgoraCall'])->name('postApiMakeAgoraCall');
Route::get('/wallet', [WalletController::class,'index'])->name('wallet');
Route::post('/add-to-wallet', [WalletController::class, 'AddAmountToWallet'])->name('wallet.addAmount');
Route::post('/withdraw-from-wallet', [WalletController::class, 'withdrawAmount'])->name('wallet.withdraw');

Route::get('/api_send_notification', function (Request $request) {
    $title = $request->title;
    $body = $request->body;
    $deep_link = env('APP_URL') . $request->deep_link;
    $pusher = new PusherBeamService;
    $users = (string)$request->reciever_id;
    $pusher->sendNotificationToUsers($users, $title, $body, $deep_link, $request->payload);
})->name('getApiSendPushNotification');


Route::get('/contact', function () {
    // dd('ok');
    return Inertia::render('Contact');
})->name('contact');
Route::post('contact', [ContactsController::class, 'contact'])->name('contact.store');

Route::get('/donation', function () {
    // dd('ok');
    return Inertia::render('Donation');
})->name('donation');


Route::post('add_money/stripe', [StripePaymentsController::class, 'stripeTransfer'])->name('addmoney.stripe');
Route::post('add_money/service_stripe', [StripePaymentsController::class, 'servicestripeTransfer'])->name('addmoney.service_stripe');
Route::post('add_money_wallet/stripe', [StripePaymentsController::class, 'stripeTransferWallet'])->name('wallet.addmoney.stripe');

Route::get('/add_fund_bank_account', function (Request $request) {
    // dd($request->all());
    $bank_accounts = BankAccount::active()->get();
    return Inertia::render('AddFundBankAccount', [
        'bank_accounts' => $bank_accounts,
        'fund_id' => $request->data['fund_id'],
        'amount' => $request->data['amount'],
    ]);
})->name('add_fund_bank_account');


Route::get('/faqs', [CompanyPagesController::class, 'faqs'])->name('faqs');
Route::get('/pages/about', [CompanyPagesController::class, 'about'])->name('about');
Route::get('/pages/{slug}', [CompanyPagesController::class, 'companyPage'])->name('company_pages.display');
Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);



Route::get('/forum', function () {
    // dd('ok');
    return Inertia::render('Forum');
})->name('forum');

Route::get('/shop', function () {
    // dd('ok');
    return Inertia::render('Shop');
})->name('shop');

Route::get('/appointment', function () {
    // dd('ok');
    return Inertia::render('Appointment');
})->name('appointment');

Route::get('/appointment-log', function () {
    // dd('ok');
    return Inertia::render('AppointmentLog');
})->name('appointment-log');

Route::get('/our-story', function () {
    return Inertia::render('OurStory');
})->name('our-story');

Route::get('/heal-yourself', function () {
    return Inertia::render('HealYourSelf');
})->name('heal-yourself');


Route::get('/categories', function () {
    // dd('ok');
    return Inertia::render('Categories/Listing');
})->name('categories');

Route::get('/quickby-services', function () {
    // dd('ok');
    return Inertia::render('QuickbyService');
})->name('quickby-services');



Route::get('duplicate_data', function () {
    $complete_data = Post::where('academy_id', 3)->whereNull('teacher_id')->get();
    $copy_data_ids = Academy::where('id', '!=', 3)->pluck('id')->toArray();
    // dd($complete_data);
    foreach ($copy_data_ids as $key_law => $academy_id) {
        foreach ($complete_data as $key => $data) {
            $inserted_data = [
                'academy_id' => $academy_id,
                'blog_category_id' => $data->blog_category_id,
                'name' => $data->getTranslations('name'),
                'description' => $data->getTranslations('description'),
                'is_active' => $data->is_active,
                'is_featured' => $data->is_featured,
                'image' => $data->image,
            ];
            $RESULT = Post::create(
                $inserted_data
            );
            $RESULT->slug = Str::slug($data['name'] . ' ' . $RESULT->id, '-');
            $RESULT->save();

        }
    }
    return 'updated';
});
