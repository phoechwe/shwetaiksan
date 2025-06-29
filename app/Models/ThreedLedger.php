<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThreedLedger extends Model
{
    public $table = 'threed_ledgers';
    protected $fillable = [
        'start_date',
        'end_date',
        'end_time',
        'amount',
        'status',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'amount' => 'integer',
    ];
    public function threedLedgerNumbers()
    {
        return $this->hasMany(ThreedLedgerNumber::class, 'threed_ledger_id');
    }
}
