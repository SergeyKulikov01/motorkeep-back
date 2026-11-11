<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CarHistory;
use App\Models\Cars;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DetailCarController extends Controller
{
    public function index(Cars $car)
    {
        Gate::authorize('view', $car);

        $car->load(['brand', 'model', 'colorInfo', 'bodyInfo']);

        $currentYear = now()->year;
        $currentMonth = now()->month;
        $thisMonthHistory = 0;
        $history = CarHistory::where('car_id', $car->id)
            ->whereIn(DB::raw('YEAR(date)'), [$currentYear, $currentYear - 1])
            ->select('price','date')
            ->get();
        $thisYearTotal = 0;
        $prevYearTotal = 0;
        foreach ($history as $elem) {
            if ($elem->date->month == $currentMonth) {
                $thisMonthHistory++;
            }
            if ($elem->date->year == $currentYear) {
                $thisYearTotal += $elem->price;
            } else {
                $prevYearTotal += $elem->price;
            }
        }
        $diffPercent = 0;
        if ($prevYearTotal > 0){
            $diffPercent = ($thisYearTotal - $prevYearTotal)/$prevYearTotal * 100;
        }

        $mileagePercent = $car->mileage / 1000000 * 100;
        $data = [
            'car' => $car,
            'id' => $car->id,
            'mileagePercent' => $mileagePercent,
            'TotalSpend' => $thisYearTotal,
            'diffPercent' => (int) $diffPercent,
            'thisMonthHistoryCount' => (int) $thisMonthHistory,
        ];

        return view('pages.dashboard.detail.page', $data);
    }
}
