<?php

use Katzgrau\KLogger\Logger;
use Psr\Log\LogLevel;

class LoggerTest extends PHPUnit_Framework_TestCase
{
    private $logPath;

    private $logger;
    private $errLogger;
    private $hostNameLogger;
    private $appNameLogger;

    public function setUp()
    {
        $this->logPath = __DIR__.'/logs';
        $this->logger = new Logger($this->logPath, LogLevel::DEBUG, array ('flushFrequency' => 1));
        $this->errLogger = new Logger($this->logPath, LogLevel::ERROR, array (
            'extension' => 'log',
            'prefix' => 'error_',
            'flushFrequency' => 1
        ));
        $this->hostNameLogger = new Logger($this->logPath, LogLevel::DEBUG, array (
            'hostname' => gethostname(),
            'extension' => 'log',
            'prefix' => 'hostname_logger_'
        ));
        $this->appNameLogger = new Logger($this->logPath, LogLevel::DEBUG, array (
            'appname' => 'LoggerTEst',
            'extension' => 'log',
            'prefix' => 'appname_logger_'
        ));
    }

    public function testImplementsPsr3LoggerInterface()
    {
        $this->assertInstanceOf('Psr\Log\LoggerInterface', $this->logger);
    }

    public function testAcceptsExtension()
    {
        $this->assertStringEndsWith('.log', $this->errLogger->getLogFilePath());
    }

    public function testAcceptsPrefix()
    {
        $filename = basename($this->errLogger->getLogFilePath());
        $this->assertStringStartsWith('error_', $filename);
    }

    public function testGetHostname()
    {
        $this->assertNull(null, $this->logger->getHostname());
        $this->assertNull(null, $this->hostNameLogger->getHostname());
    }

    public function testGetAppName()
    {
        $this->assertNull(null, $this->logger->getAppName());
        $this->assertNull(null, $this->hostNameLogger->getAppName());
    }

    public function testWritesBasicLogs()
    {
        $this->logger->log(LogLevel::DEBUG, 'This is a test for a plain logger');
        $this->errLogger->log(LogLevel::ERROR, 'This is a test for the ERROR logger');
        $this->hostNameLogger->log(LogLevel::DEBUG, 'This is a test for the hostname logger');
        $this->appNameLogger->log(LogLevel::DEBUG, 'This is a test for the appname logger');

        $this->assertTrue(file_exists($this->logger->getLogFilePath()));
        $this->assertTrue(file_exists($this->errLogger->getLogFilePath()));
        $this->assertTrue(file_exists($this->hostNameLogger->getLogFilePath()));
        $this->assertTrue(file_exists($this->appNameLogger->getLogFilePath()));

        $this->assertLastLineEquals($this->logger);
        $this->assertLastLineEquals($this->errLogger);
        $this->assertLastLineEquals($this->hostNameLogger);
        $this->assertLastLineEquals($this->appNameLogger);
    }

    public function assertLastLineEquals(Logger $logr)
    {
        $this->assertEquals($logr->getLastLogLine(), $this->getLastLine($logr->getLogFilePath()));
    }

    public function assertLastLineNotEquals(Logger $logr)
    {
        $this->assertNotEquals($logr->getLastLogLine(), $this->getLastLine($logr->getLogFilePath()));
    }

    private function getLastLine($filename)
    {
        $fp = fopen($filename, 'r');
        $pos = -2; // start from second to last char
        $t = ' ';

        while ($t != "\n") {
            fseek($fp, $pos, SEEK_END);
            $t = fgetc($fp);
            $pos = $pos - 1;
        }

        $t = fgets($fp);
        fclose($fp);

        return trim($t);
    }

    public function tearDown() {
        #@unlink($this->logger->getLogFilePath());
        #@unlink($this->errLogger->getLogFilePath());
    }
}
