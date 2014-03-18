<?php

use Katzgrau\KLogger\Logger;

class LoggerTest extends PHPUnit_Framework_TestCase
{
    private $logPath;
    private $logger;

    public function setUp()
    {
        $this->logPath = __DIR__.'/logs';
        $this->logger = new Logger($this->logPath);
    }

    public function testImplementsPsr3LoggerInterface()
    {
        $this->assertInstanceOf('Psr\Log\LoggerInterface', $this->logger);
    }
}
