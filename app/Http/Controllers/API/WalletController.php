<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use App\Http\Resources\Web\TransactionsResource;
use App\Http\Resources\Web\WithdrawlsResource;
use Illuminate\Support\Facades\Auth;
use App\Models\WithdrawRequest;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api', 'auth:api', 'verified', 'api_setting']);
    }

    public function getCurrentBalance()
    {
        $user = Auth::user();
        $balance = $user->wallet->balance;
        $response = generateResponse($balance, true, "Current Wallet balance fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getWalletTransactions(Request $req)
    {
        $user = Auth::user();
        $transactions = $user->transactions()->orderBy('id', 'desc');
        if ($req != null && $req->perPage) {
            $transactions =  $transactions->paginate($req->perPage);
        } else {
            $transactions =  $transactions->paginate(10);
        }
        $transactions =  TransactionsResource::collection($transactions)->response()->getData(true);

        $response = generateResponse($transactions, true, "Wallet transactions fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getWalletWithdrawls(Request $req)
    {
        $user = Auth::user();
        $withdrawals = $user->withdrawals()->orderBy('id', 'desc');
        if ($req != null && $req->perPage) {
            $withdrawals =  $withdrawals->paginate($req->perPage);
        } else {
            $withdrawals =  $withdrawals->paginate(10);
        }
        $withdrawals =  WithdrawlsResource::collection($withdrawals)->response()->getData(true);
        $response = generateResponse($withdrawals, true, "Wallet withdrawals fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function AddAmountToWallet(Request $request)
    {
        $request->validate(['gateway' => 'required|exists:gateways,code']);
        $request->merge(['type' => 'wallet']);
        $fund_request = PaymentController::addFundRequest($request);
        if ($fund_request['fund'] ?? false) {
            $data = [
               'fund_transaction' => $fund_request['fund']->transaction
            ];
            $response = generateResponse($data, true, "Deposit Request Created Successfully", null, 'collection');
        }
        return response()->json($response);
    }
    public function withdrawAmount(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'account_holder' => 'required',
            'account_number' => 'required',
            'bank' => 'required',
            'additional_note' => 'required',
        ]);
        $user = Auth::user();
        if ($user->balanceInt > $request->amount || $user->balanceInt == $request->amount) {
            $created = WithdrawRequest::create([
                'user_id' => $user->id,
                'amount' => $request->amount,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank' => $request->bank,
                'additional_note' => $request->additional_note,
                'status' => WithdrawRequest::$Pending

            ]);
            $response = generateResponse(null, true, "Withdraw request has been submitted", null, 'collection');
            return response()->json($response);
        } else {
            $response = generateResponse(null, false, "Withdraw amount cannot be greater than Current Balance", null, 'collection');
            return response()->json($response);
        }
    }
}
