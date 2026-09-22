<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('level','message','context')]
class Logs extends Model
{
    protected $casts = [
        'context' => 'array',
    ];
}
