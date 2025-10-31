<?php

namespace App\Http\Controllers\API;

use App\Models\AppointmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\ArchiveCategoriesResource;
use App\Http\Resources\API\BlogCategoriesResource;
use App\Http\Resources\API\AcademyCategoriesResource;
use App\Http\Resources\API\AcademiesResource;
use App\Http\Resources\API\ArchivesResource;
use App\Http\Resources\API\BroadcastsResource;
use App\Http\Resources\API\AcademyReviewsResource;
use App\Http\Resources\API\TeacherCategoriesResource;
use App\Http\Resources\API\TeacherMainCategoriesResource;
use App\Http\Resources\API\EventsResource;
use App\Http\Resources\API\PostsResource;
use App\Http\Resources\API\PodcastsResource;
use App\Http\Resources\API\TeacherReviewsResource;
use App\Http\Resources\API\CompanyPagesResource;
use App\Http\Resources\API\TeachersResource;
use App\Http\Resources\API\TagsResource;
use App\Http\Resources\API\TestimonialsResource;
use App\Http\Resources\API\AppointmentTypesResource;
use App\Http\Resources\API\ServicesResource;
use App\Http\Resources\Web\ServiceCategoriesResource;
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
use App\Models\TeacherMainCategory;
use App\Models\Event;
use App\Models\Post;
use App\Models\Podcast;
use App\Models\TeacherReview;
use App\Models\Tag;
use App\Models\Testimonial;
use App\Models\CompanyPage;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Arr;

