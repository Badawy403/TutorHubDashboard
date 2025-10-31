<?php

namespace App\Http\Controllers\PaymentMethods;

use App\Http\Controllers\Controller;
use App\Models\BookAppointment;
use App\Models\BookedService;
use App\Models\Currency;
use App\Models\Fund;
use App\Models\Gateway;
use Illuminate\Http\Request;
use Stripe\Charge;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Stripe\Stripe;

class StripePaymentsController extends Controller
{
    public function getStripeAccount(Request $request)
    {
        $appointment = BookAppointment::find($request->appointment_id);
        $fund = $appointment->fund;
        $default_currency = Currency::where('is_default', 1)->first();


        return view('stripe', compact('appointment', 'fund', 'default_currency'));
        // return Inertia::render('StripeAccount', [
        //     'appointment' => $appointment,
        //     'fund' => $fund,
        // ]);
    }
    public function getServiceStripeAccount(Request $request)
    {
        $service = BookedService::find($request->service_id);
        $fund = $service->fund;
        $default_currency = Currency::where('is_default', 1)->first();


        return view('service_stripe', compact('service', 'fund', 'default_currency'));
    }
    public function getStripeAccountForWallet(Request $request)
    {
        $fund = Fund::where('id', $request->fund_id)->first();
        $default_currency = Currency::where('is_default', 1)->first();
        return view('stripe_wallet', compact('fund', 'default_currency'));
    }


    public function stripeTransfer(Request $request)
    {
        // dd($request->all());
        $gateway = Gateway::where('code', 'stripe')->first();
        $appointment = BookAppointment::where('id', $request->appointment_id)->first();

        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            //'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('students.appointment_stripe_transfers', ['appointment_id' => $request->appointment_id])
                ->withErrors($validator)
                ->withInput();
        }
        $amount = getAmount($request->amount);


        try {
            \Stripe\Stripe::setApiKey($gateway->parameters->secret_key ?? '');
            $stripe = new \Stripe\StripeClient($gateway->parameters->secret_key ?? '');
            $token = $stripe->tokens->create([
                'card' => [
                    'number' => $request->get('card_no'),
                    'exp_month' => $request->get('ccExpiryMonth'),
                    'exp_year' => $request->get('ccExpiryYear'),
                    'cvc' => $request->get('cvvNumber'),
                ],
            ]);

            // if (!isset($token->id)) {
            //     return redirect()->route('students.appointment_stripe_transfers',['appointment_id' => $request->appointment_id])->with('error', 'Token creation failed!');
            // }

            // dd($request->currency_code);
            $charge = $stripe->charges->create([
                'source' => $token->id,
                'currency' => $request->currency_code,
                'amount' => $amount * 100,
                'description' => 'appointment booked',
            ]);

            if ($charge->status == 'succeeded') {
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Stripe Payment Successfully',
                ]);

                if ($appointment) {
                    $appointment->update([
                        'is_paid' => 1,
                    ]);
                }

