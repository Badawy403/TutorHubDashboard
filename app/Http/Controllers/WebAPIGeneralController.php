<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\ArchiveCategoriesResource;
use App\Http\Resources\Web\BlogCategoriesResource;
use App\Http\Resources\Web\AcademyCategoriesResource;
use App\Http\Resources\Web\AcademiesResource;
use App\Http\Resources\Web\ArchivesResource;
use App\Http\Resources\Web\BroadcastsResource;
use App\Http\Resources\Web\AcademyReviewsResource;
use App\Http\Resources\Web\TeacherCategoriesResource;
use App\Http\Resources\Web\EventsResource;
use App\Http\Resources\Web\FAQSResource;
use App\Http\Resources\Web\TeacherMainCategoriesResource;
use App\Http\Resources\Web\PostsResource;
use App\Http\Resources\Web\PodcastsResource;
use App\Http\Resources\Web\ServiceCategoriesResource;
use App\Http\Resources\Web\ServicesResource;
use App\Http\Resources\Web\TeacherReviewsResource;
use App\Http\Resources\Web\TeachersResource;
use App\Http\Resources\Web\TagsResource;
use App\Http\Resources\Web\TestimonialsResource;
use App\Models\ArchiveCategory;
use App\Models\BlogCategory;
use App\Models\Academy;
use App\Models\AcademyCategory;
use App\Models\City;
use App\Models\Country;
use App\Models\Teacher;
use App\Models\Archive;
use App\Models\Broadcast;
use App\Models\AcademyReview;
use App\Models\State;
use App\Models\TeacherCategory;
use App\Models\Event;
use App\Models\FAQ;
use App\Models\TeacherMainCategory;
use App\Models\Post;
use App\Models\Podcast;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\TeacherReview;
use App\Models\Tag;
use App\Models\Testimonial;
use Illuminate\Support\Arr;

