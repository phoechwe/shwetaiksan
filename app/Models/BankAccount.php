<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use SoftDeletes;
    public $fillable = [
        'account_number',
        'bank_type',
        'bank_name',
        'youtube_link',
    ];

     public $casts = [
        'account_number' => 'string',
    ];
}
