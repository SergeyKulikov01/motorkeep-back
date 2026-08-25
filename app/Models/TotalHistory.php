<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id','car_id','action','action_type','description'])]
#[Table(name: 'total_history')]
class TotalHistory extends Model
{
    //
}
