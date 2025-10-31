<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\ArchivesResource;
use App\Http\Resources\Web\BroadcastsResource;
use App\Http\Resources\Web\EventsResource;
use App\Http\Resources\Web\PodcastsResource;
use App\Http\Resources\Web\PostsResource;
use App\Http\Resources\Web\ServiceCategoriesResource;
use App\Http\Resources\Web\ServicesResource;
use App\Http\Resources\Web\TagsResource;
use App\Models\Archive;
use App\Models\Broadcast;
use App\Models\Event;
use App\Models\Post;
use App\Models\Podcast;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Tag;

class DetailController extends Controller
{
    public function __construct()
    {
    }

    public function blogDetail(Request $request,$slug)
    {
        $post = Post::withAll()->hasModulePermissions()->active()->where('slug',$slug)->first();
        if(!$post){
            abort(404);
        }
        $post = new PostsResource($post);
        return Inertia::render('Blogs/Detail',['post' => $post]);
    }

    public function archiveDetail(Request $request,$slug)
    {
        $archive = Archive::withAll()->hasModulePermissions()->active()->where('slug',$slug)->first();
        if(!$archive){
            abort(404);
        }
        $archive = new ArchivesResource($archive);
        return Inertia::render('Archives/Detail',['archive' => $archive]);
    }

    public function BroadcastDetail(Request $request,$slug)
    {
        $broadcast = Broadcast::withAll()->hasModulePermissions()->active()->where('slug',$slug)->first();
        if(!$broadcast){
            abort(404);
        }
        $broadcast = new BroadcastsResource($broadcast);

        return Inertia::render('Broadcasts/Detail',['broadcast' => $broadcast]);
    }

    public function PodcastDetail(Request $request,$slug)
    {
        $podcast = Podcast::withAll()->hasModulePermissions()->active()->where('slug',$slug)->first();
        if(!$podcast){
            abort(404);
        }
        $podcast = new PodcastsResource($podcast);
        return Inertia::render('Podcasts/Detail',['podcast' => $podcast]);
    }

    public function TagDetail(Request $request,$slug)
    {
        $tag = Tag::withAll()->withChildrens()->active()->where('slug',$slug)->first();
        if(!$tag){
            abort(404);
        }
        $tag = new TagsResource($tag);
        return Inertia::render('Tags/Detail',[
            'tag' => $tag
        ]);
    }
    public function eventDetail(Request $request,$slug)
    {
        $event = Event::withAll()->hasModulePermissions()->active()->where('slug',$slug)->first();
        if(!$event){
            abort(404);
        }
        $event = new EventsResource($event);
        return Inertia::render('Events/Detail',['event' => $event]);
    }

    public function ServiceDetail(Request $request,$slug)
    {
        $service = Service::approved()->withAll()->withChildrens()->hasModulePermissions()->active()->where('slug',$slug)->first();
        if(!$service){
            abort(404);
        }
        $service_category = ServiceCategory::find($service->service_category_id);
        if($service_category){
            $service_category = new ServiceCategoriesResource($service_category);
        }
        $related_services = Service::withAll()->hasModulePermissions()->active()->where('id','!=',$service->id)->where('service_category_id',$service->service_category_id)->get();
        $service = new ServicesResource($service);
        $related_services = ServicesResource::collection($related_services);
        return Inertia::render('Services/Detail',['service' => $service,'related_services' => $related_services,'service_category' => $service_category]);
    }
}
