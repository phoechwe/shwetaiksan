<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Twodnumber extends Model
{
    use SoftDeletes;
    public $table = 'twodnumbers';
    public $fillable = [
        'number',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'number' => 'string',
    ];

    public function twodledgers()
    {
        return $this->hasMany(Twodledger::class, 'twodnumber_id');
    }
}
