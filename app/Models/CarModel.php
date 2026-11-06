<?php

namespace App\Models;

use Database\Factories\CarModelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    /** @use HasFactory<CarModelFactory> */
    use HasFactory;

    protected $fillable = ['brand_id', 'name'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
