<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Teacher;
use App\Models\State;
use App\Models\TeacherCategory;

class WebAPIController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function getCountries(Request $request){
        $countries = WebAPIGeneralController::getCountries($request);
        $response = generateResponse($countries,true,"Countries Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getStates(Request $request){
        $request->validate(['country_id' => 'exists:countries,id']);
        $states = WebAPIGeneralController::getStates($request);
        $response = generateResponse($states,true,"States Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getEvents(Request $request){
        $events = WebAPIGeneralController::searchEvents($request);
        $response = generateResponse($events,true,"Events Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getTestimonials(Request $request){
        $testimonials = WebAPIGeneralController::getTestimonials($request);
        $response = generateResponse($testimonials,true,"Testimonials Fetched Successfully",null,'collection');
        return response()->json($response);

    }


    public function getPosts(Request $request){
        $posts = WebAPIGeneralController::searchPosts($request);
        $response = generateResponse($posts,true,"Posts Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getArchives(Request $request){
        $archives = WebAPIGeneralController::searchArchives($request);
        $response = generateResponse($archives,true,"Archives Fetched Successfully",null,'collection');
        return response()->json($response);
    }
    public function getCourses(Request $request){
        $archives = WebAPIGeneralController::getArchives($request);
        $response = generateResponse($archives,true,"Archives Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getBroadcasts(Request $request){
        $broadcasts = WebAPIGeneralController::searchBroadcasts($request);
        $response = generateResponse($broadcasts,true,"Broadcasts Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getPodcasts(Request $request){
        $podcasts = WebAPIGeneralController::searchPodcasts($request);
        $response = generateResponse($podcasts,true,"Podcasts Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getTeachers(Request $request){
        // $request->validate(['country_id' => 'exists:countries,id']);
        $teachers = WebAPIGeneralController::searchTeachers($request);
        $response = generateResponse($teachers,true,"Teachers Fetched Successfully",null,'collection');
        return response()->json($response);
    }


    public function getTeacherReviews(Request $request,$user_name){
        $teacher_reviews = WebAPIGeneralController::searchTeacherReviews($request,$user_name);
        $response = generateResponse($teacher_reviews,true,"Teacher Reviews Fetched Successfully",null,'collection');
        return response()->json($response);
    }
    public function getAcademyReviews(Request $request,$user_name){
        $academy_reviews = WebAPIGeneralController::searchAcademyReviews($request,$user_name);
        $response = generateResponse($academy_reviews,true,"Academy Reviews Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getAcademies(Request $request){
        // $request->validate(['country_id' => 'exists:countries,id']);
        $academies = WebAPIGeneralController::searchAcademies($request);
        $response = generateResponse($academies,true,"Academies Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getAcademyCategories(Request $request){
        $academy_categories = WebAPIGeneralController::getAcademyCategories($request);
        $response = generateResponse($academy_categories,true,"Academy Categories Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getBlogCategories(Request $request){
        $blog_categories = WebAPIGeneralController::getBlogCategories($request);
        $response = generateResponse($blog_categories,true,"Blog Categories Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getTags(Request $request){
        $tags = WebAPIGeneralController::getTags($request);
        $response = generateResponse($tags,true,"Tags Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getArchiveCategories(Request $request){
        $archive_categories = WebAPIGeneralController::getArchiveCategories($request);
        $response = generateResponse($archive_categories,true,"Blog Categories Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getTeacherCategories(Request $request){
        $teacher_categories = WebAPIGeneralController::getTeacherCategories($request);
        $response = generateResponse($teacher_categories,true,"Teacher Categories Fetched Successfully",null,'collection');
        return response()->json($response);
    }
    public function getFeaturedTeacherCategories(Request $request){
        $featured_teacher_categories = WebAPIGeneralController::getFeaturedTeacherCategories($request);
        $response = generateResponse($featured_teacher_categories,true,"Teacher Categories Fetched Successfully",null,'collection');
        return response()->json($response);
    }


    public function getCities(Request $request){
        $request->validate(['state_id' => 'exists:states,id']);
        $cities = WebAPIGeneralController::getCities($request);
        $response = generateResponse($cities,true,"Cities Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getFeaturedTags(Request $request){
        $featured_tags = WebAPIGeneralController::getFeaturedTags($request);
        $response = generateResponse($featured_tags,true,"Featured Tags Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getFeaturedTeachers(Request $request){
        $featured_teachers = WebAPIGeneralController::getFeaturedTeachers($request);
        $response = generateResponse($featured_teachers,true,"Featured Teachers Fetched Successfully",null,'collection');
        return response()->json($response);
    }
    public function getTopRatedTeachers(Request $request){
        $top_rated_teachers = WebAPIGeneralController::getTopRatedTeachers($request);
        $response = generateResponse($top_rated_teachers,true,"Featured Teachers Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getPremiumTeachers(Request $request)
    {
        $premium_teacheres = WebAPIGeneralController::getPremiumTeachers($request);
        $response = generateResponse($premium_teacheres,true,"Premium Teachers Fetched Successfully",null,'collection');
        return response()->json($response);
    }
    public function getFeaturedEvents(Request $request){
        $featured_events = WebAPIGeneralController::getFeaturedEvents($request);
        $response = generateResponse($featured_events,true,"Featured Events Fetched Successfully",null,'collection');
        return response()->json($response);
    }
    public function getSpotlightTeachers(Request $request){
        $spotlight_teachers = WebAPIGeneralController::getSpotlightTeachers($request);
        $response = generateResponse($spotlight_teachers,true,"Spotlight Teachers Fetched Successfully",null,'collection');
        return response()->json($response);
    }
    public function getFeaturedAcademies(Request $request){
        $featured_academies = WebAPIGeneralController::getFeaturedAcademies($request);
        $response = generateResponse($featured_academies,true,"Featured Academies Fetched Successfully",null,'collection');
        return response()->json($response);
    }
    public function getFaqs(Request $request){
        $faqs = WebAPIGeneralController::getFaqs($request);
        $response = generateResponse($faqs,true,"FAQS Fetched Successfully",null,'collection');
        return response()->json($response);
    }
    public function getServiceCategories(Request $request){
        $service_categories = WebAPIGeneralController::getServiceCategories($request);
        $response = generateResponse($service_categories,true,"ServiceCategories Fetched Successfully",null,'collection');
        return response()->json($response);
    }
    public function getServices(Request $request){
        $services = WebAPIGeneralController::searchServices($request);
        $response = generateResponse($services,true,"Services Fetched Successfully",null,'collection');
        return response()->json($response);
    }
}
