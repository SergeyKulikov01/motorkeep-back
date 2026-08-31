<?php

namespace App\Models;

use App\Events\HistoryAdded;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;


class CarHistory extends Model
{
    protected $casts = [
        'date' => 'date'
    ];
    protected $fillable = [
        'user_id',
        'car_id',
        'name',
        'file_id',
        'place',
        'volume',
        'mileage',
        'price',
        'date',
        'type',
        'comment',
    ];
    protected $dispatchesEvents = [
        'created' => HistoryAdded::class,
    ];
    protected static function booted(): void
    {
        static::updated(fn (self $model) => HistoryAdded::dispatch($model, 'edit'));
        static::deleted(fn (self $model) => HistoryAdded::dispatch($model, 'delete'));
    }
    public function car()
    {
        return $this->belongsTo(Cars::class, 'car_id');
    }
    protected function readableType(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->type) {
                'service' => 'Сервис',
                'repair' => 'Ремонт',
                'buy' => 'Покупка',
                'fuel' => 'Заправка',
                default => null,
            },
        );
    }
    protected function labelColor(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->type) {
                'service' => '--mk-c-service',
                'repair' => '--mk-c-repair',
                'buy' => '--mk-c-buy',
                'fuel' => '--mk-c-fuel',
                default => null,
            },
        );
    }
}
