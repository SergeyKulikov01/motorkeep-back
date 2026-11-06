<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // brands.name уникален — без unique() две машины в одном тесте упадут
            'name' => fake()->unique()->company(),
            'country_code' => fake()->countryCode(),
        ];
    }
}
