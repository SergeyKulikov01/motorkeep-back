<?php

namespace Database\Seeders;

use App\Models\BodyTypes;
use Illuminate\Database\Seeder;

class BodyTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'sedan' => 'Седан',
            'hatchback' => 'Хечбек',
            'offroad' => 'Внедорожник',
            'coupe' => 'Купе',
            'wagon' => 'Универсал',
            'minivan' => 'Минивен',
            'pickup' => 'Пикап',
            'convertible' => 'Кабриолет',
        ];

        foreach ($types as $type => $data) {
            BodyTypes::create([
                'name' => $data,
                'type' => $type,
            ]);
        }
    }
}
