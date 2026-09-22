<?php
namespace App\Logging;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;
use App\Models\Logs;
use Throwable;

class DatabaseHandler extends AbstractProcessingHandler
{
    protected function write(LogRecord $record): void
    {
        try {
            Logs::create([
                'level' => $record->level->getName(),
                'message' => $record->message,
                'context' => $this->normalizeContext($record->context),
            ]);
        } catch (\Throwable) {
            // Ошибку записи лога в БД нельзя логировать через этот же канал —
            // иначе повторный вызов write() уйдёт в бесконечную рекурсию.
        }
    }

    /**
     * Throwable нельзя сохранить в JSON как есть (получится `{}`), поэтому раскладываем его
     * на данные и полный stacktrace, включая цепочку previous.
     */
    private function normalizeContext(array $context): array
    {
        foreach ($context as $key => $value) {
            if ($value instanceof Throwable) {
                $context[$key] = $this->normalizeThrowable($value);
            }
        }

        return $context;
    }

    private function normalizeThrowable(Throwable $e): array
    {
        $data = [
            'class' => $e::class,
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'file' => $e->getFile().':'.$e->getLine(),
            'trace' => explode("\n", $e->getTraceAsString()),
        ];

        if ($e->getPrevious() !== null) {
            $data['previous'] = $this->normalizeThrowable($e->getPrevious());
        }

        return $data;
    }
}
