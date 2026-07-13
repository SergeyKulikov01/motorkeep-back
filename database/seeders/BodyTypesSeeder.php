<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BodyTypes;

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
            'convertible' => 'Кабриолет'
        ];

        foreach ($types as $type => $data) {
            BodyTypes::create([
                'name' => $data,
                'type' => $type,
            ]);
        }
    }
}
