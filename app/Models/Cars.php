<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    protected $fillable = [
        'user_id',
        'brand_id',
        'car_model_id',
        'year',
        'body_type_id',
        'color',
        'engine_volume',
        'transmission_type',
        'vin',
        'plate_number',
        'plate_region',
        'mileage',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function model()
    {
        return $this->belongsTo(CarModel::class, 'car_model_id');
    }

    public function colorInfo()
    {
        return $this->belongsTo(Color::class, 'color');
    }

    public function bodyInfo()
    {
        return $this->belongsTo(BodyTypes::class, 'body_type_id');
    }

    public function history()
    {
        return $this->hasMany(CarHistory::class, 'car_id');
    }

    protected function mileageFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->mileage, 0, '', ' '),
        );
    }

    protected function yearSpend(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->history
                ->filter(fn ($record) => $record->date?->year === now()->year)
                ->sum('price'),
        );
    }
    protected function totalSpend(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->history->sum('price'),
        );
    }
    protected function monthsSpend(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->history
                ->filter(fn ($record) => $record->date?->month === now()->month)
                ->sum('price'),
        );
    }
    protected function diffPercentSpend(): Attribute
    {
        return Attribute::make(
            get: function () {
                $prevMonth = now()->subMonthNoOverflow();
                $prev = $this->history
                    ->filter(fn ($record) => $record->date?->year === $prevMonth->year && $record->date?->month === $prevMonth->month)
                    ->sum('price');

                if ($prev <= 0) {
                    return 0;
                }

                return round(($this->months_spend - $prev) / $prev * 100);
            },
        );
    }

    protected function yearSpendFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->year_spend, 0, '', ' '),
        );
    }
}
