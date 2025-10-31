<?php

namespace App\Services\Gateway\shift4;


use Facades\App\Services\BasicService;
use SecurionPay\Exception\SecurionPayException;
use SecurionPay\Response\Charge;
use SecurionPay\SecurionPayGateway;
use Shift4\Shift4Gateway;
use Shift4\Exception\Shift4Exception;

class Payment
{
    public static function prepareData($deposit, $gateway)
    {
        $send['view'] = 'user.payment.card';
        return json_encode($send);
    }

    public static function ipn($request, $gateway, $order = null, $trx = null, $type = null)
    {
        // $prepareGateway = new SecurionPayGateway($gateway->parameters->secret_key);

        // $gateway = new Shift4Gateway('sk_test_[YOUR_SECRET_KEY]');
        $gateway = new Shift4Gateway($gateway->parameters->secret_key);

        $finalAmount = ceil($order->final_amount);
        $request = array(
            'amount' => $finalAmount,
            'currency' => $order->gateway_currency,
            'card' => array(
                'number' => $request->card_number,
                'expMonth' => $request->expiry_month,
                'expYear' => $request->expiry_year
            )
        );



        try {
            $charge = $gateway ->createCharge($request);

            if ($charge->getAmount() == $finalAmount && $charge->getCurrency() == $order->gateway_currency) {
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
                $data['msg'] = 'unsuccessful transaction.';
                $data['redirect'] = route('failed');
            }
        } catch (Shift4Exception $e) {
            // $data['status'] = 'error';
            // $data['msg'] = $e->getMessage();
            // $data['redirect'] = route('failed');
            $errorType = $e->getType();
            $errorCode = $e->getCode();
            $errorMessage = $e->getMessage();
        }
        return $data;
    }
}
