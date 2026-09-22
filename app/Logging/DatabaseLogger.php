<?php

namespace App\Logging;

use Monolog\Logger;

class DatabaseLogger
{
    /**
     * Создать экземпляр собственного регистратора Monolog.
     */
    public function __invoke(array $config): Logger
    {
        return new Logger('database', [new DatabaseHandler()]);
    }
}
