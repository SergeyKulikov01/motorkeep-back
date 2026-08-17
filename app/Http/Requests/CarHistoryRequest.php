<?php

namespace App\Http\Requests;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarHistoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'car_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'place' => ['nullable', 'string', 'max:255'],
            'volume' => ['nullable', 'numeric'],
            'mileage' => ['nullable', 'integer', 'min:0', $this->mileageNotLessThanCarMileage()],
            'price' => ['nullable', 'integer', 'min:0'],
            'date' => ['required', 'date'],
            'type' => ['required', Rule::in(['service', 'repair', 'buy', 'fuel', 'note'])],
            'comment' => ['nullable', 'string'],
        ];
    }

    private function mileageNotLessThanCarMileage(): Closure
    {
        return function (string $attribute, mixed $value, Closure $fail) {
            $car = $this->user()->cars()->find($this->input('car_id'));

            if ($car && (int) $value < (int) $car->mileage) {
                $fail("Пробег не может быть меньше текущего пробега автомобиля ($car->mileage км).");
            }
        };
    }
}
