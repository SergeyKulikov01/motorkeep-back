<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotes extends Model
{
    protected $fillable = [
        'name',
        'comment',
        'user_id',
        'car_id',
    ];
}
