<?php

namespace App\Filament\Widgets;

use App\Models\CarHistory;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Psy\Readline\Interactive\Input\History;

class HistoryCount extends StatsOverviewWidget
{
    protected ?string $heading = 'Статистика';
    protected function getStats(): array
    {
        $history = CarHistory::all();

        $months = collect(range(6, 0))->map(fn (int $i) => now()->subMonths($i)->format('Y-m'));

        $grouped = $history->groupBy(fn (CarHistory $item) => $item->date->format('Y-m'));

        $chartData = $months
            ->map(fn (string $month) => $grouped->get($month, collect())->count())
            ->values()
            ->toArray();

        $currentMonthCount = $grouped->get(now()->format('Y-m'), collect())->count();
        $previousMonthCount = $grouped->get(now()->subMonth()->format('Y-m'), collect())->count();

        $diff = $currentMonthCount - $previousMonthCount;
        $percentChange = $previousMonthCount > 0
            ? round(($diff / $previousMonthCount) * 100)
            : ($currentMonthCount > 0 ? 100 : 0);

        $isIncrease = $diff >= 0;

        return [
            Stat::make('Всего записей', $history->count())
                ->description(($isIncrease ? '+' : '') . $percentChange . '% по сравнению с прошлым месяцем')
                ->descriptionIcon($isIncrease ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($isIncrease ? 'success' : 'danger')
                ->chart($chartData),
        ];
    }
}
