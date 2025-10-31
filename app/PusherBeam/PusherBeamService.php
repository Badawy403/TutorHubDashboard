<?php

namespace App\PusherBeam;

use Exception;
use Illuminate\Http\Request;
use Pusher\PushNotifications\PushNotifications;

class PusherBeamService
{
    protected $pusher;
    protected $instanceId;
    protected $secretKey;

    public function __construct()
    {
        $settings = generalSettings();
        $this->instanceId = $settings['pusher_beams_instance_id'] ?? null;
        $this->secretKey = $settings['pusher_beams_secret_key'] ?? null;
        $this->pusher = new PushNotifications([
            'instanceId' => $this->instanceId,
            'secretKey' => $this->secretKey,
        ]);
    }
    public function sendNotificationToIntrests($interest_name, $title, $body, $deep_link)
    {
        $this->pusher->publishToInterests([$interest_name], [
            'apns' => [
                'aps' => [
                    'alert' => [
                        'title' => $title,
                        'body' => $body,
                        'deep_link' => $deep_link
                    ],
                ],
            ],
            'fcm' => [
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                    'deep_link' => $deep_link
                ],
            ],
            'web' => ['notification' => ['title' => 'New Notification', 'body' => 'You have a new notification!', 'deep_link' => $deep_link]],
        ]);
    }
    public function generateToken(Request $request)
    {
        $userId = $request->user_id;
        $token = $this->pusher->generateToken($userId);
        return response()->json($token);
    }
    public function sendNotificationToUsers($users, $title, $body, $deep_link , $payload = null)
    {
        $this->pusher->publishToUsers([$users], [
            'apns' => [
                'aps' => [
                    'alert' => [
                        'title' => $title,
                        'body' => $body,
                        'deep_link' => $deep_link
                    ],
                    'data' => [
                        "payload" => $payload
                    ],
                ],
            ],
            'fcm' => [
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                    'deep_link' => $deep_link
                ],
                'data' => [
                    "payload" => $payload
                ],
            ],
            'web' => ['notification' => ['title' => $title, 'body' => $body, 'deep_link' => $deep_link]
        ]
        ]);
    }
    public function deleteAuthenticatedUser($user)
    {
        $respone = $this->pusher->deleteUser($user);
        dd($respone);
    }
}
