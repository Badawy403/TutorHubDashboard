<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    use HasFactory;
    protected $table = "withdraw_requests";
    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'rejected_reason',
        'account_holder',
        'account_number',
        'bank',
        'additional_note'
    ];

    public static $Pending = 'pending';
    public static $Approved = 'approved';
    public static $Rejected = 'rejected';


    public function scopeWithAll($query)
    {
        return $query;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
