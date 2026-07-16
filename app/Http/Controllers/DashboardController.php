<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $cars = Cars::with(['brand','model'])->where('user_id', auth()->id())->get();
        $data = [
            'cars' => $cars
        ];
        return view('pages.dashboard.index',$data);
    }
}
