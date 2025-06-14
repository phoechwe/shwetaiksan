<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Type\Integer;

class Withdrawl extends Model
{
    public $table = 'with_drawls';
    public $fillable =[
        'user_id',
        'account_name',
        'account_number',
        'bank_account_id',
        'amount'
    ];
     public $hidden =[
        'bank_type'
    ];

    public $casts =[
        'account_number' => 'string',
        'bank_account_id' => 'integer',
    ];
        protected $appends = ['payment_type'];

    // 👇 Accessor to return fixed value
    public function getPaymentTypeAttribute()
    {
        return 2;
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class,'bank_account_id');
    }
}
