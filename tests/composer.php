<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Katzgrau\KLogger\KLogger;

$log = new KLogger('/tmp/', KLogger::INFO); # Specify the log directory
$log->logInfo('Returned a million search results'); //Prints to the log file
$log->logFatal('Oh dear.'); //Prints to the log file
