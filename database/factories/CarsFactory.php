<?php

namespace Database\Factories;

use App\Models\BodyTypes;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Cars;
use App\Models\Color;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Cars>
 */
class CarsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            // brand_id должен стоять выше car_model_id: атрибуты вычисляются по порядку,
            // и в замыкание приходит уже готовый id марки
            'brand_id' => Brand::factory(),
            'car_model_id' => fn (array $attributes) => CarModel::factory()->create([
                'brand_id' => $attributes['brand_id'],
            ])->id,
            'year' => fake()->numberBetween(1980, (int) date('Y')),
            'body_type_id' => BodyTypes::factory(),
            // cars.color хранит id из таблицы colors (см. Cars::colorInfo)
            'color' => Color::factory(),
            'engine_volume' => fake()->randomFloat(1, 1, 6),
            'transmission_type' => fake()->randomElement(['manual', 'automatic', 'robot', 'variator']),
            // В VIN не бывает букв I, O, Q
            'vin' => fake()->unique()->regexify('[A-HJ-NPR-Z0-9]{17}'),
            // В российских номерах только 12 букв, совпадающих с латиницей
            'plate_number' => fake()->regexify('[ABEKMHOPCTYX][0-9]{3}[ABEKMHOPCTYX]{2}'),
            'plate_region' => (string) fake()->numberBetween(10, 799),
            'mileage' => fake()->numberBetween(0, 300000),
            'comment' => fake()->optional()->sentence(),
            'report_id' => fn (array $attributes) => $attributes['user_id'].'-'
                .CarModel::find($attributes['car_model_id'])->name.'-'
                .Str::random(8),
        ];
    }

    /**
     * Машина без VIN и госномера — пользователь их не указал.
     */
    public function withoutDocuments(): static
    {
        return $this->state(fn (array $attributes) => [
            'vin' => null,
            'plate_number' => null,
            'plate_region' => null,
        ]);
    }
}
