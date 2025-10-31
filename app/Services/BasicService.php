<?php

namespace App\Services;

use Image;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Configure;
// use App\Http\Traits\Notify;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;

class BasicService
{
    // use Notify;
    public function validateDate(string $date)
    {
        if (preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{2,4}$/", $date)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateKeyword(string $search, string $keyword)
    {
        return preg_match('~' . preg_quote($search, '~') . '~i', $keyword);
    }

    public function cryptoQR($wallet, $amount, $crypto = null)
    {

        $varb = $wallet . "?amount=" . $amount;
        return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$varb&choe=UTF-8";
    }

    public function preparePaymentUpgradation($order)
    {
        $basic = (object)config('basic');
        $gateway = $order->gateway;

        if ($order->status == 0) {
            $order['status'] = 1;
            $order->update();
            if ($order->type == 'wallet') {
                $user = $order->user;
                if ($user && $user->wallet) {
                    $meta = ['details' => 'Top Up on Wallet'];
                    $transaction = $user->deposit($order->amount,$meta);
                    $order->update(['transaction_id' => $transaction->id]);
                }
            } else {
                $order->appointment()->update(['is_paid' => 1]);
            }
            $user = $order->user;
        }
        session()->forget('amount');
    }


    public function setBonus($user, $amount, $commissionType = '')
    {
        $basic = (object)config('basic');
        $userId = $user->id;
        $i = 1;
        $level = \App\Models\Referral::where('commission_type', $commissionType)->count();
        while ($userId != "" || $userId != "0" || $i < $level) {
            $me = \App\Models\User::with('referral')->find($userId);
            $refer = $me->referral;
            if (!$refer) {
                break;
            }
            $commission = \App\Models\Referral::where('commission_type', $commissionType)->where('level', $i)->first();
            if (!$commission) {
                break;
            }
            $com = ($amount * $commission->percent) / 100;
            $new_bal = getAmount($refer->balance + $com);
            $refer->balance = $new_bal;
            $refer->save();

            $trx = strRandom();

            if ($commission->commission_type == "invest") {
                $remarks = ' level ' . $i . ' Referral Purchased Coin Bonus From ' . $user->username;
            } else {
                $remarks = ' level ' . $i . ' Referral Deposit Bonus From ' . $user->username;
            }

            $this->makeTransaction($refer, $com, 0, '+R', $trx, $remarks);

            $bonus = new \App\Models\ReferralBonus();
            $bonus->from_user_id = $refer->id;
            $bonus->to_user_id = $user->id;
            $bonus->level = $i;
            $bonus->amount = getAmount($com);
            $bonus->main_balance = $new_bal;
            $bonus->transaction = $trx;
            $bonus->type = $commissionType;
            $bonus->remarks = $remarks;
            $bonus->save();


            $this->sendMailSms($refer, $type = 'REFFERAL_BONUS_COMMISSION', [
                'transaction' => $trx,
                'amount' => getAmount($com),
                'currency' => $basic->currency,
                'referral_from' => $user->username,
                'current_balance' => getAmount($refer->balance),
                'level' => $i
            ]);


            $msg = [
                'referral_from' => $user->username,
                'amount' => getAmount($com),
                'currency' => $basic->currency,
                'level' => $i
            ];
            $action = [
                "link" => route('user.referral.bonus'),
                "icon" => "fa fa-money-bill-alt"
            ];
            $this->userPushNotification($refer, 'REFFERAL_BONUS_COMMISSION', $msg, $action);

            $userId = $refer->id;
            $i++;
        }
        return 0;
    }


    /**
     * @param $user
     * @param $amount
     * @param $charge
     * @param $trx_type
     * @param $balance_type
     * @param $trx_id
     * @param $remarks
     */
    public function makeTransaction($user, $amount, $charge, $trx_type = null, $trx_id, $remarks = null): void
    {
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = getAmount($amount);
        $transaction->charge = $charge;
        $transaction->trx_type = $trx_type;
        $transaction->final_balance = $user->balance;
        $transaction->trx_id = $trx_id;
        $transaction->remarks = $remarks;
        $transaction->save();
    }
}
