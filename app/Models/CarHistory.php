<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CarHistory extends Model
{
    protected $casts = [
        'date' => 'date'
    ];
    protected $fillable = [
        'user_id',
        'car_id',
        'name',
        'file_id',
        'place',
        'volume',
        'mileage',
        'price',
        'date',
        'type',
        'comment',
    ];
}
