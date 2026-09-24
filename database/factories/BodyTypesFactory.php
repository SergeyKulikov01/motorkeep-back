<?php

namespace Database\Factories;

use App\Models\BodyTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BodyTypes>
 */
class BodyTypesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Те же пары, что в BodyTypesSeeder
        [$type, $name] = fake()->randomElement([
            ['sedan', 'Седан'],
            ['hatchback', 'Хечбек'],
            ['offroad', 'Внедорожник'],
            ['wagon', 'Универсал'],
        ]);

        return [
            'type' => $type,
            'name' => $name,
        ];
    }
}
