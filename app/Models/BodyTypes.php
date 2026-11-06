<?php

namespace App\Models;

use Database\Factories\BodyTypesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyTypes extends Model
{
    /** @use HasFactory<BodyTypesFactory> */
    use HasFactory;

    protected $fillable = ['name', 'type'];
}
