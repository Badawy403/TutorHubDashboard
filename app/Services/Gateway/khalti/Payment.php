<?php

namespace App\Services\Gateway\khalti;


use App\Models\Fund;
use Facades\App\Services\BasicCurl;
use Facades\App\Services\BasicService;

class Payment
{
    public static function prepareData($order, $gateway)
    {
        $send['publicKey'] = $gateway->parameters->public_key ?? '';
        $send['productIdentity'] = $order->transaction;
        $send['eventOnSuccess'] = route('ipn', [$gateway->code, $order->transaction]);
        $send['amount'] = round($order->final_amount);
        $send['view'] = 'user.payment.khalti';
        return json_encode($send);
    }

    public static function ipn($request, $gateway, $order = null, $trx = null, $type = null)
    {
        $token = $request->token;
        $args = http_build_query(array(
            'token' => $token,
            'amount'  => round($order->final_amount)*100
        ));


        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $secret_key = $gateway->parameters->secret_key ?? '';

        $headers = ["Authorization: Key $secret_key"];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $res = json_decode($response);

        if(isset($res->error_key) && $res->error_key == 'validation_error'){
            $data['status'] = 'error';
            $data['msg'] = 'Validation Error: '.@$res->amount[0]."<br>".$res->token[0];
            $data['redirect'] = route('failed');
            return $data;
        }
        $order = Fund::where("transaction",$res->product_identity)->orderBy('id','desc')->first();
        if($order){
            BasicService::preparePaymentUpgradation($order);
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
        }


    }
}
