<?php

# Should log to the same directory as this file
require dirname(__FILE__).'/../vendor/autoload.php';

$obj = new stdClass();
$obj->foo = 'bar';
$log   = new Katzgrau\KLogger\Logger(dirname(__FILE__), Psr\Log\LogLevel::DEBUG);
$args1 = array('a' => array('b' => 'c'), 'd' => null, 'e' => $obj);
$args2 = NULL;

$log->emergency('Emergency Test');
$log->alert('Alert Test');
$log->critical('Critical Test');
$log->error('Error Test');
$log->warning('Warning Test');
$log->notice('Notice Test');
$log->info('Info Test');
$log->debug('Debug Test');

$log->info('Testing passing an array or object', $args1);
