<?php

namespace App\Services\Gateway\mollie;

use Facades\App\Services\BasicService;
use Mollie\Laravel\Facades\Mollie;

class Payment
{
    public static function prepareData($order, $gateway)
    {
        $basic = (object) config('basic');
        config(['mollie.key' => trim($gateway->parameters->api_key)]);

        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => "$order->gateway_currency",
                'value' => '' . sprintf('%0.2f', round($order->final_amount, 2)) . '',
            ],
            'description' => "Payment To $basic->site_title Account",
            'redirectUrl' => route('ipn', [$gateway->code, $order->transaction]),
            'metadata' => [
                "order_id" => $order->transaction,
            ],
        ]);
        $payment = Mollie::api()->payments()->get($payment->id);

        session()->put('payment_id',$payment->id);
        session()->put('deposit_id',$order->id);

        $send['redirect'] = true;
        $send['redirect_url'] = $payment->getCheckoutUrl();
        // dd($send['redirect_url']);
        return json_encode($send);
    }

    public static function ipn($request, $gateway, $order = null, $trx = null, $type = null)
    {
        config(['mollie.key' => trim($gateway->parameters->api_key)]);
        $payment = Mollie::api()->payments()->get(session()->get('payment_id'));


        if ($payment->status == "paid") {
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

        return $data;
    }
}
