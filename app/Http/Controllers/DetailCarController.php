<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Illuminate\Http\Request;

class DetailCarController extends Controller
{
    public function index(int $id){
        $car = Cars::with(['brand','model'])->where('user_id', auth()->id())->where('id', $id)->firstOrFail();
        echo '<pre>';
        print_r($car->mileage);
        echo '</pre>';
        $mileagePercent = $car->mileage / 1000000 * 100;
        $data = [
            'car' => $car,
            'id' => $id,
            'mileagePercent' => $mileagePercent,
        ];
        return view('pages.dashboard.detail.page',$data);
    }
}
