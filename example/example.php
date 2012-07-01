<?php

# Should log to the same directory as this file
require dirname(__FILE__) . '/../src/KLogger.php';

$log   = KLogger::instance(dirname(__FILE__), KLogger::DEBUG);
$args1 = array('a' => array('b' => 'c'), 'd');
$args2 = NULL;

$log->logInfo('Info Test');
$log->logNotice('Notice Test');
$log->logWarn('Warn Test');
$log->logError('Error Test');
$log->logFatal('Fatal Test');
$log->logAlert('Alert Test');
$log->logCrit('Crit test');
$log->logEmerg('Emerg Test');

$log->logInfo('Testing passing an array or object', $args1);
$log->logWarn('Testing passing a NULL value', $args2);
