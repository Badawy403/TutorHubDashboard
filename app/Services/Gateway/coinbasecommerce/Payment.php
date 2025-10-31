<?php

namespace App\Services\Gateway\coinbasecommerce;

use Facades\App\Services\BasicCurl;
use Facades\App\Services\BasicService;


class Payment
{
    public static function prepareData($order, $gateway)
    {
        $basic = (object) config('basic');
        $apiKey = $gateway->parameters->api_key ?? '';
        $postParam = [
            'name' => optional($order->user)->name ?? $basic->site_title,
            'description' => "Pay to {$basic->site_title} account",
            'local_price' => [
                'amount' => $order->final_amount,
                'currency' => $order->gateway_currency
            ],
            'metadata' => [
                'trx' => $order->transaction
            ],
            'pricing_type' => "fixed_price",
            'redirect_url' => route('ipn', [$gateway->code, $order->transaction]),
            'cancel_url' => route('failed')
        ];

        $url = 'https://api.commerce.coinbase.com/charges';
        $headers = [
            'Content-Type:application/json',
            'X-CC-Api-Key: ' . "$apiKey",
            'X-CC-Version: 2018-03-22'];
        $response = BasicCurl::curlPostRequestWithHeaders($url, $headers, $postParam);
        $response = json_decode($response);

        if (@$response->error == '') {
            $send['redirect'] = true;
            $send['redirect_url'] = $response->data->hosted_url;
        } else {
            $send['error'] = true;
            $send['message'] = 'Some Problem Occured. Try Again';
        }
        return json_encode($send);
    }

    public static function ipn($request, $gateway, $order = null, $trx = null, $type = null)
    {
        $sentSign = $request->header('X-Cc-Webhook-Signature');
        $sig = hash_hmac('sha256', $request, $gateway->parameters->secret);
        if ($sentSign == $sig) {
            if ($request->event->type == 'charge:confirmed' && $order->status == 0) {
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
                $data['msg'] = 'Invalid response.';
                $data['redirect'] = route('failed');
            }
        } else {
            $data['status'] = 'error';
            $data['msg'] = 'Invalid response.';
            $data['redirect'] = route('failed');
        }
        return $data;
    }
}
