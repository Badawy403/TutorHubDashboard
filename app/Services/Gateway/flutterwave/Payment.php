<?php

namespace App\Services\Gateway\flutterwave;

use Facades\App\Services\BasicCurl;
use Facades\App\Services\BasicService;


class Payment
{
    public static function prepareData($order, $gateway)
    {
        $send['API_publicKey'] = $gateway->parameters->public_key ?? '';
        $send['student_email'] = optional($order->user)->email;
        $send['amount'] = $order->final_amount;
        $send['student_phone'] = optional($order->user)->phone ?? '';
        $send['currency'] = $order->gateway_currency;
        $send['txref'] = $order->transaction;
        $send['view'] = 'user.payment.flutterwave';
        return json_encode($send);
    }

    public static function ipn($request, $gateway, $order = null, $trx = null, $type = null)
    {

        if ($type == 'error') {
            $data['status'] = 'error';
            $data['msg'] = 'transaction Failed.';
            $data['redirect'] = route('failed');
        } else {

            $url = 'https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify';
            $headers = ['Content-Type:application/json'];
            $postParam = array(
                "SECKEY" => $gateway->parameters->secret_key ?? '',
                "txref" => $order->transaction
            );

            $response = BasicCurl::curlPostRequestWithHeaders($url, $headers, $postParam);
            $response = json_decode($response);
            if ($response->data->status == "successful" && $response->data->chargecode == "00" && $order->final_amount == $response->data->amount && $order->gateway_currency == $response->data->currency && $order->status == 0) {
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


                return $data;
            } else {
                $data['status'] = 'error';
                $data['msg'] = 'unable to Process.';
                $data['redirect'] = route('failed');

                return $data;
            }
        }
    }
}
