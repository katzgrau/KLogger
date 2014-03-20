<?php
namespace Katzgrau\KLogger;

use DateTime;
use RuntimeException;
use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

/**
 * Finally, a light, permissions-checking logging class.
 *
 * Originally written for use with wpSearch
 *
 * Usage:
 * $log = new Katzgrau\KLogger\Logger('/var/log/', Psr\Log\LogLevel::INFO);
 * $log->info('Returned a million search results'); //Prints to the log file
 * $log->error('Oh dear.'); //Prints to the log file
 * $log->debug('x = 5'); //Prints nothing due to current severity threshhold
 *
 * @author  Kenny Katzgrau <katzgrau@gmail.com>
 * @since   July 26, 2008 — Last update July 1, 2012
 * @link    http://codefury.net
 * @version 0.2.0
 */

/**
 * Class documentation
 */
class Logger extends AbstractLogger
{
    /**
     * Path to the log file
     * @var string
     */
    private $logFilePath = null;

    /**
     * Current minimum logging threshold
     * @var integer
     */
    private $logLevelThreshold = LogLevel::DEBUG;

    private $logLevels = array(
        LogLevel::EMERGENCY => 0,
        LogLevel::ALERT     => 1,
        LogLevel::CRITICAL  => 2,
        LogLevel::ERROR     => 3,
        LogLevel::WARNING   => 4,
        LogLevel::NOTICE    => 5,
        LogLevel::INFO      => 6,
        LogLevel::DEBUG     => 7,
    );

    /**
     * This holds the file handle for this instance's log file
     * @var resource
     */
    private $fileHandle = null;

    /**
     * Valid PHP date() format string for log timestamps
     * @var string
     */
    private $dateFormat = 'Y-m-d G:i:s.u';

    /**
     * Octal notation for default permissions of the log file
     * @var integer
     */
    private $defaultPermissions = 0777;

    /**
     * Class constructor
     *
     * @param string  $logDirectory       File path to the logging directory
     * @param integer $logLevelThreshold  The LogLevel Threshold
     * @return void
     */
    public function __construct($logDirectory, $logLevelThreshold = LogLevel::DEBUG)
    {
        $this->logLevelThreshold = $logLevelThreshold;

        $logDirectory = rtrim($logDirectory, '\\/');
        if (! file_exists($logDirectory)) {
            mkdir($logDirectory, $this->defaultPermissions, true);
        }

        $this->logFilePath = $logDirectory.DIRECTORY_SEPARATOR.'log_'.date('Y-m-d').'.txt';
        if (file_exists($this->logFilePath) && !is_writable($this->logFilePath)) {
            throw new RuntimeException('The file could not be written to. Check that appropriate permissions have been set.');
        }
        
        $this->fileHandle = fopen($this->logFilePath, 'a');
        if ( ! $this->fileHandle) {
            throw new RuntimeException('The file could not be opened. Check permissions.');
        }
    }

    /**
     * Class destructor
     */
    public function __destruct()
    {
        if ($this->fileHandle) {
            fclose($this->fileHandle);
        }
    }

    /**
     * Sets the date format used by all instances of KLogger
     * 
     * @param string $dateFormat Valid format string for date()
     */
    public function setDateFormat($dateFormat)
    {
        $this->dateFormat = $dateFormat;
    }

    /**
     * Sets the Log Level Threshold
     * 
     * @param string $dateFormat Valid format string for date()
     */
    public function setLogLevelThreshold($logLevelThreshold)
    {
        $this->logLevelThreshold = $logLevelThreshold;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        if ($this->logLevels[$this->logLevelThreshold] < $this->logLevels[$level]) {
            return;
        }
        $message = $this->formatMessage($level, $message, $context);        
        $this->write($message);
    }

    /**
     * Writes a line to the log without prepending a status or timestamp
     *
     * @param string $line Line to write to the log
     * @return void
     */
    public function write($message)
    {
        if (! is_null($this->fileHandle)) {
            if (fwrite($this->fileHandle, $message) === false) {
                throw new RuntimeException('The file could not be written to. Check that appropriate permissions have been set.');
            }
        }
    }

    /**
     * Formats the message for logging.
     *
     * @param  string $level   The Log Level of the message
     * @param  string $message The message to log
     * @param  array  $context The context
     * @return string
     */
    private function formatMessage($level, $message, $context)
    {
        $level = strtoupper($level);
        if (! empty($context)) {
            $message .= PHP_EOL.$this->indent($this->contextToString($context));
        }
        return "[{$this->getTimestamp()}] [{$level}] {$message}".PHP_EOL;
    }

    /**
     * Gets the correctly formatted Date/Time for the log entry.
     * 
     * PHP DateTime is dump, and you have to resort to trickery to get microseconds
     * to work correctly, so here it is.
     * 
     * @return string
     */
    private function getTimestamp()
    {
        $originalTime = microtime(true);
        $micro = sprintf("%06d", ($originalTime - floor($originalTime)) * 1000000);
        $date = new DateTime(date('Y-m-d H:i:s.'.$micro, $originalTime));

        return $date->format($this->dateFormat);
    }

    /**
     * Takes the given context and coverts it to a string.
     * 
     * @param  array $context The Context
     * @return string
     */
    private function contextToString($context)
    {
        $export = '';
        foreach ($context as $key => $value) {
            $export .= "{$key}: ";
            $export .= preg_replace(array(
                '/=>\s+([a-zA-Z])/im',
                '/array\(\s+\)/im',
                '/^  |\G  /m',
            ), array(
                '=> $1',
                'array()',
                '    ',
            ), str_replace('array (', 'array(', var_export($value, true)));
            $export .= PHP_EOL;
        }
        return str_replace(array('\\\\', '\\\''), array('\\', '\''), rtrim($export));
    }

    /**
     * Indents the given string with the given indent.
     * 
     * @param  string $string The string to indent
     * @param  string $indent What to use as the indent.
     * @return string
     */
    private function indent($string, $indent = '    ')
    {
        return $indent.str_replace("\n", "\n".$indent, $string);
    }
}
