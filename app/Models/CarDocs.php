<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name','car_id','user_id','type','date','comment'])]
class CarDocs extends Model
{
    //
}
