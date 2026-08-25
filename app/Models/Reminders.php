<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Reminders extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'car_id',
        'comment',
        'type',
        'date_of_exec',
        'cycle',
    ];

    protected $casts = [
        'date_of_exec' => 'date',
    ];

    public function car()
    {
        return $this->belongsTo(Cars::class, 'car_id');
    }

    /**
     * Модификатор для .mk-reminder-item--{status} в зависимости от даты выполнения:
     * overdue — срок уже прошёл, urgent — осталось 3 дня или меньше, иначе — пусто.
     */
    protected function statusClass(): Attribute
    {
        return Attribute::make(
            get: function () {
                $execDate = $this->date_of_exec->copy()->startOfDay();
                $today = now()->startOfDay();

                return match (true) {
                    $execDate->lt($today) => 'overdue',
                    $today->diffInDays($execDate, true) <= 3 => 'urgent',
                    default => '',
                };
            },
        );
    }
}
