<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Color;

class Colors extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            'Белый' => '#FFFFFF',
            'Чёрный' => '#000000',
            'Серебристый' => '#C0C0C0',
            'Серый' => '#808080',
            'Синий' => '#0000FF',
            'Красный' => '#FF0000',
            'Зелёный' => '#008000',
            'Жёлтый' => '#FFD700',
            'Оранжевый' => '#FFA500',
            'Коричневый' => '#8B4513',
            'Фиолетовый' => '#800080',
            'Розовый' => '#FFC0CB',
            'Золотой' => '#FFD700',
            'Бежевый' => '#F5DEB3',
        ];

        foreach ($colors as $name => $hex) {
            Color::create([
                'name' => $name,
                'hex' => $hex,
            ]);
        }
    }
}
