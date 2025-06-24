<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThreedLedgerNumber extends Model
{
    use SoftDeletes;
    public $table = 'threed_ledger_numbers';
    public $fillable = [
        'threed_ledger_id',
        'threed_number_id',
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
    public function threedNumber()
    {
        return $this->belongsTo(ThreedNumber::class, 'threed_number_id');
    }
    public function threedLedger()
    {
        return $this->belongsTo(ThreedLedger::class, 'threed_ledger_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
