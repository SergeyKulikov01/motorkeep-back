<?php

namespace App\Listeners;

use App\Events\HistoryAdded;
use App\Models\Cars;
use App\Models\TotalHistory;

class FillTotalHistory
{
    /**
     * Create the event listener.
     */

    /**
     * Handle the event.
     */
    private function resolveDescription(string $str): string
    {
        $str = match ($str) {
            'service' => 'Запись о сервисе',
            'repair' => 'Запись о поломке',
            'buy' => 'Покупка',
            'fuel' => 'Заправка',
            'note' => 'Заметка',

        };
        $str .= ' для';
        return $str;
    }
    public function handle(HistoryAdded $event): void
    {
        $str = $this->resolveDescription($event->carHistory->type);
        $car = Cars::where('user_id', $event->carHistory->user_id)->where('id',$event->carHistory->car_id)->get()->first();
        $str .= ' <strong>' .$car->brand->name . ' ' . $car->model->name . '</strong>';
        TotalHistory::create([
            'user_id' => $event->carHistory->user_id,
            'car_id' => $event->carHistory->car_id,
            'action' => $event->action,
            'action_type' => $event->carHistory->type,
            'description' => $str,
        ]);
    }
}
