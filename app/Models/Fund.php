<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fund extends Model
{
    use HasFactory, SoftDeletes ;
    protected $guarded = ['id'];
    protected $table = "funds";


    protected $casts = [
        'detail' => 'object'
    ];
    public function scopeWithAll($query){
        return $query->with(['user','appointment','fund_bank_transfers']);
    }
    public function scopeWithChildren($query){
        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function fund_bank_transfers(){
        return $this->hasOne(FundBankTransfer::class);
    }

    public function appointment()
    {
        return $this->hasOne(BookAppointment::class,'fund_id');
    }

    public function gateway()
    {
        return $this->belongsTo(Gateway::class, 'gateway_id');
    }
}
