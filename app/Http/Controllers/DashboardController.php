<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Cars;

class DashboardController extends Controller
{
    public function index()
    {
        $cars = Cars::with(['brand', 'model'])->where('user_id', auth()->id())->get();
        $data = [
            'cars' => $cars,
        ];

        return view('pages.dashboard.index', $data);
    }
}
