<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\AppointmentSchedulesResource;
use App\Models\AppointmentSchedule;
use App\Models\BookAppointment;
use App\Models\Currency;
use App\Models\Gateway;
use App\Models\Language;
use Carbon\Carbon;

class APIController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function getAllSettings()
    {
        $settings = generalSettings();
        $default_currency = Currency::where('is_default', 1)->first();
        $settings['default_currency'] = $default_currency;
        $response = generateResponse($settings, true, "Settings Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getCountries(Request $request)
    {
        $countries = APIGeneralController::getCountries($request);
        $response = generateResponse($countries, true, "Countries Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getStates(Request $request)
    {
        $request->validate(['country_id' => 'exists:countries,id']);
        $states = APIGeneralController::getStates($request);
        $response = generateResponse($states, true, "States Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getEvents(Request $request)
    {
        $events = APIGeneralController::searchEvents($request);
        $response = generateResponse($events, true, "Events Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getTestimonials(Request $request)
    {
        $testimonials = APIGeneralController::getTestimonials($request);
        $response = generateResponse($testimonials, true, "Testimonials Fetched Successfully", null, 'collection');
        return response()->json($response);
    }


    public function getPosts(Request $request)
    {
        $posts = APIGeneralController::searchPosts($request);
        $response = generateResponse($posts, true, "Posts Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getArchives(Request $request)
    {
        $archives = APIGeneralController::searchArchives($request);
        $response = generateResponse($archives, true, "Archives Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getBroadcasts(Request $request)
    {
        $broadcasts = APIGeneralController::searchBroadcasts($request);
        $response = generateResponse($broadcasts, true, "Broadcasts Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getPodcasts(Request $request)
    {
        $podcasts = APIGeneralController::searchPodcasts($request);
        $response = generateResponse($podcasts, true, "Podcasts Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getTeachers(Request $request)
    {
        // $request->validate(['country_id' => 'exists:countries,id']);
        $teachers = APIGeneralController::searchTeachers($request);
        $response = generateResponse($teachers, true, "Teachers Fetched Successfully", null, 'collection');
        return response()->json($response);
    }


    public function getTeacherReviews(Request $request, $user_name)
    {
        $teacher_reviews = APIGeneralController::searchTeacherReviews($request, $user_name);
        $response = generateResponse($teacher_reviews, true, "Teacher Reviews Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getTeacherPodcasts(Request $request, $user_name)
    {
        $teacher_podcasts = APIGeneralController::searchTeacherPodcasts($request, $user_name);
        $response = generateResponse($teacher_podcasts, true, "Teacher Podcasts Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getTeacherBroadcasts(Request $request, $user_name)
    {
        $teacher_broadcasts = APIGeneralController::searchTeacherBroadcasts($request, $user_name);
        $response = generateResponse($teacher_broadcasts, true, "Teacher Broadcasts Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getAcademyReviews(Request $request, $user_name)
    {
        $academy_reviews = APIGeneralController::searchAcademyReviews($request, $user_name);
        $response = generateResponse($academy_reviews, true, "Academy Reviews Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getAcademies(Request $request)
    {
        // $request->validate(['country_id' => 'exists:countries,id']);
        $academies = APIGeneralController::searchAcademies($request);
        $response = generateResponse($academies, true, "Academies Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getAcademyCategories(Request $request)
    {
        $academy_categories = APIGeneralController::getAcademyCategories($request);
        $response = generateResponse($academy_categories, true, "Academy Categories Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getBlogCategories(Request $request)
    {
        $blog_categories = APIGeneralController::getBlogCategories($request);
        $response = generateResponse($blog_categories, true, "Blog Categories Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getTags(Request $request)
    {
        $tags = APIGeneralController::getTags($request);
        $response = generateResponse($tags, true, "Tags Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getArchiveCategories(Request $request)
    {
        $archive_categories = APIGeneralController::getArchiveCategories($request);
        $response = generateResponse($archive_categories, true, "Blog Categories Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getTeacherCategories(Request $request)
    {
        $teacher_categories = APIGeneralController::getTeacherCategories($request);
        $response = generateResponse($teacher_categories, true, "Teacher All Categories Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getTeacherMainCategoriesWithChildrens(Request $request)
    {
        $teacher_main_categories = APIGeneralController::getTeacherMainCategoriesWithChildrens($request);
        $response = generateResponse($teacher_main_categories, true, "Teacher Main Categories with Childrens Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getCities(Request $request)
    {
        $request->validate(['state_id' => 'exists:states,id']);
        $cities = APIGeneralController::getCities($request);
        $response = generateResponse($cities, true, "Cities Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getFeaturedTags(Request $request)
    {
        $featured_tags = APIGeneralController::getFeaturedTags($request);
        $response = generateResponse($featured_tags, true, "Featured Tags Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getFeaturedTeachers(Request $request)
    {
        $featured_teachers = APIGeneralController::getFeaturedTeachers($request);
        $response = generateResponse($featured_teachers, true, "Featured Teachers Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getTopRatedTeachers(Request $request)
    {
        $featured_teachers = APIGeneralController::getTopRatedTeachers($request);
        $response = generateResponse($featured_teachers, true, "Top Teachers Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getFeaturedEvents(Request $request)
    {
        $featured_events = APIGeneralController::getFeaturedEvents($request);
        $response = generateResponse($featured_events, true, "Featured Events Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getSpotlightTeachers(Request $request)
    {
        $spotlight_teachers = APIGeneralController::getSpotlightTeachers($request);
        $response = generateResponse($spotlight_teachers, true, "Spotlight Teachers Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getFeaturedAcademies(Request $request)
    {
        $featured_academies = APIGeneralController::getFeaturedAcademies($request);
        $response = generateResponse($featured_academies, true, "Featured Academies Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getCompanyPage(Request $request, $slug)
    {
        $company_page = APIGeneralController::getCompanyPage($request, $slug);
        $response = generateResponse($company_page, true, "Company Page $slug Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getAppointmentScheduleSlots(Request $request)
    {
        // $teacher_id = 2;
        $teacher_id = $request->teacher_id;
        $day = Carbon::parse($request->selected_date)->format('l');
        $day = strtolower($day);
        $date = Carbon::parse($request->selected_date);
        $schedule = AppointmentSchedule::with('schedule_slots')->where('teacher_id', $teacher_id)->where('appointment_type_id', $request->appointment_type_id)->where('day', $day)->first();
        if ($schedule) {
            $scheduleSlots = $schedule->schedule_slots;
            if (count($scheduleSlots) > 0) {
                foreach ($scheduleSlots as $scheduleSlot) {
                    $is_disabled = BookAppointment::where('teacher_id', $teacher_id)
                        ->whereDate('date', $date)
                        ->where('is_paid', 1)
                        ->where(function ($q) use ($scheduleSlot) {
                            $q->where(function ($z) use ($scheduleSlot) {
                                $z->where('start_time', $scheduleSlot->start_time);
                                $z->where('end_time', $scheduleSlot->end_time);
                            });
                        })->count();

                    $scheduleSlot['is_disabled'] = $is_disabled;
                }
            }
            $schedule = new AppointmentSchedulesResource($schedule);
        } else {
            $schedule = null;
        }
        $response = generateResponse($schedule, true, "Appointment Schedule Slots Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getAcademyAppointmentScheduleSlots(Request $request)
    {
        $academy_id = $request->academy_id;
        $day = Carbon::parse($request->selected_date)->format('l');
        $day = strtolower($day);
        $date = Carbon::parse($request->selected_date);

        $schedule = AppointmentSchedule::with('schedule_slots')->where('academy_id', $academy_id)->where('appointment_type_id', $request->appointment_type_id)->where('day', $day)->first();
        if ($schedule) {
            $scheduleSlots = $schedule->schedule_slots;
            if (count($scheduleSlots) > 0) {
                foreach ($scheduleSlots as $scheduleSlot) {
                    $is_disabled = BookAppointment::where('academy_id', $academy_id)
                        ->whereDate('date', $date)
                        ->where('is_paid', 1)
                        ->where(function ($q) use ($scheduleSlot) {
                            $q->where(function ($z) use ($scheduleSlot) {
                                $z->where('start_time', $scheduleSlot->start_time);
                                $z->where('end_time', $scheduleSlot->end_time);
                            });
                        })->count();

                    $scheduleSlot['is_disabled'] = $is_disabled;
                }
            }
            $schedule = new AppointmentSchedulesResource($schedule);
        } else {
            $schedule = null;
        }
        $response = generateResponse($schedule, true, "Appointment Schedule Slots Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getAppointmentTypes(Request $request)
    {
        $appointment_types = APIGeneralController::getAppointmentTypes($request);
        $response = generateResponse($appointment_types, true, "AppointmentTypes Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getAllGateways()
    {
        $gateways = Gateway::where('status', 1)->get();
        $response = generateResponse($gateways, true, "Gateways Fetched Successfully", null, 'collection');
        return response()->json($response);
    }


    public function getServiceCategories(Request $request)
    {
        $service_categories = APIGeneralController::getServiceCategories($request);
        $response = generateResponse($service_categories, true, "Service Categories Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getServices(Request $request)
    {
        $services = APIGeneralController::searchServices($request);
        $response = generateResponse($services, true, "Services Fetched Successfully", null, 'collection');
        return response()->json($response);
    }


    public function getAllLanguages()
    {
        $language = Language::active()->get();
        $response = generateResponse($language, true, "language Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
}
