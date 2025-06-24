<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThreedNumber extends Model
{
    use SoftDeletes;
    public $table = 'threed_numbers';
    public $fillable = [
        'number',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'number' => 'string',
    ];

    public function threedLedgers()
    {
        return $this->hasMany(ThreedLedger::class, 'threed_number_id');
    }
}
