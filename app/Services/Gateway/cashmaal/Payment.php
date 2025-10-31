<?php

namespace App\Services\Gateway\cashmaal;

use App\Models\Fund;
use Facades\App\Services\BasicService;

class Payment
{
    public static function prepareData($order, $gateway)
    {
        if ($order->type == 'wallet') {
            $success_route = route('wallet');
        } else {
            $appointment_id = $order->appointment->id;
            $appointment_type = $order->appointment->appointment_type->type;
            if ($order->appointment->teacher_id) {
                $user_name = $order->appointment->teacher->user_name;
                $success_route = '/teacher/profile/' . $user_name . '/book_appointment?type=' . $appointment_type . '&paymentSuccess=true&appointmentId=' . $appointment_id;
            } elseif ($order->appointment->academy_id) {
                $user_name = $order->appointment->academy->user_name;
                $success_route = '/academy/profile/' . $user_name . '/book_appointment?type=' . $appointment_type . '&paymentSuccess=true&appointmentId=' . $appointment_id;
            }
        }
        $val['pay_method'] = " ";
        $val['amount'] = round($order->final_amount, 2);
        $val['currency'] = $order->gateway_currency;
        $val['succes_url'] = $success_route;

        $val['cancel_url'] = route('user.addFund');

        $val['client_email'] = optional($order->user)->email;
        $val['web_id'] = $gateway->parameters->web_id;
        $val['order_id'] = $order->transaction;
        $val['addi_info'] = "Payment";

        $send['url'] = 'https://www.cashmaal.com/Pay/';
        $send['method'] = 'post';
        $send['view'] = 'user.payment.redirect';
        $send['val'] = $val;

        return json_encode($send);
    }

    public static function ipn($request, $gateway, $order = null, $trx = null, $type = null)
    {
        $order = Fund::where('transaction', $request->order_id)->orderBy('id', 'DESC')->first();
        if ($order) {
            if ($request->currency == $order->gateway_currency && ($request->Amount == round($order->final_amount, 2)) && $order->status == 0) {
                BasicService::preparePaymentUpgradation($order);
            }
        }
    }
}
