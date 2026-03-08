<?php declare(strict_types=1);

namespace App\Services;

/**
 * Simple logger service.
 *
 * Writes messages to logs/app.log
 * Automatically creates the logs directory if it does not exist.
 */
class Logger
{
    /**
     * @param string $message
     * @return void
     */
    public static function log(string $message): void
    {
        $logDir = __DIR__ . '/../../logs';
        $logFile = $logDir . '/app.log';

        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }

        $time = date('Y-m-d H:i:s');

        file_put_contents(
            $logFile,
            "[$time] $message\n",
            FILE_APPEND
        );
    }
}