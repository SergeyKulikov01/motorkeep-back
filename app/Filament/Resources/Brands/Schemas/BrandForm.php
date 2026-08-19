<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Название')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('country_code')
                    ->label('Код страны')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
