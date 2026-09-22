<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Reminders;
use App\Models\TotalHistory;
use App\Models\CarHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        try {
            $cars = Cars::with(['brand', 'model', 'history'])->where('user_id', auth()->id())->get();
            $history = TotalHistory::where('user_id', auth()->id())->orderBy('created_at', 'desc')->limit(10)->get()->toArray();
            foreach ($history as &$item) {
                switch ($item['action']) {
                    case 'add':
                        $item['action_text'] = 'Добавление';
                        break;
                    case 'edit':
                        $item['action_text'] = 'Обновление';
                        break;
                    case 'delete':
                        $item['action_text'] = 'Удаление';
                        break;
                }
                $createdAt = Carbon::parse($item['created_at']);
                $item['time_label'] = match (true) {
                    $createdAt->isToday() => 'Сегодня, ' . $createdAt->format('H:i'),
                    $createdAt->isYesterday() => 'Вчера, ' . $createdAt->format('H:i'),
                    default => $createdAt->format('d.m.Y, H:i'),
                };
            }
            $reminders = Reminders::where('user_id', auth()->id())->with('car.brand')->with('car.model')->get()->take(5);

            $data = [
                'cars' => $cars,
                'history' => $history,
                'reminders' => $reminders,
            ];
        } catch (Throwable $e) {
            Log::error($e->getMessage(),['text' => 'DashboardController index', 'exception' => $e]);
        }
        return view('pages.dashboard.index', $data);
    }

    public function carsList()
    {
        try {
            $cars = Cars::with(['brand', 'model', 'history'])->where('user_id', auth()->id())->get();
            $data = [
                'cars' => $cars,
            ];
        } catch (Throwable $e) {
            Log::error($e->getMessage(),['text' => 'DashboardController carlist', 'exception' => $e]);
        }
        return view('pages.dashboard.cars.page', $data);
    }

    public function statistic()
    {
        try {
            $cars = Cars::with(['brand', 'model', 'history'])->where('user_id', auth()->id())->get();
            $histories = CarHistory::where('user_id', auth()->id())
                ->whereYear('date', Carbon::now()->year)
                ->orderByDesc('price')
                ->get();
            $history = [];
            foreach ($histories as $item) {
                $month = (int) Carbon::parse($item['date'])->format('n');
                $history[$month] = ($history[$month] ?? 0) + $item->price;
            }
            $averageSpend = !empty($history) ? array_sum($history) / count($history) : 0;
            $data = [
                'cars' => $cars,
                'history' => $history,
                'averageSpend' => $averageSpend,
                'historyList' => $histories,
            ];
        } catch (Throwable $e) {
            Log::error($e->getMessage(),['text' => 'DashboardController statistic', 'exception' => $e]);
        }
        return view('pages.dashboard.stats.page',$data);
    }
}
