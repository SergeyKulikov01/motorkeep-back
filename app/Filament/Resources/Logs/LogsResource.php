<?php

namespace App\Filament\Resources\Logs;

use App\Filament\Resources\Logs\Pages\CreateLogs;
use App\Filament\Resources\Logs\Pages\EditLogs;
use App\Filament\Resources\Logs\Pages\ListLogs;
use App\Filament\Resources\Logs\Pages\ViewLogs;
use App\Filament\Resources\Logs\Schemas\LogsForm;
use App\Filament\Resources\Logs\Schemas\LogsInfolist;
use App\Filament\Resources\Logs\Tables\LogsTable;
use App\Models\Logs;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LogsResource extends Resource
{
    protected static ?string $model = Logs::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog6Tooth;

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Логи';
    protected static ?string $modelLabel = 'Лог';
    protected static ?string $pluralModelLabel = 'Логи';
    protected static string|null|\UnitEnum $navigationGroup = 'Настройки';

    public static function form(Schema $schema): Schema
    {
        return LogsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LogsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LogsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLogs::route('/'),
            'create' => CreateLogs::route('/create'),
            'view' => ViewLogs::route('/{record}'),
            'edit' => EditLogs::route('/{record}/edit'),
        ];
    }
}
