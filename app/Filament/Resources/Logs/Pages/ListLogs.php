<?php

namespace App\Filament\Resources\Logs\Pages;

use App\Filament\Resources\Logs\LogsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListLogs extends ListRecords
{
    protected static string $resource = LogsResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
    public function getTabs(): array
    {
        return [
            'Все' => Tab::make(),
            'Инфо' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->whereIn('level', ['INFO','DEBUG','NOTICE'])),
            'Ошибка' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->whereIn('level', ['ERROR','WARNING'])),
            'Критическая ошибка' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->whereIn('level', ['EMERGENCY', 'CRITICAL', 'ALERT',])),
        ];
    }
}
