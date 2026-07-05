<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'country_code'];

    public function carModels()
    {
        return $this->hasMany(CarModel::class);
    }
}