class WebAPIGeneralController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchTeacherReviews($req = null, $user_name)
    {
        if ($req != null) {
            $reviews =  TeacherReview::withAll()->active()->whereHas('teacher', function ($q) use ($user_name) {
                $q->where('user_name', $user_name);
                $q->active();
            });
            if ($req->column && $req->column != null && $req->search != null) {
                $reviews = $reviews->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {
                $reviews = $reviews->whereLike(['comment', 'rating'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $reviews = $reviews->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $reviews = $reviews->OrderBy('id', 'desc');
            }
            $reviews = $reviews->paginate($req->perPage ?? 10);
            $reviews = TeacherReviewsResource::collection($reviews)->response()->getData(true);
            return $reviews;
        }
        $reviews = TeacherReview::withAll()->active()->whereHas('teacher', function ($q) use ($user_name) {
            $q->where('user_name', $user_name);
            $q->active();
        })->orderBy('id', 'desc')->paginate(10);
        $reviews = TeacherReviewsResource::collection($reviews)->response()->getData(true);
        return $reviews;
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchAcademyReviews($req = null, $user_name)
    {
        if ($req != null) {
            $reviews =  AcademyReview::withAll()->active()->whereHas('academy', function ($q) use ($user_name) {
                $q->where('user_name', $user_name);
                $q->active();
            });
            if ($req->column && $req->column != null && $req->search != null) {
                $reviews = $reviews->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {
                $reviews = $reviews->whereLike(['comment', 'rating'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $reviews = $reviews->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $reviews = $reviews->OrderBy('id', 'desc');
            }
            $reviews = $reviews->paginate($req->perPage ?? 10);
            $reviews = AcademyReviewsResource::collection($reviews)->response()->getData(true);
            return $reviews;
        }

        $reviews = AcademyReview::withAll()->active()->whereHas('academy', function ($q) use ($user_name) {
            $q->where('user_name', $user_name);
            $q->active();
        })->orderBy('id', 'desc')->paginate(10);
        $reviews = AcademyReviewsResource::collection($reviews)->response()->getData(true);
        return $reviews;
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchTeachers($req = null)
    {
        if ($req != null) {
            $teachers =  Teacher::withAll()->has('user')->whereNotNull('user_name')->active()->approved();
            // if($req->teacher_category){
            //     $teachers = $teachers->whereHas('teacher_categories',function($q) use($req){
            //         $q->where('teacher_categories.slug',$req->teacher_category);
            //     });
            // }
            // else if($req->teacher_main_category){
            //     $teacher_main_category = TeacherMainCategory::where('slug',$req->teacher_main_category)->first();
            //     if($teacher_main_category){
            //         $teachers = $teachers->whereHas('teacher_categories',function($q) use($req,$teacher_main_category){
            //             $q->where('teacher_categories.parent_category_id',$teacher_main_category->id);
            //         });
            //     }
            // }
            if ($req->main_category && $req->main_category != 'all' && $req->teacher_category == 'all') {
                $teachers = $teachers->whereHas('teacher_categories', function ($q) use ($req) {
                    $q->whereHas('main_category', function ($y) use ($req) {
                        $y->where('teacher_main_categories.slug', $req->main_category);
                    });
                });
            }
            if ($req->teacher_category && $req->teacher_category != 'all') {
                if (is_array($req->teacher_category)) {
                    $slugs = Arr::flatten($req->teacher_category);

                    $teachers = $teachers->whereHas('teacher_categories', function ($q) use ($req, $slugs) {
                        $q->whereIn('teacher_categories.id', $slugs);
                    });
                } else {
                    $teachers = $teachers->whereHas('teacher_categories', function ($q) use ($req) {
                        $q->where('teacher_categories.slug', $req->teacher_category);
                    });
                }
            }
            if ($req->language) {
                $teachers = $teachers->whereHas('languages', function ($q) use ($req) {
                    $q->where('all_languages.iso_code', $req->language);
                });
            }
            if ($req->is_featured) {
                $teachers = $teachers->featured();
            }
            if ($req->country) {
                $teachers = $teachers->where('country_id', $req->country);
            }
            if ($req->zip_code) {
                $teachers = $teachers->where('zip_code', $req->zip_code);
            }
            if ($req->is_top_rated) {
                $teachers = $teachers->topRated();
            }

            if ($req->column && $req->column != null && $req->search != null) {
                $teachers = $teachers->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {
                $teachers = $teachers->whereLike(['first_name', 'last_name', 'description'], $req->search);
            }
            if ($req->search && $req->search != null) {
                if ($req->column && $req->column != null) {
                    // Search in the specific column provided
                    $teachers = $teachers->whereLike($req->column, $req->search);
                } else {
                    // Search across multiple columns by default
                    $teachers = $teachers->whereLike(['first_name', 'last_name', 'description'], $req->search);
                }
            }
            // if ($req->sort_field != null && $req->sort_type != null) {
            //     $teachers = $teachers->OrderBy($req->sort_field, $req->sort_type);
            // }
            if ($req->latitude && $req->longitude) {
                $teachers = $teachers->distance($req->latitude, $req->longitude, $req->distance);
                $teachers = $teachers->OrderBy('distance', 'asc');
            } else {
                $teachers = $teachers->OrderBy('id', 'desc');
            }
            $teachers = $teachers->paginate($req->perPage ?? 10);
            $teachers = TeachersResource::collection($teachers)->response()->getData(true);
            return $teachers;
        }
        $teachers = Teacher::withAll()->orderBy('id', 'desc')->paginate(10);
        $teachers = TeachersResource::collection($teachers)->response()->getData(true);
        return $teachers;
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchAcademies($req = null)
    {
        if ($req != null) {
            $academies =  Academy::withAll()->has('user')->whereNotNull('user_name')->approved();
            if ($req->academy_category) {
                $academies = $academies->whereHas('academy_categories', function ($q) use ($req) {
                    $q->where('academy_categories.slug', $req->academy_category);
                });
            }
            if ($req->country) {
                $academies = $academies->where('country_id', $req->country);
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $academies = $academies->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {
                $academies = $academies->whereLike(['first_name', 'last_name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $academies = $academies->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $academies = $academies->OrderBy('id', 'desc');
            }
            $academies = $academies->paginate($req->perPage ?? 10);
            $academies = AcademiesResource::collection($academies)->response()->getData(true);
            return $academies;
        }
        $academies = Academy::withAll()->orderBy('id', 'desc')->paginate(10);
        $academies = AcademiesResource::collection($academies)->response()->getData(true);
        return $academies;
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchEvents($req = null)
    {
        if ($req != null) {
            $events =  Event::withAll()->active()->approved()->upcoming()->hasModulePermissions();
            if ($req->month) {
                $months = [
                    'jan' => 1, 'feb' => 2, 'mar' => 3, 'apr' => 4, 'may' => 5, 'jun' => 6, 'jul' => 7,
                    'aug' => 8, 'sep' => 9, 'oct' => 10, 'nov' => 11, 'dec' => 12
                ];
                if (isset($months[$req->month])) {
                    $events = $events->whereMonth('starts_at', $months[$req->month]);
                }
            }
            if ($req->address) {
                $events = $events->whereLike(['address_line_1','address_line_2'], $req->address);
            }
            if ($req->teacher) {
                $events = $events->whereHas('teacher', function ($q) use ($req) {
                    $q->where('user_name', $req->teacher);
                });
            }
            if ($req->teacher) {
                $events = $events->whereHas('teacher', function ($q) use ($req) {
                    $q->where('user_name', $req->teacher);
                });
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $events = $events->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {
                $events = $events->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $events = $events->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $events = $events->OrderBy('id', 'desc');
            }
            $events = $events->paginate($req->perPage ?? 10);
            $events = EventsResource::collection($events)->response()->getData(true);
            return $events;
        }
        $events = Event::withAll()->hasModulePermissions()->active()->upcoming()->orderBy('id', 'desc')->paginate(10);
        $events = EventsResource::collection($events)->response()->getData(true);
        return $events;
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchPosts($req = null)
    {

        if ($req != null) {
            $posts =  Post::withAll()->active()->hasModulePermissions();
            if ($req->tag) {
                $posts = $posts->whereHas('tags', function ($q) use ($req) {
                    $q->where('slug', $req->tag);
                });
            }
            if ($req->teacher) {
                $posts = $posts->whereHas('teacher', function ($q) use ($req) {
                    $q->where('user_name', $req->teacher);
                });
            }
            if ($req->academy) {
                $posts = $posts->whereHas('academy', function ($q) use ($req) {
                    $q->where('academy_name', $req->academy);
                });
            }

            if ($req->blog_category) {
                $posts = $posts->whereHas('blog_category', function ($q) use ($req) {
                    $q->where('slug', $req->blog_category);
                });

            }
            if ($req->column && $req->column != null && $req->search != null) {
                $posts = $posts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {
                $posts = $posts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $posts = $posts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $posts = $posts->OrderBy('id', 'desc');
            }
            $posts = $posts->paginate($req->perPage ?? 10);
            $posts = PostsResource::collection($posts)->response()->getData(true);
            return $posts;
        }
        $posts = Post::withAll()->hasModulePermissions()->orderBy('id', 'desc')->paginate(10);
        $posts = PostsResource::collection($posts)->response()->getData(true);
        return $posts;
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchArchives($req = null)
    {
        if ($req != null) {
            $archives =  Archive::withAll()->active()->hasModulePermissions();
            if ($req->tag) {
                $archives = $archives->whereHas('tags', function ($q) use ($req) {
                    $q->where('slug', $req->tag);
                });
            }
            if ($req->archive_category) {
                $archives = $archives->whereHas('archive_category', function ($q) use ($req) {
                    $q->where('slug', $req->archive_category);
                });
            }
            if ($req->teacher) {
                $archives = $archives->whereHas('teacher', function ($q) use ($req) {
                    $q->where('user_name', $req->teacher);
                });
            }
            if ($req->academy) {
                $archives = $archives->whereHas('academy', function ($q) use ($req) {
                    $q->where('academy_name', $req->academy);
                });
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $archives = $archives->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {
                $archives = $archives->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $archives = $archives->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $archives = $archives->OrderBy('id', 'desc');
            }
            $archives = $archives->paginate($req->perPage ?? 10);
            $archives = ArchivesResource::collection($archives)->response()->getData(true);
            return $archives;
        }
        $archives = Archive::withAll()->hasModulePermissions()->orderBy('id', 'desc')->paginate(10);
        $archives = ArchivesResource::collection($archives)->response()->getData(true);
        return $archives;
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchBroadcasts($req = null)
    {
        if ($req != null) {
            $broadcasts =  Broadcast::withAll()->active()->hasModulePermissions();
            if ($req->tag) {
                $broadcasts = $broadcasts->whereHas('tags', function ($q) use ($req) {
                    $q->where('slug', $req->tag);
                });
            }
            if ($req->teacher) {
                $broadcasts = $broadcasts->whereHas('teacher', function ($q) use ($req) {
                    $q->where('user_name', $req->teacher);
                });
            }
            if ($req->academy) {
                $broadcasts = $broadcasts->whereHas('academy', function ($q) use ($req) {
                    $q->where('academy_name', $req->academy);
                });
            }
            if ($req->type) {
                $broadcasts = $broadcasts->whereLike('file_type', $req->type);
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $broadcasts = $broadcasts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {
                $broadcasts = $broadcasts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $broadcasts = $broadcasts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $broadcasts = $broadcasts->OrderBy('id', 'desc');
            }
            $broadcasts = $broadcasts->paginate($req->perPage ?? 10);
            $broadcasts = BroadcastsResource::collection($broadcasts)->response()->getData(true);
            return $broadcasts;
        }
        $broadcasts = Broadcast::withAll()->hasModulePermissions()->orderBy('id', 'desc')->paginate(10);
        $broadcasts = BroadcastsResource::collection($broadcasts)->response()->getData(true);
        return $broadcasts;
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchPodcasts($req = null)
    {
        if ($req != null) {
            $podcasts =  Podcast::withAll()->active()->hasModulePermissions();
            if ($req->tag) {
                $podcasts = $podcasts->whereHas('tags', function ($q) use ($req) {
                    $q->where('slug', $req->tag);
                });
            }
            if ($req->teacher) {
                $podcasts = $podcasts->whereHas('teacher', function ($q) use ($req) {
                    $q->where('user_name', $req->teacher);
                });
            }
            if ($req->academy) {
                $podcasts = $podcasts->whereHas('academy', function ($q) use ($req) {
                    $q->where('academy_name', $req->academy);
                });
            }
            if ($req->type) {
                $podcasts = $podcasts->whereLike('file_type', $req->type);
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $podcasts = $podcasts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {
                $podcasts = $podcasts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $podcasts = $podcasts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $podcasts = $podcasts->OrderBy('id', 'desc');
            }
            $podcasts = $podcasts->paginate($req->perPage ?? 10);
            $podcasts = PodcastsResource::collection($podcasts)->response()->getData(true);
            return $podcasts;
        }
        $podcasts = Podcast::withAll()->hasModulePermissions()->orderBy('id', 'desc')->paginate(10);
        $podcasts = PodcastsResource::collection($podcasts)->response()->getData(true);
        return $podcasts;
    }

    public static function searchServices($req = null)
    {
        if ($req != null) {
            $services =  Service::approved()->withAll()->withChildrens()->active()->hasModulePermissions();
            if($req->tag){
                 $services = $services->whereHas('tags',function($q) use($req){
                     $q->where('slug',$req->tag);
                 });
             }
             if($req->service_category){
               $services = $services->whereHas('service_category',function($q) use($req){
                   $q->where('slug',$req->service_category);
               });
           }
            if ($req->column && $req->column != null && $req->search != null) {
                $services = $services->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {
                $services = $services->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $services = $services->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $services = $services->OrderBy('id', 'desc');
            }
            $services = $services->paginate($req->perPage ?? 10);
            $services = ServicesResource::collection($services)->response()->getData(true);
            return $services;
        }
        $services = Service::withAll()->approved()->hasModulePermissions()->orderBy('id', 'desc')->paginate(10);
        $services = ServicesResource::collection($services)->response()->getData(true);
        return $services;
    }


    public static function getCountries($request)
    {
        $countries = Country::active()->get();
        return $countries;
    }
    public static function getStates($request)
    {
        $states = State::active()->where('country_id', $request->country_id)->get();
        return $states;
    }

    public static function getTestimonials($request)
    {
        $testimonials = Testimonial::active()->get();
        $testimonials = TestimonialsResource::collection($testimonials);
        return $testimonials;
    }
    public static function getArchives($request)
    {
        $archives = Archive::active()->take(3)->get();
        $archives = ArchivesResource::collection($archives);
        return $archives;
    }

    public static function getAcademyCategories($request)
    {
        $academy_categories = AcademyCategory::active()->get();
        $academy_categories = AcademyCategoriesResource::collection($academy_categories);
        return $academy_categories;
    }

    public static function getTags($request)
    {
        $tags = Tag::active()->get();
        $tags = TagsResource::collection($tags);
        return $tags;
    }

    public static function getBlogCategories($request)
    {
        $blog_categories = BlogCategory::active()->get();
        $blog_categories = BlogCategoriesResource::collection($blog_categories);
        return $blog_categories;
    }

    public static function getFaqs($request)
    {
        $faqs = FAQ::active()->get();
        $faqs = FAQSResource::collection($faqs);
        return $faqs;
    }

    public static function getArchiveCategories($request)
    {
        $archive_categories = ArchiveCategory::active()->get();
        $archive_categories = ArchiveCategoriesResource::collection($archive_categories);
        return $archive_categories;
    }

    public static function getTeacherCategories($request)
    {
        $teacher_categories = TeacherCategory::withAll()->active()->get();
        $teacher_categories = TeacherCategoriesResource::collection($teacher_categories);
        return $teacher_categories;
    }
    public static function getFeaturedTeacherCategories($request)
    {
        // $featured_teacher_categories = TeacherMainCategory::active()->featured()->whereHas('categories',function($q){
        //     $q->active();
        // })->withAll()->withChildrens()->get();

        $featured_teacher_categories = TeacherMainCategory::withAll()->active()->featured()->get();
        $featured_teacher_categories = TeacherMainCategoriesResource::collection($featured_teacher_categories);
        return $featured_teacher_categories;
    }

    public static function getCities($request)
    {
        $cities = City::active()->where('country_id', $request->country_id)->where('state_id', $request->state_id)->get();
        return $cities;
    }
    public static function getFeaturedTeachers($request)
    {
        // dd($request->all());
        $featured_teachers = Teacher::withAll()->has('user')->whereNotNull('user_name')->active()->approved()->featured();


        if ($request->category) {
            $featured_teachers = $featured_teachers->whereHas('teacher_categories', function ($q) use ($request) {
                $q->whereHas('main_category',function($query) use ($request){
                    $query->where('slug',$request->category);
                });
            });
        }

        if ($request->latitude && $request->longitude) {
            $featured_teachers = $featured_teachers->distance($request->latitude, $request->longitude);
            $featured_teachers = $featured_teachers->OrderBy('distance', 'asc');
        }
        $featured_teachers = $featured_teachers->get();

        $featured_teachers = TeachersResource::collection($featured_teachers);
        return $featured_teachers;
    }

    public static function getTopRatedTeachers($request)
    {
        $top_rated_teachers = Teacher::withAll($request)->has('user')->whereNotNull('user_name')->active()->approved()->topRated()->get();
        $top_rated_teachers = TeachersResource::collection($top_rated_teachers);
        return $top_rated_teachers;
    }

    public static function getPremiumTeachers($request)
    {
        $premium_teachers = Teacher::withAll()->has('user')->whereNotNull('user_name')->active()->approved()->premium();
        $premium_teachers = $premium_teachers->get();
        $premium_teachers = TeachersResource::collection($premium_teachers);
        return $premium_teachers;
    }
    public static function getFeaturedTags($request)
    {
        $featured_tags = Tag::withAll()->active()->get();
        $featured_tags = TagsResource::collection($featured_tags);
        return $featured_tags;
    }

    public static function getFeaturedEvents($request)
    {
        $featured_events = Event::withAll()->active()->upcoming()->featured()->get();
        $featured_events = EventsResource::collection($featured_events);
        return $featured_events;
    }

    public static function getSpotlightTeachers($request)
    {
        $spotlight_teachers = Teacher::withAll()->has('user')->whereNotNull('user_name')->active()->approved()->featured()->get();
        $spotlight_teachers = TeachersResource::collection($spotlight_teachers);
        return $spotlight_teachers;
    }

    public static function getFeaturedAcademies($request)
    {
        $featured_academies = Academy::withAll()->has('user')->whereNotNull('user_name')->active()->approved()->featured()->get();
        $featured_academies->each(function ($academy) {
            $academy->setRelation(
                'academy_teachers',
                $academy->academy_teachers->take(4)
            );
        });
        $featured_academies = AcademiesResource::collection($featured_academies);
        return $featured_academies;
    }

    public static function getServiceCategories($request){
        $service_categories = ServiceCategory::active();
        if($request->has_services){
        $service_categories = $service_categories->whereHas('services',function($q){
            $q->active();
        });
        }
        $service_categories = $service_categories->get();
        $service_categories = ServiceCategoriesResource::collection($service_categories);
        return $service_categories;
    }
}
