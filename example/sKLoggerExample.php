<?php
date_default_timezone_set("Europe/Athens");
# Should log to the same directory as this file
require_once(dirname(__FILE__) . '/../src/sKLogger.php');

# make one instance
sKLogger::instance(dirname(__FILE__), sKLogger::DEBUG);

# set the date format
sKLogger::setDateFormat('d-m-Y', 'G:i:s');

# print with default format
sKLogger::logInfo("test");

# set the ip not to be displayed
sKLogger::setDisplayIp(false);

# change the format of the log with a diff one
# check the doc for the sequence of the appearence
sKLogger::setDisplayFormat('- %1$s - %2$s -->>');

# print some more...
sKLogger::logNotice('Notice Test');

# set the ip to be displayed
sKLogger::setDisplayIp(true);

# change the format again
sKLogger::setDisplayFormat('DATE: %1$s IP: %3$s - %2$s ->');
sKLogger::logWarn('Warn Test');
sKLogger::logError('Error Test');
# change the format again and again 
sKLogger::setDisplayFormat('- %2$s ( %1$s ) -');
# and more...
require_once(dirname(__FILE__) . "/sKLoggerExample2.php");
