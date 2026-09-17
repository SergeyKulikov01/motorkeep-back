<?php

namespace App\Filament\Resources\Logs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('level')
                    ->label('Уровень')
                    ->searchable()
                    ->sortable()
                    ->color(fn (string $state): string => match (strtoupper($state)) {
                        'EMERGENCY', 'CRITICAL', 'ALERT' => 'danger',
                        'ERROR' => 'danger',
                        'WARNING' => 'warning',
                        'NOTICE', 'INFO' => 'info',
                        'DEBUG' => 'gray',
                        default => 'gray',
                    })->badge(),
                TextColumn::make('context')
                    ->label('Контекст')
                    ->getStateUsing(fn ($record): string => is_array($record->context)
                        ? json_encode($record->context, JSON_UNESCAPED_UNICODE)
                        : (string) $record->context)
                    ->limit(50),
                TextColumn::make('message')
                    ->label('Сообщение')
                    ->searchable()
                    ->limit(50)
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Создано')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
