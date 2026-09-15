<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id','gender','about','date_birth','phone','service_period','oil_period','change_tyre_notify','summer_tyre','winter_tyre','notify_next_service','notify_oil_change','notify_tyres_change','notify_change_breakes','stats_week','stats_months','notify_email','notify_push','notify_telegram'])]
class UserSettings extends Model
{
    //
}
