<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class APIBroadcastAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api','auth:api','verified','api_setting']);
    }

    public function auth(Request $request)
    {
        if (auth()->check()) {
            //return true;
             $socketId = $request->header('Socket-id');
             $channelName = 'make-agora-call.13';
             $key = '9d8e7b5c8ce69b2c07af';
             $secret = '3249dca6b5e76fc1a98d';
             $user = auth()->user();
            $string_to_sign = $socketId."::make-agora-call.13";
            $signature = hash_hmac('sha256', $string_to_sign, $secret);
            $auth = "9d8e7b5c8ce69b2c07af:{$signature}";
            
            $signature = hash_hmac('sha256', $string_to_sign, $secret);

            // // Add any additional logic for authorization here

            return response()->json([
                'auth' => $auth,
                'channel_data' => "{\"id\":\"12345\"}",
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
