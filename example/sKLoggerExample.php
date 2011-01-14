<?php
date_default_timezone_set("Europe/Athens");
# Should log to the same directory as this file
require_once(dirname(__FILE__) . '/../src/sKLogger.php');

sKLogger::instance(dirname(__FILE__), sKLogger::DEBUG);
sKLogger::setDateFormat('G:i:s d-m-Y');

sKLogger::setDisplayIp(true);

sKLogger::logInfo("test");
sKLogger::logNotice('Notice Test');
sKLogger::logWarn('Warn Test');
sKLogger::logError('Error Test');
require_once(dirname(__FILE__) . "/sKLoggerExample2.php");
