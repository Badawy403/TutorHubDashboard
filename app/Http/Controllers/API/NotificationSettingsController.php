<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\InAppNotificationsResource;
use App\Models\InAppNotification;
use Illuminate\Support\Facades\Auth;


class NotificationSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function getInAppNotification()
    {
        // dd(Auth::user()->id);
        $in_app_notifications = InAppNotification::withAll()->where('user_id',Auth::user()->id)->get();
        $in_app_notifications = InAppNotificationsResource::collection($in_app_notifications);
        $response = generateResponse($in_app_notifications,false ,'In App Notification get successfully',null,'collection');
        return response()->json($response, 200);
    }
    public function updateIsSeenNotificationStatus(Request $req)
    {
        // $user = Auth::user();
        $in_app_notifications = InAppNotification::where('id',$req->id)->first();
        if($in_app_notifications){
            $in_app_notifications->is_seen = 1;
            $in_app_notifications->update();
        }
        $response = generateResponse(null, true, "Notification Seen Status Updated Successfully", null, 'collection');
        return response()->json($response);
    }

}
