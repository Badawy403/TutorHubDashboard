<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Agora\Src\RtcTokenBuilder;
use App\Events\MakeAgoraCall;

class AgoraController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api', 'auth:api', 'verified', 'api_setting']);
    }

    public function generateAgoraToken(Request $request)
    {

        $request->validate([
            'channel' => 'required|string',
        ]);
        $settings = generalSettings();
        $appID = $settings['agora_app_id'] ?? null;
        $appCertificate = $settings['agora_app_certificate'] ?? null;
        $channelName = $request->channel;
        $uid = (int) mt_rand(1000000000, 9999999999);
        $uidStr = strval($uid);
        $role = RtcTokenBuilder::RoleAttendee;
        $expireTimeInSeconds = 2400;
        $currentTimestamp = (new \DateTime("now", new \DateTimeZone('Asia/Karachi')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
        $token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, null, $role, $privilegeExpiredTs);
        $response = generateResponse($token, true, "Agora token Generated Successfully", null, 'collection');
        return response()->json($response);
    }
    public function makeAgoraCall(Request $request)
    {
        $request->validate([
            'appointment' => 'required',
            'channel' => 'required',
            'token' => 'required',
        ]);
        event(new MakeAgoraCall($request->appointment, $request->channel, $request->token));
        $response = generateResponse([], true, "Broadcasted Successfully", null, 'collection');
        return response()->json($response);
    }
}