                return redirect()->route('appointment_log')->with('message', 'Stripe Payment Successfully')->with('message_type', 'success');
            } else {
                return redirect()->route('students.appointment_stripe_transfers', ['appointment_id' => $request->appointment_id])->with('error', 'Money not added to wallet!');
            }
        } catch (\Stripe\Exception\CardException $e) {
            return redirect()->back()->with('error', 'Card error: ' . $e->getMessage())->withInput();
        } catch (\Stripe\Exception\RateLimitException $e) {
            return redirect()->back()->with('error', 'Rate limit error: ' . $e->getMessage())->withInput();
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return redirect()->back()->with('error', 'Invalid request: ' . $e->getMessage())->withInput();
        } catch (\Stripe\Exception\AuthenticationException $e) {
            return redirect()->back()->with('error', 'Authentication error: ' . $e->getMessage())->withInput();
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            return redirect()->back()->with('error', 'Network error: ' . $e->getMessage())->withInput();
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return redirect()->back()->with('error', 'Stripe API error: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'General error: ' . $e->getMessage())->withInput();
        }
    }


    public function servicestripeTransfer(Request $request)
    {
        $gateway = Gateway::where('code', 'stripe')->first();
        $service = BookedService::find($request->service_id);

        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('students.service_stripe_transfers', ['service_id' => $request->service_id])
                ->withErrors($validator)
                ->withInput();
        }

        $amount = getAmount($request->amount);

        try {
            \Stripe\Stripe::setApiKey($gateway->parameters->secret_key ?? '');
            $stripe = new \Stripe\StripeClient($gateway->parameters->secret_key ?? '');
            $token = $stripe->tokens->create([
                'card' => [
                    'number' => $request->get('card_no'),
                    'exp_month' => $request->get('ccExpiryMonth'),
                    'exp_year' => $request->get('ccExpiryYear'),
                    'cvc' => $request->get('cvvNumber'),
                ],
            ]);

            $charge = $stripe->charges->create([
                'source' => $token->id,
                'currency' => $request->currency_code,
                'amount' => $amount * 100,
                'description' => 'Service booked',
            ]);

            if ($charge->status == 'succeeded') {

                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Stripe Payment Successfully',
                ]);

                $service->update(['is_paid' => 1]);
                return redirect()->route('service_log');
            } else {
                return redirect()->route('students.service_stripe_transfers', ['service_id' => $request->service_id])
                    ->with('error', 'Payment failed! Please try again.');
            }
        } catch (\Stripe\Exception\CardException $e) {
            return redirect()->back()->with('error', 'Card error: ' . $e->getMessage())->withInput();
        } catch (\Stripe\Exception\RateLimitException $e) {
            return redirect()->back()->with('error', 'Rate limit error: ' . $e->getMessage())->withInput();
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return redirect()->back()->with('error', 'Invalid request: ' . $e->getMessage())->withInput();
        } catch (\Stripe\Exception\AuthenticationException $e) {
            return redirect()->back()->with('error', 'Authentication error: ' . $e->getMessage())->withInput();
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            return redirect()->back()->with('error', 'Network error: ' . $e->getMessage())->withInput();
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return redirect()->back()->with('error', 'Stripe API error: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'General error: ' . $e->getMessage())->withInput();
        }
    }


    public function stripeTransferWallet(Request $request)
    {
        // dd($request->all());
        $gateway = Gateway::where('code', 'stripe')->first();
        $fund = Fund::where('id', $request->fund_id)->first();

        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            //'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('students.appointment_stripe_transfers', ['appointment_id' => $request->appointment_id])
                ->withErrors($validator)
                ->withInput();
        }
        $amount = getAmount($request->amount);


        try {
            \Stripe\Stripe::setApiKey($gateway->parameters->secret_key ?? '');
            $stripe = new \Stripe\StripeClient($gateway->parameters->secret_key ?? '');
            $token = $stripe->tokens->create([
                'card' => [
                    'number' => $request->get('card_no'),
                    'exp_month' => $request->get('ccExpiryMonth'),
                    'exp_year' => $request->get('ccExpiryYear'),
                    'cvc' => $request->get('cvvNumber'),
                ],
            ]);

            // if (!isset($token->id)) {
            //     return redirect()->route('students.appointment_stripe_transfers',['appointment_id' => $request->appointment_id])->with('error', 'Token creation failed!');
            // }

            // dd($request->currency_code);
            $charge = $stripe->charges->create([
                'source' => $token->id,
                'currency' => $request->currency_code,
                'amount' => $amount * 100,
                'description' => 'appointment booked',
            ]);

            if ($charge->status == 'succeeded') {
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Stripe Payment Successfully, Show Balance after Approval',
                ]);
                $user = auth()->user();
                $meta = ['details' => 'stripe payment deposite'];

                $user->deposit($amount, $meta);

                return redirect()->route('wallet')->with('message', 'Stripe Payment Successfully')->with('message_type', 'success');
            } else {
                return redirect()->route('students.appointment_stripe_transfers', ['appointment_id' => $request->appointment_id])->with('error', 'Money not added to wallet!');
            }
        } catch (\Stripe\Exception\CardException $e) {
            return redirect()->back()->with('error', 'Card error: ' . $e->getMessage())->withInput();
        } catch (\Stripe\Exception\RateLimitException $e) {
            return redirect()->back()->with('error', 'Rate limit error: ' . $e->getMessage())->withInput();
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return redirect()->back()->with('error', 'Invalid request: ' . $e->getMessage())->withInput();
        } catch (\Stripe\Exception\AuthenticationException $e) {
            return redirect()->back()->with('error', 'Authentication error: ' . $e->getMessage())->withInput();
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            return redirect()->back()->with('error', 'Network error: ' . $e->getMessage())->withInput();
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return redirect()->back()->with('error', 'Stripe API error: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'General error: ' . $e->getMessage())->withInput();
        }
    }
}
