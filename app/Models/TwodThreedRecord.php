<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwodThreedRecord extends Model
{
    public $fillable = [
        'user_id',
        'number',
        'type', // '2D' or '3D'
        'amount',
        'status', // 'pending', 'completed', 'failed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function twodLedgerNumbers()
    {
        return $this->hasMany(TwodLedgerNumber::class);
    }
}