class APIGeneralController extends Controller
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
            if ($req->all) {
                $reviews = $reviews->get();
            } else {
                $reviews = $reviews->paginate($req->perPage ?? 10);
            }
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
    public static function searchTeacherPodcasts($req = null, $user_name)
    {
        if ($req != null) {
            $podcasts =  Podcast::withAll()->active()->whereHas('teacher', function ($q) use ($user_name) {
                $q->where('user_name', $user_name);
                $q->active();
            });
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
            if ($req->all) {
                $podcasts = $podcasts->get();
            } else {
                $podcasts = $podcasts->paginate($req->perPage ?? 10);
            }
            $podcasts = PodcastsResource::collection($podcasts)->response()->getData(true);
            return $podcasts;
        }
        $podcasts = Podcast::withAll()->active()->whereHas('teacher', function ($q) use ($user_name) {
            $q->where('user_name', $user_name);
            $q->active();
        })->orderBy('id', 'desc')->paginate(10);
        $podcasts = PodcastsResource::collection($podcasts)->response()->getData(true);
        return $podcasts;
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchTeacherBroadcasts($req = null, $user_name)
    {
        if ($req != null) {
            $broadcasts =  Broadcast::withAll()->active()->whereHas('teacher', function ($q) use ($user_name) {
                $q->where('user_name', $user_name);
                $q->active();
            });
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
            if ($req->all) {
                $broadcasts = $broadcasts->get();
            } else {
                $broadcasts = $broadcasts->paginate($req->perPage ?? 10);
            }
            $broadcasts = BroadcastsResource::collection($broadcasts)->response()->getData(true);
            return $broadcasts;
        }
        $broadcasts = Broadcast::withAll()->active()->whereHas('teacher', function ($q) use ($user_name) {
            $q->where('user_name', $user_name);
            $q->active();
        })->orderBy('id', 'desc')->paginate(10);
        $broadcasts = BroadcastsResource::collection($broadcasts)->response()->getData(true);
        return $broadcasts;
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
            if ($req->all) {
                $reviews = $reviews->get();
            } else {
                $reviews = $reviews->paginate($req->perPage ?? 10);
            }
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

            if ($req->teacher_subcategory && $req->teacher_subcategory != 'all') {
                if (is_array($req->teacher_subcategory)) {
                    $slugs = Arr::flatten($req->teacher_subcategory);

                    $teachers = $teachers->whereHas('teacher_categories', function ($q) use ($req, $slugs) {
                        $q->whereIn('teacher_categories.id', $slugs);
                    });
                } else {
                    $teachers = $teachers->whereHas('teacher_categories', function ($q) use ($req) {
                        $q->where('teacher_categories.slug', $req->teacher_subcategory);
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
            $academies =  Academy::withAll()->has('user')->whereNotNull('user_name')->active()->approved();
            // dd($req->all());
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
            if ($req->all) {
                $academies = $academies->get();
            } else {
                $academies = $academies->paginate($req->perPage ?? 10);
            }
            $academies = AcademiesResource::collection($academies)->response()->getData(true);
            return $academies;
        }
        $academies = Academy::withAll()->orderBy('id', 'desc');
        if ($req->all) {
            $academies = $academies->get();
        } else {
            $academies = $academies->paginate(10);
        }
        $academies = AcademiesResource::collection($academies)->response()->getData(true);
        return $academies;
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchEvents($req = null)
    {
        if ($req != null) {
            $events =  Event::withAll()->active()->upcoming();
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
                $events = $events->whereLike('address', $req->address);
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
            if ($req->all) {
                $events = $events->get();
            } else {
                $events = $events->paginate($req->perPage ?? 10);
            }
            $events = EventsResource::collection($events)->response()->getData(true);
            return $events;
        }
        $events = Event::withAll()->active()->upcoming()->orderBy('id', 'desc')->paginate(10);
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
            if ($req->all) {
                $posts = $posts->get();
            } else {
                $posts = $posts->paginate($req->perPage ?? 10);
            }
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
            if ($req->all) {
                $archives = $archives->get();
            } else {
                $archives = $archives->paginate($req->perPage ?? 10);
            }
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
            if ($req->all) {
                $broadcasts = $broadcasts->get();
            } else {
                $broadcasts = $broadcasts->paginate($req->perPage ?? 10);
            }
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
            if ($req->all) {
                $podcasts = $podcasts->get();
            } else {
                $podcasts = $podcasts->paginate($req->perPage ?? 10);
            }
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
            $services =  Service::withAll()->active()->approved()->hasModulePermissions();
            if ($req->tag) {
                $services = $services->whereHas('tags', function ($q) use ($req) {
                    $q->where('slug', $req->tag);
                });
            }
            if($req->service_category){
             $services = $services->whereHas('service_category',function($q) use($req){
                 $q->where('slug',$req->service_category);
             });
         }
             if($req->service_category_id){
                 $services = $services->where('service_category_id',$req->service_category_id);
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
            if ($req->all) {
                $services = $services->get();
            } else {
                $services = $services->paginate($req->perPage ?? 10);
            }
            $services = ServicesResource::collection($services)->response()->getData(true);
            return $services;
        }
        $services = Service::withAll()->hasModulePermissions()->orderBy('id', 'desc')->paginate(10);
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
        $testimonials = Testimonial::active()->when($request->limit, function ($query) use ($request) {
            $query->take($request->limit);
        })->get();
        $testimonials = TestimonialsResource::collection($testimonials);
        return $testimonials;
    }

    public static function getAcademyCategories($request)
    {
        $academy_categories = AcademyCategory::active()->when($request->limit, function ($query) use ($request) {
            $query->take($request->limit);
        })->get();
        $academy_categories = AcademyCategoriesResource::collection($academy_categories);
        return $academy_categories;
    }

    public static function getTags($request)
    {
        $tags = Tag::active()->when($request->limit, function ($query) use ($request) {
            $query->take($request->limit);
        })->get();
        $tags = TagsResource::collection($tags);
        return $tags;
    }

    public static function getBlogCategories($request)
    {
        $blog_categories = BlogCategory::active()->when($request->limit, function ($query) use ($request) {
            $query->take($request->limit);
        })->get();
        $blog_categories = BlogCategoriesResource::collection($blog_categories);
        return $blog_categories;
    }

    public static function getArchiveCategories($request)
    {
        $archive_categories = ArchiveCategory::active()->when($request->limit, function ($query) use ($request) {
            $query->take($request->limit);
        })->get();
        $archive_categories = ArchiveCategoriesResource::collection($archive_categories);
        return $archive_categories;
    }

    public static function getTeacherCategories($request)
    {

        $teacher_categories = TeacherCategory::active()
        ->when($request->limit, function ($query) use ($request) {
            $query->take($request->limit);
        })->get();
        $teacher_categories = TeacherCategoriesResource::collection($teacher_categories);
        return $teacher_categories;
    }

    public static function getTeacherMainCategoriesWithChildrens($request)
    {
        $teacher_main_categories = TeacherMainCategory::withAll()->active()->whereHas('categories', function ($q) {
            $q->active();
        })->when($request->limit, function ($query) use ($request) {
            $query->take($request->limit);
        })->withAll()->withChildrens()->active();
        $teacher_main_categories = $teacher_main_categories->get();

        $teacher_main_categories = TeacherMainCategoriesResource::collection($teacher_main_categories);
        return $teacher_main_categories;
    }

    public static function getCities($request)
    {
        $cities = City::active()->where('country_id', $request->country_id)->where('state_id', $request->state_id)->get();
        return $cities;
    }
    public static function getFeaturedTeachers($request)
    {
        $featured_teachers = Teacher::withAll()->has('user')->whereNotNull('user_name')->active()->approved()->featured()->when($request->limit, function ($query) use ($request) {
            $query->take($request->limit);
        })->get();
        $featured_teachers = TeachersResource::collection($featured_teachers);
        return $featured_teachers;
    }
    public static function getTopRatedTeachers($request)
    {
        $featured_teachers = Teacher::withAll()->has('user')->whereNotNull('user_name')->active()->approved()->featured()->when($request->limit, function ($query) use ($request) {
            $query->take($request->limit);
        })->topRated()->get();
        $featured_teachers = TeachersResource::collection($featured_teachers);
        return $featured_teachers;
    }

    public static function getFeaturedTags($request)
    {
        $featured_tags = Tag::withAll()->active()->when($request->limit, function ($query) use ($request) {
            $query->take($request->limit);
        })->get();
        $featured_tags = TagsResource::collection($featured_tags);
        return $featured_tags;
    }

    public static function getFeaturedEvents($request)
    {
        $featured_events = Event::withAll()->hasModulePermissions()->active()->upcoming()->when($request->limit, function ($query) use ($request) {
            $query->take($request->limit);
        })->get();
        $featured_events = EventsResource::collection($featured_events);
        return $featured_events;
    }

    public static function getSpotlightTeachers($request)
    {
        $spotlight_teachers = Teacher::withAll()->has('user')->whereNotNull('user_name')->active()->approved()->featured();

        $spotlight_teachers = $spotlight_teachers->get();
        $spotlight_teachers = TeachersResource::collection($spotlight_teachers);
        return $spotlight_teachers;
    }

    public static function getFeaturedAcademies($request)
    {
        $featured_academies = Academy::withAll()->has('user')->whereNotNull('user_name')->active()->approved()->featured()->when($request->limit, function ($query) use ($request) {
            $query->take($request->limit);
        })->get();
        $featured_academies = AcademiesResource::collection($featured_academies);
        return $featured_academies;
    }
    public static function getCompanyPage($request, $slug)
    {
        $company_page = CompanyPage::withAll()->where('slug', $slug)->first();
        $company_page = new CompanyPagesResource($company_page);
        return $company_page;
    }
    public static function getAppointmentTypes($request)
    {
        $appointment_types = AppointmentType::active()->get();
        $appointment_types = AppointmentTypesResource::collection($appointment_types);
        return $appointment_types;
    }

    public static function getServiceCategories($request)
    {
        $service_categories = ServiceCategory::active()->when($request->limit, function ($query) use ($request) {
            $query->take($request->limit);
        })->get();
        $service_categories = ServiceCategoriesResource::collection($service_categories);
        return $service_categories;
    }
}
