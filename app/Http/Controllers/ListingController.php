<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Teacher;

class ListingController extends Controller
{
    public function __construct()
    {
    }

    public function teacherListing(Request $request)
    {
        $data = $request->all();
        // $data['category'] = 'all';
        return Inertia::render('Teachers/Listing',$data);
    }

    public function academyListing(Request $request)
    {
        return Inertia::render('Academies/Listing',$request->all());
    }

    public function eventListing(Request $request)
    {
        return Inertia::render('Events/Listing',$request->all());
    }
    public function blogListing(Request $request)
    {
        return Inertia::render('Blogs/Listing',$request->all());
    }
    public function archiveListing(Request $request)
    {
        return Inertia::render('Archives/Listing',$request->all());
    }
    public function broadcastListing(Request $request)
    {
        return Inertia::render('Broadcasts/Listing',$request->all());
    }
    public function podcastListing(Request $request)
    {
        return Inertia::render('Podcasts/Listing',$request->all());
    }
    public function tagListing(Request $request)
    {
        return Inertia::render('Tags/Listing',$request->all());
    }
    public function serviceListing(Request $request)
    {
        return Inertia::render('Services/Listing',$request->all());
    }
}
