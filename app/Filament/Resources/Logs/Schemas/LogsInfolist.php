<?php

namespace App\Filament\Resources\Logs\Schemas;
use Filament\Infolists;
use Filament\Schemas\Schema;

class LogsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Infolists\Components\TextEntry::make('id'),
                Infolists\Components\TextEntry::make('level')
                    ->color(fn (string $state): string => match (strtoupper($state)) {
                        'EMERGENCY', 'CRITICAL', 'ALERT' => 'danger',
                        'ERROR' => 'danger',
                        'WARNING' => 'warning',
                        'NOTICE', 'INFO' => 'info',
                        'DEBUG' => 'gray',
                        default => 'gray',
                    })
                    ->badge()
                    ->label('Уровень')
                ,
                Infolists\Components\TextEntry::make('message')
                    ->label('Сообщение')
                ,
                Infolists\Components\TextEntry::make('context')->label('Контекст')
                    ->getStateUsing(fn ($record): string => is_array($record->context)
                        ? json_encode($record->context, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
                        : (string) $record->context)
                    ->extraAttributes(['style' => 'white-space: pre-wrap; word-break: break-all; font-family: monospace'])
                ,
                Infolists\Components\TextEntry::make('created_at')->label('Создано')
            ]);
    }
}
