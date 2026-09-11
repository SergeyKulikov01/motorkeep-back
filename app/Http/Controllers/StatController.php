<?php

namespace App\Http\Controllers;

use App\Models\CarHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function getStat(Request $request)
    {
        $period = $request->input('period', 'all');
        $end = Carbon::now();

        // Границы текущего периода и «зеркального» предыдущего периода той же длины
        switch ($period) {
            case 'week':
                $currentStart = $end->copy()->subWeek();
                $previousStart = $end->copy()->subWeeks(2);
                $previousEnd = $end->copy()->subWeek();
                break;
            case 'year':
                $currentStart = $end->copy()->subYear();
                $previousStart = $end->copy()->subYears(2);
                $previousEnd = $end->copy()->subYear();
                break;
            case 'all':
                $currentStart = $end->copy()->subYears(99);
                $previousStart = null;
                $previousEnd = null;
                break;
            case 'month':
            default:
                $currentStart = $end->copy()->subMonth();
                $previousStart = $end->copy()->subMonths(2);
                $previousEnd = $end->copy()->subMonth();
                break;
        }

        $row = $this->fetchAggregatedStats($currentStart, $end, $previousStart, $previousEnd);

        $data = [];
        foreach (['allPay', 'fuel', 'service', 'buy'] as $key) {
            $current = (float) $row->{$key.'_current'};
            $previous = (float) $row->{$key.'_previous'};
            $data[$key] = $current;
            $data[$key.'Diff'] = $this->percentDiff($current, $previous);
        }

        return $data;
    }

    /**
     * Суммы за текущий и предыдущий периоды одним запросом
     * (условная агрегация вместо двух отдельных выборок + подсчёта в PHP).
     */
    private function fetchAggregatedStats(Carbon $currentStart, Carbon $end, ?Carbon $previousStart, ?Carbon $previousEnd): object
    {
        // type-условия жёстко заданы здесь же, в SQL не попадают никакие пользовательские данные
        $metrics = [
            'allPay' => '1=1',
            'fuel' => "type = 'fuel'",
            'service' => "(type = 'repair' OR type = 'service')",
            'buy' => "type = 'buy'",
        ];

        $select = [];
        $bindings = [];

        foreach ($metrics as $key => $condition) {
            $select[] = "COALESCE(SUM(CASE WHEN date BETWEEN ? AND ? AND ($condition) THEN price ELSE 0 END), 0) as {$key}_current";
            $bindings[] = $currentStart;
            $bindings[] = $end;

            if ($previousStart) {
                $select[] = "COALESCE(SUM(CASE WHEN date BETWEEN ? AND ? AND ($condition) THEN price ELSE 0 END), 0) as {$key}_previous";
                $bindings[] = $previousStart;
                $bindings[] = $previousEnd;
            } else {
                $select[] = "0 as {$key}_previous";
            }
        }

        return CarHistory::where('user_id', auth()->id())
            ->where('date', '>=', $previousStart ?? $currentStart)
            ->selectRaw(implode(', ', $select), $bindings)
            ->first();
    }

    /**
     * Процент изменения текущего значения относительно предыдущего.
     * null, если сравнивать не с чем (период 'all').
     */
    private function percentDiff(float $current, float $previous): ?float
    {
        if ($previous == 0.0) {
            return $current == 0.0 ? 0.0 : 100.0;
        }

        return round((($current - $previous) / $previous) * 100, 1);
    }
}
