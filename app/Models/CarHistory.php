<?php

namespace App\Models;

use App\Events\HistoryAdded;
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
}
