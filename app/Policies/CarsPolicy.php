<?php

namespace App\Policies;

use App\Models\Cars;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CarsPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function view(User $user, Cars $cars){
        if ($user->id == $cars->user_id){
            return Response::allow();
        } else {
            return Response::denyAsNotFound();
        }
    }
}
