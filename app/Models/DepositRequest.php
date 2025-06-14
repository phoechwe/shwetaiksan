<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepositRequest extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'account_name',
        'account_number',
        'bank_account_id',
        'admin_bank_name',
        'admin_bank_number',
        'working_number',
        'amount',
        'status',
        'created_at',
        'updated_at',
    ];
    public $hidden = [
        'admin_bank_name',
        'admin_bank_number',
        'working_number',
    ];
       public $casts =[
        'account_number' => 'string',
        'admin_bank_number' => 'integer',
        'amount' => 'integer',
    ];
           protected $appends = ['payment_type'];

    // 👇 Accessor to return fixed value
    public function getPaymentTypeAttribute()
    {
        return 1;
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function bankAccount(){
        return $this->belongsTo(BankAccount::class,'bank_account_id');
    }
}
