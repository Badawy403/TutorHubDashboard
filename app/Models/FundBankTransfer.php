<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundBankTransfer extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "fund_bank_transfers";
    protected $fillable = ['bank_account_id', 'fund_id', 'date','is_fund','attachment', 'deleted_at'];

    public function scopeWithAll($query)
    {
        return $query->with(['bank_account','fund']);
    }
   public function bank_account(){
    return $this->belongsTo(BankAccount::class);
   }
   public function fund(){
    return $this->belongsTo(Fund::class);
   }

}
