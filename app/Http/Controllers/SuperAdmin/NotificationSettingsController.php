<?php

namespace App\Http\Controllers\SuperAdmin;


use App\Http\Controllers\Controller;
use App\Models\InAppNotification;
use App\Models\NotificationSetting;
use App\Notifications\GeneralNotifications;
use App\PusherBeam\PusherBeamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


class NotificationSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        //   $this->middleware('permission:blog.index');
        //   $this->middleware('permission:blog.add', ['only' => ['store']]);
        //   $this->middleware('permission:blog.edit', ['only' => ['update']]);
        //   $this->middleware('permission:blog.delete', ['only' => ['destroy']]);
        //   $this->middleware('permission:blog.export', ['only' => ['export']]);
        //   $this->middleware('permission:blog.import', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        if ($req != null) {
            $notification_settings =  NotificationSetting::withAll();
            if ($req->trash && $req->trash == 'with') {
                $notification_settings =  $notification_settings->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $notification_settings =  $notification_settings->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $notification_settings = $notification_settings->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $notification_settings = $notification_settings->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $notification_settings = $notification_settings->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $notification_settings = $notification_settings->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $notification_settings = $notification_settings->get();
                return $notification_settings;
            }
            $notification_settings = $notification_settings->get();
            return $notification_settings;
        }
        $notification_settings = NotificationSetting::withAll()->orderBy('id', 'desc')->get();
        return $notification_settings;
    }


    /*********View All Posts  ***********/
    public function index(Request $request)
    {


        $notification_settings = NotificationSetting::get()->groupBy('notification_category');

        return view('super_admins.notification_settings.index', compact('notification_settings'));
    }



    /*********Store Post  ***********/
    public function store(Request $request)
    {
        $notifications = $request->input('notifications', []);


        foreach ($notifications as $key => $notification_setting_data) {
            $id = $notification_setting_data['id'];
            $is_email_send = isset($notification_setting_data['is_email_send']);
            $is_push_notification_send = isset($notification_setting_data['is_push_notification_send']);
            $is_in_app_notification_send = isset($notification_setting_data['is_in_app_notification_send']);

            $notification = NotificationSetting::find($id);
            if ($notification) {
                $notification->is_email_send = $is_email_send;
                $notification->is_push_notification_send = $is_push_notification_send;
                $notification->is_in_app_notification_send = $is_in_app_notification_send;
                $notification->save();
            }
        }
        return redirect()->back()->with('message', 'Notification Settings Updated Successfully')->with('message_type', 'success');
    }

    public static function fireNotificationEvent($data = null, $notification_setting_name, $email_users = null, $notification_goto_url = null, $notification_title = null, $notification_customer_id = null)
    {

        // dd($data, $notification_setting_name);
        $notification_setting = NotificationSetting::where('setting_name', $notification_setting_name)->active()->first();


        // $user = $email_users ? $email_users : Auth::user();


        // $customer_id = $data->customer ? $data->customer->id : $data->id;
        $body = 'You have a new notification';

        if ($notification_setting->is_email_send) {
            if (count($email_users) > 0) {
                foreach ($email_users as $key => $user) {
                    Notification::send($user, new GeneralNotifications($data, $notification_setting_name));
                }
            } else {
                $user = $email_users;
                Notification::send($user, new GeneralNotifications($data, $notification_setting_name));
            }
            // $user->notify(new GeneralNotifications($data, $notification_setting_name));
        }
        if ($notification_setting->is_push_notification_send && $notification_title != null) {
            //Target Pusher Notification
            $pusher = new PusherBeamService;
            $users = (string)$notification_customer_id;
            $pusher->sendNotificationToUsers($users, $notification_title, $body, $notification_goto_url);
        }
        if ($notification_setting->is_in_app_notification_send) {

            if (count($email_users) > 1) {

                foreach ($email_users as $key => $user) {
                    $in_app_notification = InAppNotification::create([
                        'name' => $notification_title,
                        'description' => $body,
                        'redirect_url' => $notification_goto_url,
                        'user_id' => $user->id,
                    ]);
                }
            } else {
                $user = $email_users;
                $in_app_notification = InAppNotification::create([
                    'name' => $notification_title,
                    'description' => $body,
                    'redirect_url' => $notification_goto_url,
                    'user_id' => $user[0][0]->id,
                ]);
            }
        }
    }
}
