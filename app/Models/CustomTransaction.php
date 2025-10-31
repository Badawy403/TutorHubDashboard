<?php

namespace App\Models;
use Bavix\Wallet\Models\Transaction;

class CustomTransaction extends Transaction
{
    protected $table = "transactions";
    protected $guarded = ['id'];
    public function fund()
    {
        return $this->hasOne(Fund::class,'transaction_id');
    }
}
