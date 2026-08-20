<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Reminders;
use App\Models\TotalHistory;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $cars = Cars::with(['brand', 'model', 'history'])->where('user_id', auth()->id())->get();
        $history = TotalHistory::where('user_id', auth()->id())->get()->toArray();
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
        $reminders = Reminders::where('user_id', auth()->id())->with('car.brand')->with('car.model')->get();

        $data = [
            'cars' => $cars,
            'history' => $history,
            'reminders' => $reminders,
        ];

        return view('pages.dashboard.index', $data);
    }
}
