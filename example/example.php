<?php

# Should log to the same directory as this file
require dirname(__FILE__) . '/../src/KLogger.php';

$log = KLogger::instance(dirname(__FILE__), KLogger::DEBUG);

$log->logInfo('Info Test');
$log->logNotice('Notice Test');
$log->logWarn('Warn Test');
$log->logError('Error Test');
$log->logFatal('Fatal Test');
$log->logAlert('Alert Test');
$log->logCrit('Crit test');
$log->logEmerg('Emerg Test');
