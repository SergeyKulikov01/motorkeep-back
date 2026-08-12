<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Cars;

class DetailCarController extends Controller
{
    public function index(int $id)
    {
        $car = Cars::with(['brand', 'model', 'colorInfo', 'bodyInfo'])->where('user_id', auth()->id())->where('id', $id)->firstOrFail();
        $mileagePercent = $car->mileage / 1000000 * 100;
        $data = [
            'car' => $car,
            'id' => $id,
            'mileagePercent' => $mileagePercent,
        ];

        return view('pages.dashboard.detail.page', $data);
    }
}
