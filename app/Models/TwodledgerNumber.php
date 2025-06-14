<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TwodledgerNumber extends Model
{
    use SoftDeletes;
    public $table = 'twodledger_numbers';
    public $fillable = [
        'two_d_ledger_id',
        'two_d_number_id',
        'amount',
        'date',
        'user_id',
        'isPaid',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $hidden = [
        'isPaid'
    ];
    public function twodnumber()
    {
        return $this->belongsTo(Twodnumber::class, 'two_d_number_id');
    }
    public function twodledger()
    {
        return $this->belongsTo(Twodledger::class, 'two_d_ledger_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
