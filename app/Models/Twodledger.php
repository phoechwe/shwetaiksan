<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Twodledger extends Model
{
    public $table = 'two_d_ledgers';
    public  $fillable =[
        'date',
        'session_time',
        'amount',
        'start_time',
        'end_time',
        'isPaid',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public $hidden = [
        'isPaid'
    ];
    public function twodledgerNumbers()
    {
        return $this->hasMany(TwodledgerNumber::class, 'two_d_ledger_id');
    }
}
