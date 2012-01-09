<?php

# Should log to the same directory as this file
require dirname(__FILE__) . '/../src/KLogger.php';

$log = KLogger::instance(dirname(__FILE__), KLogger::DEBUG);

$log->logInfo('Info Test');
$log->logNotice('Notice Testssss');
$log->logWarn('Warn Testssss');
$log->logError('Error sss');
$log->logFatal('Fatal ss');
$log->logAlert('Alert ssss');
$log->logCrit('Crit test');
$log->logEmerg('Emerg Test');
$log->logInfo("HI!");

$log->logStartTime('Sleeping');
sleep(1);
$log->logEndTime('Sleeping'); //notice that the task names match
