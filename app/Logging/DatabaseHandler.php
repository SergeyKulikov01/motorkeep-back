<?php
namespace App\Logging;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;
use App\Models\Logs;

class DatabaseHandler extends AbstractProcessingHandler
{
    protected function write(LogRecord $record): void
    {
        try {
            Logs::create([
                'level' => $record->level->getName(),
                'message' => $record->message,
                'context' => $record->context,
            ]);
        } catch (\Throwable) {
            // Ошибку записи лога в БД нельзя логировать через этот же канал —
            // иначе повторный вызов write() уйдёт в бесконечную рекурсию.
        }
    }
}
