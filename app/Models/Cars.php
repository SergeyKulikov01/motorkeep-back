<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    protected $fillable = [
        'user_id',
        'brand_id',
        'car_model_id',
        'year',
        'body_type_id',
        'color',
        'engine_volume',
        'transmission_type',
        'vin',
        'plate_number',
        'plate_region',
        'mileage',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function model()
    {
        return $this->belongsTo(CarModel::class, 'car_model_id');
    }
}
