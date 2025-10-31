<?php

namespace App\Services\Gateway\mercadopago;

use Facades\App\Services\BasicCurl;
use Facades\App\Services\BasicService;

class Payment
{
    const SANDBOX = false;

    public static function prepareData($order, $gateway)
    {
        $basic = (object) config('basic');
        $url = "https://api.mercadopago.com/checkout/preferences?access_token=" . $gateway->parameters->access_token;
        $headers = [
            "Content-Type: application/json",
        ];
        $postParam = [
            'items' => [
                [
                    'id' => $order->transaction,
                    'title' => getAmount($order->amount) . ' '. $basic->currency ?? 'order ' . $order->id,
                    'description' => "Payment To $basic->site_title Account",
                    'quantity' => 1,
                    'currency_id' => $order->gateway_currency,
                    'unit_price' => round($order->final_amount, 2)
                ]
            ],
            'payer' => [
                'email' => optional($order->user)->email ?? '',
            ],
            'back_urls' => [
                'success' => route('success'),
                'pending' => '',
                'failure' => route('failed'),
            ],
            'notification_url' => route('ipn', [$gateway->code, $order->transaction]),
            'auto_return' => 'approved',
        ];
        $response = BasicCurl::curlPostRequestWithHeaders($url, $headers, $postParam);
        $response = json_decode($response);

        $send['preference'] = $preference->id ?? '';
        $send['view'] = 'user.payment.mercado';
        if(isset($response->auto_return) && $response->auto_return == 'approved') {
            if (self::SANDBOX) {
                $send['redirect'] = true;
                $send['redirect_url'] = $response->sandbox_init_point;
            } else {
                $send['redirect'] = true;
                $send['redirect_url'] = $response->init_point;
            }
        }else{
            $send['error'] = true;
            $send['message'] = 'Invalid Request';
        }
        return json_encode($send);
    }

    public static function ipn($request, $gateway, $order = null, $trx = null, $type = null)
    {
        $url = "https://api.mercadopago.com/v1/payments/" . $request['data']['id'] . "?access_token=" . $gateway->parameters->access_token;
        $response = BasicCurl::curlGetRequest($url);
        $paymentData = json_decode($response);

        if (isset($paymentData->status) && $paymentData->status == 'approved') {
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
