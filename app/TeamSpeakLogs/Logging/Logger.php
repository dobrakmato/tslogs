<?php

namespace TeamSpeakLogs\Logging;

use Exception;

/**
 * Class Logger represents default console logger.
 *
 * @package OnlineBoard\Logging
 */
class Logger
{

    private static function writeln($str)
    {
        echo "$str" . PHP_EOL;
    }

    /**
     * Writes info level message to console log.
     *
     * @param string $msg message to write
     * @param Exception|null $exception exception
     */
    public static function info($msg, Exception $exception = null)
    {
        Logger::writeln(date('H:i:s') . " [INFO] $msg");
        if ($exception != null) {
            Logger::writeln(date('H:i:s') . " [INFO] $exception");
        }
    }

    /**
     * Writes warning level message to console log.
     *
     * @param string $msg message to write
     * @param Exception|null $exception exception
     */
    public static function warn($msg, Exception $exception = null)
    {
        Logger::writeln(date('H:i:s') . " [WARN] $msg");
        if ($exception != null) {
            Logger::writeln(date('H:i:s') . " [WARN] $exception");
        }
    }

    /**
     * Writes error level message to console log.
     *
     * @param string $msg message to write
     * @param Exception|null $exception exception
     */
    public static function error($msg, Exception $exception = null)
    {
        Logger::writeln(date('H:i:s') . " [ERROR] $msg");
        if ($exception != null) {
            Logger::writeln(date('H:i:s') . " [ERROR] $exception");
        }
    }
}