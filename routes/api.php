<?php

use App\Http\Controllers\API\AgoraController;
use App\Http\Controllers\API\Auth\APIAuthController;
use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\APIDetailController;
use App\Http\Controllers\API\Auth\APIAccountController;
use App\Http\Controllers\API\Auth\APIBroadcastAuthController;
use App\Http\Controllers\API\Students\APIReviewsController;
use App\Http\Controllers\API\APIAppointmentsController;
use App\Http\Controllers\API\Students\StudentChatMessagesController;
//Teachers
use App\Http\Controllers\API\Teachers\APITeacherAppointmentScheduleController;
use App\Http\Controllers\API\Teachers\APITeacherProfileController;
use App\Http\Controllers\API\Teachers\TeacherCertificationsController;
use App\Http\Controllers\API\Teachers\TeacherBroadcastsController;
use App\Http\Controllers\API\Teachers\TeacherPodcastsController;
use App\Http\Controllers\API\Teachers\TeacherEventsController;
use App\Http\Controllers\API\Teachers\TeacherPostsController;
use App\Http\Controllers\API\Teachers\TeacherArchivesController;
use App\Http\Controllers\API\Teachers\TeacherExperiencesController;
use App\Http\Controllers\API\Teachers\TeacherEducationsController;
use App\Http\Controllers\API\Teachers\TeacherChatMessagesController;
//Teachers
//Academies
use App\Http\Controllers\API\Academy\APIAcademyAppointmentScheduleController;
use App\Http\Controllers\API\Academy\APIAcademyProfileController;
use App\Http\Controllers\API\NotificationSettingsController;
use App\Http\Controllers\API\Students\StudentBookedServicesController;
use App\Http\Controllers\API\Students\StudentServiceChatMessagesController;
use App\Http\Controllers\API\Teachers\TeacherBookedServicesController;
use App\Http\Controllers\API\Teachers\TeacherServiceChatMessagesController;
use App\Http\Controllers\API\Teachers\TeacherServicesController;
use App\Http\Controllers\API\WalletController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ContactsController;
//Academies
use App\PusherBeam\PusherBeamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::prefix('auth')->name('auth.')->group(function () {
//     Route::post('/login', [APIAuthController::class, 'submitLoginForm'])->name('submit.login');
//     Route::post('/social_login', [APIAuthController::class, 'socialLogin'])->name('submit.social_login');
//     Route::post('/register', [APIAuthController::class, 'submitRegisterForm'])->name('submit.register');
//     Route::post('/forgot_password', [APIAuthController::class, 'submitForgotPasswordForm'])->name('password.forgot');
//     Route::post('/reset_password', [APIAuthController::class, 'submitResetPasswordForm'])->name('password.reset');
//     Route::get('/logout', [APIAuthController::class, 'logout'])->name('logout');
//     Route::get('/user', [APIAuthController::class, 'getLoggedInUser'])->name('user');
//     Route::get('/delete_account', [APIAuthController::class, 'deleteAccount'])->name('account.delete');

// });

Route::prefix('auth')->name('auth.')->group(function(){
    Route::post('/login', [APIAuthController::class, 'submitLoginForm'])->name('submit.login');
    Route::post('/social_login', [APIAuthController::class, 'socialLogin'])->name('submit.social_login');
    Route::post('/register', [APIAuthController::class, 'submitRegisterForm'])->name('submit.register');
    Route::post('/forgot_password', [APIAuthController::class, 'submitForgotPasswordForm'])->name('password.forgot');
    Route::post('/reset_password', [APIAuthController::class, 'submitResetPasswordForm'])->name('password.reset');
    Route::get('/logout', [APIAuthController::class, 'logout'])->name('logout');
    Route::get('/user', [APIAuthController::class, 'getLoggedInUser'])->name('user');
    Route::get('/delete_account', [APIAuthController::class, 'deleteAccount'])->name('account.delete');
});


Route::get('in_app_notifications', [NotificationSettingsController::class, 'getInAppNotification']);
Route::post('is_seen_notification_status/{id}', [NotificationSettingsController::class, 'updateIsSeenNotificationStatus']);

Route::prefix('teachers')->name('teachers.')->group(function () {
    Route::post('update_general_info', [APIAccountController::class, 'updateTeacherGeneralInformation'])->name('update_general_info');
    Route::post('update_settings', [APIAccountController::class, 'updateTeacherSettings'])->name('update_settings');
    Route::post('become_teacher', [APIAccountController::class, 'becomeTeacher'])->name('teachers.become_teacher');
    //Teacher Appointments Apis
    Route::post('save_appointment_schedules', [APITeacherAppointmentScheduleController::class, 'saveAppointmentSchedule'])->name('save_appointment_schedules');
    Route::post('add_new_appointment_schedules', [APITeacherAppointmentScheduleController::class, 'addNewAppointmentSchedule'])->name('add_new_appointment_schedules');
    Route::post('delete_appointment_slots', [APITeacherAppointmentScheduleController::class, 'deleteAppointmentScheduleSlots'])->name('delete_appointment_slots');
    Route::get('/api_appointment_schedules', [APITeacherAppointmentScheduleController::class, 'getAppointmentSchedules'])->name('getApiAppointmentSchedules');
    Route::get('/get_filter_appointment_logs', [APITeacherAppointmentScheduleController::class, 'getFilteredAppointmentlogs'])->name('getApiFilsterAppointmentLogs');
    Route::get('/get_filter_appointment_log_detail/{book_appointment}', [APITeacherAppointmentScheduleController::class, 'showAppointmentLogDetail'])->name('showAppointmentLogDetail');
    Route::get('profile/{user_name}/book_appointment', [APITeacherProfileController::class, 'bookAppointment'])->name('book_appointment');
    Route::get('profile/{user_name}/appointment_types', [APITeacherProfileController::class, 'getLwyerAppointmentTypes'])->name('book_appointment');
    Route::get('/get_appointment_commission', [APITeacherAppointmentScheduleController::class, 'getAppointmentCommission'])->name('getApiAppointmentCommission');

    Route::post('update_appointment_status/{book_appointment}', [APITeacherAppointmentScheduleController::class, 'updateAppointmentStatus'])->name('update_appointment_status');
    //Teacher Call Apis
    Route::get('/api_generate_agora_token', [AgoraController::class, 'generateAgoraToken'])->name('getAgoraToken');
    Route::post('/api_make_agora_call', [AgoraController::class, 'makeAgoraCall'])->name('postApiMakeAgoraCall');
    //Teacher Call Apis
    //Teacher Chat Apis
    Route::get('/api_get_chat_messages/{appointment}', [TeacherChatMessagesController::class, 'getChatMessages'])->name('getApiChatMessages');
    Route::post('/api_send_chat_message', [TeacherChatMessagesController::class, 'sendChatMessage'])->name('postApiSendMessage');

    //Teacher Chat Apis
    //Teacher Appointments Apis

    Route::get('/get_filter_booked_services', [TeacherBookedServicesController::class, 'getFilteredBookedServices'])->name('getApiFilterBookedServices');
    Route::get('/get_filter_booked_service_detail/{booked_service}', [TeacherBookedServicesController::class, 'showBookedServiceDetail'])->name('showBookedServiceDetail');
    Route::post('update_booked_service_status/{booked_service}', [TeacherBookedServicesController::class, 'updateBookedServiceStatus'])->name('update_service_status');
    Route::get('/api_get_service_chat_messages/{booked_service}', [TeacherServiceChatMessagesController::class, 'getChatMessages'])->name('getApiServiceChatMessages');
    Route::post('/api_service_send_chat_message', [TeacherServiceChatMessagesController::class, 'sendChatMessage'])->name('postApiSendServiceMessage');


    //Teacher CRUDS
    Route::apiCrudRoutes('teacher_certifications', TeacherCertificationsController::class);
    Route::apiCrudRoutes('teacher_broadcasts', TeacherBroadcastsController::class);
    Route::apiCrudRoutes('teacher_podcasts', TeacherPodcastsController::class);
    Route::apiCrudRoutes('teacher_events', TeacherEventsController::class);
    Route::apiCrudRoutes('teacher_posts', TeacherPostsController::class);
    Route::apiCrudRoutes('teacher_archives', TeacherArchivesController::class);
    Route::apiCrudRoutes('teacher_experiences', TeacherExperiencesController::class);
    Route::apiCrudRoutes('teacher_educations', TeacherEducationsController::class);
    Route::apiCrudRoutes('teacher_services', TeacherServicesController::class);
    //Teacher CRUDS

    Route::post('/api_send_notification', function (Request $request) {
        $request->validate(
            [
                'title' => 'required|string',
                'body' => 'required|string',
                'deep_link' => 'required|string',
                'reciever_id' => 'required|exists:students,id',
                'payload' => 'required',
                'payload.appointment' => "required",
                'payload.channel_name' => "required",
                'payload.token' => "required"
            ]
        );
        try {
            $title = $request->title;
            $body = $request->body;
            $deep_link = env('APP_URL') . $request->deep_link;
            $pusher = new PusherBeamService;
            $users = (string)$request->reciever_id;
            $pusher->sendNotificationToUsers($users, $title, $body, $deep_link, $request->payload);
            $response = generateResponse(null, true, "Notification Sent Successfully", null, 'collection');
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = generateResponse(null, false, $e->getMessage(), null, 'collection');
            return response()->json($response, 200);
        }
    })->name('getApiSendPushNotification');
});
Route::prefix('academies')->name('academies.')->group(function () {
    Route::post('update_general_info', [APIAccountController::class, 'updateAcademyGeneralInformation'])->name('update_general_info');
    Route::post('update_settings', [APIAccountController::class, 'updateAcademySettings'])->name('update_settings');
    Route::post('become_academy', [APIAccountController::class, 'becomeAcademy'])->name('academies.become_academy');
    //Teacher Appointments Apis
    Route::post('save_appointment_schedules', [APIAcademyAppointmentScheduleController::class, 'saveAppointmentSchedule'])->name('save_appointment_schedules');
    Route::post('add_new_appointment_schedules', [APIAcademyAppointmentScheduleController::class, 'addNewAppointmentSchedule'])->name('add_new_appointment_schedules');
    Route::post('delete_appointment_slots', [APIAcademyAppointmentScheduleController::class, 'deleteAppointmentScheduleSlots'])->name('delete_appointment_slots');
    Route::get('/api_appointment_schedules', [APIAcademyAppointmentScheduleController::class, 'getAppointmentSchedules'])->name('getApiAppointmentSchedules');
    Route::get('profile/{user_name}/book_appointment', [APIAcademyProfileController::class, 'bookAppointment'])->name('book_appointment');
    Route::get('/get_appointment_commission', [APIAcademyAppointmentScheduleController::class, 'getAppointmentCommission'])->name('getApiAppointmentCommission');

    //Teacher Appointments Apis
});
Route::prefix('students')->name('students.')->group(function () {
    Route::post('update_general_info', [APIAccountController::class, 'updateStudentGeneralInformation'])->name('update_general_info');
    Route::post('become_student', [APIAccountController::class, 'becomeUser'])->name('become_user');
    Route::post('add_teacher_review', [APIReviewsController::class, 'addTeacherReview'])->name('add_teacher_review');
    Route::post('add_academy_review', [APIReviewsController::class, 'addAcademyReview'])->name('add_academy_review');
    Route::post('book_appointment', [APIAppointmentsController::class, 'bookAppointment'])->name('book_appointment');
    Route::get('/get_filter_appointment_logs', [APIAppointmentsController::class, 'getFilteredAppointmentlogs'])->name('getApiFilsterAppointmentLogs');
    Route::get('/get_filter_appointment_log_detail/{book_appointment}', [APIAppointmentsController::class, 'showAppointmentLogDetail'])->name('showAppointmentLogDetail');
    //Student Call Apis
    // Route::get('/api_generate_agora_token', [AgoraController::class, 'generateAgoraToken'])->name('getAgoraToken');
    // Route::post('/api_make_agora_call', [AgoraController::class, 'makeAgoraCall'])->name('postApiMakeAgoraCall');
    //Student Call Apis
    //Student Chat Apis
    Route::get('//api_get_chat_messages/{appointment}', [StudentChatMessagesController::class, 'getChatMessages'])->name('getApiChatMessages');
    Route::post('/api_send_chat_message', [StudentChatMessagesController::class, 'sendChatMessage'])->name('postApiSendMessage');

    Route::post('book_service', [StudentBookedServicesController::class, 'bookService'])->name('book_appointment');
    Route::get('/get_filter_service_logs', [StudentBookedServicesController::class, 'getFilteredServiceLogs'])->name('getApiFilterServiceLogs');
    Route::get('/get_filter_service_log_detail/{booked_service}', [StudentBookedServicesController::class, 'showServiceLogDetail'])->name('showAppointmentLogDetail');
    Route::get('/api_get_service_chat_messages/{booked_service}', [StudentServiceChatMessagesController::class, 'getChatMessages'])->name('getApiServiceChatMessages');
    Route::post('/api_send_service_chat_message', [StudentServiceChatMessagesController::class, 'sendChatMessage'])->name('postApiSendServiceMessage');
    //Student Chat Apis

});
Route::post('/broadcasting/auth', [APIBroadcastAuthController::class, 'auth']);



Route::middleware(['api', 'api_setting'])->group(function () {


    Route::get('settings', [APIController::class, 'getAllSettings'])->name('getAllSettings');
    Route::get('gateways', [APIController::class, 'getAllGateways'])->name('getAllGateways');
    Route::get('countries', [APIController::class, 'getCountries'])->name('getCountries');
    Route::get('appointment_types', [APIController::class, 'getAppointmentTypes'])->name('getAppointmentTypes');
    Route::get('teacher_categories', [APIController::class, 'getTeacherCategories'])->name('getTeacherCategories');
    Route::get('teacher_main_categories_with_childrens', [APIController::class, 'getTeacherMainCategoriesWithChildrens'])->name('getTeacherMainCategoriesWithChildrens');
    Route::get('academy_categories', [APIController::class, 'getAcademyCategories'])->name('getAcademyCategories');
    Route::get('featured_teachers', [APIController::class, 'getFeaturedTeachers'])->name('getFeaturedTeachers');
    Route::get('featured_academies', [APIController::class, 'getFeaturedAcademies'])->name('getFeaturedAcademies');
    Route::get('featured_events', [APIController::class, 'getFeaturedEvents'])->name('getFeaturedEvents');
    Route::get('featured_tags', [APIController::class, 'getFeaturedTags'])->name('getFeaturedTags');
    Route::get('top_rated_teachers', [APIController::class, 'getTopRatedTeachers'])->name('getTopRatedTeachers');
    Route::post('filter_teachers', [APIController::class, 'getTeachers'])->name('getTeachers');
    Route::post('filter_academies', [APIController::class, 'getAcademies'])->name('getAcademies');
    Route::post('filter_teacher_reviews/{user_name}', [APIController::class, 'getTeacherReviews'])->name('getTeacherReviews');
    Route::post('filter_teacher_podcasts/{user_name}', [APIController::class, 'getTeacherPodcasts'])->name('getTeacherPodcasts');
    Route::post('filter_teacher_broadcasts/{user_name}', [APIController::class, 'getTeacherBroadcasts'])->name('getTeacherBroadcasts');
    Route::post('filter_academy_reviews/{user_name}', [APIController::class, 'getAcademyReviews'])->name('getAcademyReviews');
    Route::get('testimonials', [APIController::class, 'getTestimonials'])->name('getTestimonials');
    Route::post('filter_events', [APIController::class, 'getEvents'])->name('getEvents');
    Route::get('blog_categories', [APIController::class, 'getBlogCategories'])->name('getBlogCategories');
    Route::get('tags', [APIController::class, 'getTags'])->name('getTags');
    Route::get('archive_categories', [APIController::class, 'getArchiveCategories'])->name('getArchiveCategories');
    Route::post('filter_posts', [APIController::class, 'getPosts'])->name('getPosts');
    Route::post('filter_archives', [APIController::class, 'getArchives'])->name('getArchives');
    Route::post('filter_broadcasts', [APIController::class, 'getBroadcasts'])->name('getBroadcasts');
    Route::post('filter_podcasts', [APIController::class, 'getPodcasts'])->name('getPodcasts');
    Route::get('company_page/{slug}', [APIController::class, 'getCompanyPage'])->name('getCompanyPage');
    Route::get('teachers/{user_name}', [APIDetailController::class, 'teacherDetail'])->name('teachers.detail');
    Route::get('academies/{user_name}', [APIDetailController::class, 'lawFIrmDetail'])->name('law_fIrms.detail');
    Route::get('blogs/{slug}', [APIDetailController::class, 'blogDetail'])->name('blogs.detail');
    Route::get('archives/{slug}', [APIDetailController::class, 'archiveDetail'])->name('archives.detail');
    Route::get('podcasts/{slug}', [APIDetailController::class, 'podcastDetail'])->name('podcasts.detail');
    Route::get('broadcasts/{slug}', [APIDetailController::class, 'broadcastDetail'])->name('broadcasts.detail');
    Route::get('events/{slug}', [APIDetailController::class, 'eventDetail'])->name('events.detail');
    Route::get('tags/{slug}', [APIDetailController::class, 'tagDetail'])->name('tags.detail');
    Route::post('contact', [ContactsController::class, 'contact_api'])->name('contact_api.store');
    Route::get('get_current_balance', [WalletController::class, 'getCurrentBalance'])->name('get_current_balance');
    Route::get('get_wallet_transactions', [WalletController::class, 'getWalletTransactions'])->name('get_wallet_transactions');
    Route::get('get_wallet_withdrawls', [WalletController::class, 'getWalletWithdrawls'])->name('get_wallet_withdrawls');
    Route::post('withdraw_amount', [WalletController::class, 'withdrawAmount'])->name('withdraw_amount');
    Route::post('add-to-wallet', [WalletController::class, 'AddAmountToWallet'])->name('wallet.addAmount');
    Route::get('service_categories', [APIController::class, 'getServiceCategories'])->name('getServiceCategories');
    Route::post('filter_services', [APIController::class, 'getServices'])->name('getServices');
    Route::get('services/{slug}', [APIDetailController::class, 'serviceDetail'])->name('services.detail');
});


Route::middleware(['api' , 'api_setting'])->group(function () {


Route::get('settings', [APIController::class, 'getAllSettings'])->name('getAllSettings');
Route::get('gateways', [APIController::class, 'getAllGateways'])->name('getAllGateways');

Route::get('countries', [APIController::class, 'getCountries'])->name('getCountries');
Route::get('appointment_types', [APIController::class, 'getAppointmentTypes'])->name('getAppointmentTypes');
Route::get('teacher_categories', [APIController::class, 'getTeacherCategories'])->name('getTeacherCategories');
Route::get('teacher_main_categories_with_childrens', [APIController::class, 'getTeacherMainCategoriesWithChildrens'])->name('getTeacherMainCategoriesWithChildrens');
Route::get('academy_categories', [APIController::class, 'getAcademyCategories'])->name('getAcademyCategories');
Route::get('featured_teachers', [APIController::class, 'getFeaturedTeachers'])->name('getFeaturedTeachers');
Route::get('featured_academies', [APIController::class, 'getFeaturedAcademies'])->name('getFeaturedAcademies');
Route::get('featured_events', [APIController::class, 'getFeaturedEvents'])->name('getFeaturedEvents');
Route::get('featured_tags', [APIController::class, 'getFeaturedTags'])->name('getFeaturedTags');
Route::get('top_rated_teachers', [APIController::class, 'getTopRatedTeachers'])->name('getTopRatedTeachers');

Route::post('filter_teachers', [APIController::class, 'getTeachers'])->name('getTeachers');
Route::post('filter_academies', [APIController::class, 'getAcademies'])->name('getAcademies');
Route::post('filter_teacher_reviews/{user_name}', [APIController::class, 'getTeacherReviews'])->name('getTeacherReviews');
Route::post('filter_teacher_podcasts/{user_name}', [APIController::class, 'getTeacherPodcasts'])->name('getTeacherPodcasts');
Route::post('filter_teacher_broadcasts/{user_name}', [APIController::class, 'getTeacherBroadcasts'])->name('getTeacherBroadcasts');
Route::post('filter_academy_reviews/{user_name}', [APIController::class, 'getAcademyReviews'])->name('getAcademyReviews');

Route::get('testimonials', [APIController::class, 'getTestimonials'])->name('getTestimonials');

Route::post('filter_events', [APIController::class, 'getEvents'])->name('getEvents');
Route::get('blog_categories', [APIController::class, 'getBlogCategories'])->name('getBlogCategories');
Route::get('tags', [APIController::class, 'getTags'])->name('getTags');
Route::get('archive_categories', [APIController::class, 'getArchiveCategories'])->name('getArchiveCategories');
Route::post('filter_posts', [APIController::class, 'getPosts'])->name('getPosts');
Route::post('filter_archives', [APIController::class, 'getArchives'])->name('getArchives');
Route::post('filter_broadcasts', [APIController::class, 'getBroadcasts'])->name('getBroadcasts');
Route::post('filter_podcasts', [APIController::class, 'getPodcasts'])->name('getPodcasts');


Route::get('company_page/{slug}', [APIController::class, 'getCompanyPage'])->name('getCompanyPage');
Route::get('get_all_languages', [APIController::class, 'getAllLanguages'])->name('getAllLanguages');

Route::get('teachers/{user_name}', [APIDetailController::class, 'teacherDetail'])->name('teachers.detail');
Route::get('academies/{user_name}', [APIDetailController::class, 'lawFIrmDetail'])->name('law_fIrms.detail');

Route::get('blogs/{slug}', [APIDetailController::class, 'blogDetail'])->name('blogs.detail');
Route::get('archives/{slug}', [APIDetailController::class, 'archiveDetail'])->name('archives.detail');
Route::get('podcasts/{slug}', [APIDetailController::class, 'podcastDetail'])->name('podcasts.detail');
Route::get('broadcasts/{slug}', [APIDetailController::class, 'broadcastDetail'])->name('broadcasts.detail');
Route::get('events/{slug}', [APIDetailController::class, 'eventDetail'])->name('events.detail');
Route::get('tags/{slug}', [APIDetailController::class, 'tagDetail'])->name('tags.detail');
Route::post('contact', [ContactsController::class, 'contact_api'])->name('contact_api.store');

Route::get('get_current_balance', [WalletController::class, 'getCurrentBalance'])->name('get_current_balance');
Route::get('get_wallet_transactions', [WalletController::class, 'getWalletTransactions'])->name('get_wallet_transactions');
Route::get('get_wallet_withdrawls', [WalletController::class, 'getWalletWithdrawls'])->name('get_wallet_withdrawls');
Route::post('withdraw_amount', [WalletController::class, 'withdrawAmount'])->name('withdraw_amount');
Route::post('add-to-wallet', [WalletController::class, 'AddAmountToWallet'])->name('wallet.addAmount');



});
Route::get('pusher/beams-auth', [PusherBeamService::class, 'generateToken']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
