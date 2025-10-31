<?php

namespace App\Services\Gateway\razorpay;

use Facades\App\Services\BasicService;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;

require_once('razorpay-php/Razorpay.php');

class Payment
{
    public static function prepareData($order, $gateway)
    {
        $api_key = $gateway->parameters->key_id ?? '';
        $api_secret = $gateway->parameters->key_secret ?? '';
        $razorPayApi = new Api($api_key, $api_secret);
        $finalAmount = round($order->final_amount * 100, 2);
        $gatewayCurrency =  $order->gateway_currency;
        $trx = $order->transaction;
        $razorOrder = $razorPayApi->order->create(
            array(
                'receipt' => $trx,
                'amount' => $finalAmount,
                'currency' => $gatewayCurrency,
                'payment_capture' => '0'
            )
        );

        $val['key'] = $api_key;
        $val['amount'] = $finalAmount;
        $val['currency'] = $gatewayCurrency;
        $val['order_id'] = $razorOrder['id'];
        $val['buttontext'] = "Pay via Razorpay";
        $val['name'] = optional($order->user)->username;
        $val['description'] = "Payment By Razorpay";
        $val['image'] = asset('assets/uploads/logo/logo.png');
        $val['prefill.name'] = optional($order->user)->username;
        $val['prefill.email'] = optional($order->user)->email;
        $val['prefill.contact'] = optional($order->user)->phone;
        $val['theme.color'] = config('basic.base_color') ?? "#2ecc71";
        $send['val'] = $val;

        $send['method'] = 'GET';
        $send['url'] = route('ipn', [$gateway->code, $order->transaction]);
        $send['custom'] = $trx;
        $send['checkout_js'] = "https://checkout.razorpay.com/v1/checkout.js";
        $send['view'] = 'user.payment.razorpay';
        return json_encode($send);
    }

    public static function ipn($request, $gateway, $order = null, $trx = null, $type = null)
    {
        $api_secret = $gateway->parameters->key_secret ?? '';
        $signature = hash_hmac('sha256', $request->razorpay_order_id . "|" . $request->razorpay_payment_id, $api_secret);
        if ($signature == $request->razorpay_signature) {
            BasicService::preparePaymentUpgradation($order);
            $data['status'] = 'success';
            $data['msg'] = 'Transaction was successful.';
            if ($order->type == 'wallet') {
                $data['redirect'] = route('wallet');
            } else {
                $appointment_id = $order->appointment->id;
                $appointment_type = $order->appointment->appointment_type->type;
                if ($order->appointment->teacher_id) {
                    $user_name = $order->appointment->teacher->user_name;
                    $data['redirect'] = '/teacher/profile/' . $user_name . '/book_appointment?type=' . $appointment_type . '&paymentSuccess=true&appointmentId=' . $appointment_id;
                } elseif ($order->appointment->academy_id) {
                    $user_name = $order->appointment->academy->user_name;
                    $data['redirect'] = '/academy/profile/' . $user_name . '/book_appointment?type=' . $appointment_type . '&paymentSuccess=true&appointmentId=' . $appointment_id;
                }
            }
        } else {
            $data['status'] = 'error';
            $data['msg'] = 'unexpected error!';
            $data['redirect'] = route('failed');
        }

        return $data;
    }
}
