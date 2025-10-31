<?php

namespace App\Services\Gateway\mypay;


use App\Models\Fund;
use Facades\App\Services\BasicService;
use Facades\App\Services\BasicCurl;

class Payment
{
    public static function prepareData($order, $gateway)
    {
        $API_KEY = $gateway->parameters->api_key ?? '';
        $UserName = $gateway->parameters->merchant_username ?? '';
        $Password = $gateway->parameters->merchant_api_password ?? '';
        $MerchantId = $gateway->parameters->merchant_id ?? '';

        // Test Credentials
        // $url = "https://testapi.mypay.com.np/api/use-mypay-payments";
        // Live Credentials
        $url = "https://smartdigitalnepal.com/api/use-mypay-payments";

        $headers = [
            'Content-Type: application/json',
            "API_KEY: $API_KEY",
        ];

        $postParam = [
            "Amount" => round($order->final_amount,2),
            "OrderId" => $order->transaction,
            "UserName" => "$UserName",
            "Password" => "$Password",
            "MerchantId" => "$MerchantId"
        ];

        $result = BasicCurl::curlPostRequestWithHeadersJson($url, $headers, $postParam);
        $response = json_decode($result);


        if (@$response->status == false) {
            $send['error'] = true;
            $send['message'] = 'PLEASE TRY LATER. ' . @$response->Message;
        } else {
            $order['btc_wallet'] = $response->MerchantTransactionId;
            $order->update();

            $send['redirect'] = true;
            $send['redirect_url'] = $response->RedirectURL;
        }

        return json_encode($send);

    }

    public static function ipn($request, $gateway, $order = null, $trx = null, $type = null)
    {
        $API_KEY = $gateway->parameters->api_key ?? '';
        $UserName = $gateway->parameters->merchant_username ?? '';
        $Password = $gateway->parameters->merchant_api_password ?? '';
        $MerchantId = $gateway->parameters->merchant_id ?? '';

        $orderData = Fund::with('gateway')
            ->whereHas('gateway', function ($query) {
                $query->where('code', 'mypay');
            })
            ->where('status', 0)
            ->whereNotNull('btc_wallet')
            ->latest()
            ->get();


     //   $url = 'https://testapi.mypay.com.np/api/use-mypay-payments-status';
        $url = "https://smartdigitalnepal.com/api/use-mypay-payments-status";

        $headers = [
            'Content-Type: application/json',
            "API_KEY: $API_KEY",
        ];

        foreach ($orderData as $data) {
            $postParam['MerchantTransactionId']= $data->btc_wallet;
            $result = BasicCurl::curlPostRequestWithHeadersJson($url, $headers, $postParam);
            $response = json_decode($result);
            if(isset($response) && $response->Status == 1){
                BasicService::preparePaymentUpgradation($data);
            }
        }

    }
}
