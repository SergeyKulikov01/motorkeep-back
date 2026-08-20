<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminders extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'car_id',
        'comment',
        'type',
        'date_of_exec',
        'cycle',
    ];

    public function car()
    {
        return $this->belongsTo(Cars::class, 'car_id');
    }
}
