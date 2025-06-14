<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentRecord extends Model
{
    public $fillable = [
        'user_id',
        'amount',
        'account_name',
        'account_number',
        'number',
        'balance_type',
        'start_date'
    ];
    public $casts = [
        'account_number' => 'string',
    ];
    public  function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
