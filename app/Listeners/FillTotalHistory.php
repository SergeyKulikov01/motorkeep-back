<?php

namespace App\Listeners;

use App\Events\HistoryAdded;
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
        TotalHistory::create([
            'user_id' => $event->carHistory->user_id,
            'car_id' => $event->carHistory->car_id,
            'action' => $event->action,
            'action_type' => $event->carHistory->type,
            'description' => $this->resolveDescription($event->carHistory->type),
        ]);
    }
}
