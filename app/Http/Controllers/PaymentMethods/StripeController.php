<?php

namespace App\Http\Controllers\PaymentMethods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function processPayment(Request $request)
    {
        // Set your Stripe secret key
        $settings = generalSettings();

        Stripe::setApiKey($settings['stripe_secret']);

        // Get the required data from the request
        $token = $request->stripe_token['id'];
        $amount = $request->amount;

        try {
            // Create a charge using the Stripe API
            $charge = Charge::create([
                'amount' => $amount * 100,
                'currency' => 'usd',
                'source' => $token,
            ]);

            // Payment success
            return response()->json([
                'success' => true,
                'message' => 'Payment successful!',
                'charge' => $charge,
            ]);
        } catch (\Exception $e) {
            // Payment failed
            return response()->json([
                'success' => false,
                'message' => 'Payment failed!',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
