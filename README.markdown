# KLogger: Simple Logging for PHP

A project written by [Kenny Katzgrau](http://twitter.com/katzgrau) and [Dan Horrigan](http://twitter.com/dhrrgn).

## About

KLogger is an easy-to-use [PSR-3](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md)
compliant logging class for PHP. It isn't naive about
file permissions (which is expected). It was meant to be a class that you could
quickly include into a project and have working right away.

## Installation

### Composer

From the Command Line:

```
composer require katzgrau/klogger:1.0.*
```

In your `composer.json`:

``` json
{
    "require": {
        "katzgrau/klogger": "1.0.*"
    }
}
```

## Basic Usage

``` php
<?php

require 'vendor/autoload.php';

$users = [
    [
        'name' => 'Kenny Katzgrau',
        'username' => 'katzgrau',
    ],
    [
        'name' => 'Dan Horrigan',
        'username' => 'dhrrgn',
    ],
];

$logger = new Katzgrau\KLogger\Logger(__DIR__.'/logs');
$logger->info('Returned a million search results');
$logger->error('Oh dear.');
$logger->debug('Got these users from the Database.', $users);
```

### Output

```
[2014-03-20 3:35:43.762437] [INFO] Returned a million search results
[2014-03-20 3:35:43.762578] [ERROR] Oh dear.
[2014-03-20 3:35:43.762795] [DEBUG] Got these users from the Database.
    0: array(
        'name' => 'Kenny Katzgrau',
        'username' => 'katzgrau',
    )
    1: array(
        'name' => 'Dan Horrigan',
        'username' => 'dhrrgn',
    )
```

## PSR-3 Compliant

KLogger is [PSR-3](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md)
compliant. This means it implements the `Psr\Log\LoggerInterface`.

[See Here for the interface definition.](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md#3-psrlogloggerinterface)

## Setting the Log Level Threshold

You can use the `Psr\Log\LogLevel` constants to set Log Level Threshold, so that
any messages below that level, will not be logged.

### Default Level

The default level is `DEBUG`, which means everything will be logged.

### Available Levels

``` php
<?php
use Psr\Log\LogLevel;

// These are in order of highest priority to lowest.
LogLevel::EMERGENCY;
LogLevel::ALERT;
LogLevel::CRITICAL;
LogLevel::ERROR;
LogLevel::WARNING;
LogLevel::NOTICE;
LogLevel::INFO;
LogLevel::DEBUG;
```

### Example

``` php
<?php
// The 
$logger = new Katzgrau\KLogger\Logger('/var/log/', Psr\Log\LogLevel::WARNING);
$logger->error('Uh Oh!'); // Will be logged
$logger->info('Something Happened Here'); // Will be NOT logged
```

## Why use KLogger?

Why not? Just drop it in and go. If it saves you time and does what you need,
go for it! Take a line from the book of our C-code fathers: "`build` upon the
work of others".

## Who uses KLogger?

Klogger has been used in projects at:

    * The University of Iowa
    * The University of Laverne
    * The New Jersey Institute of Technology
    * Middlesex Hospital in NJ

Additionally, it's been used in numerous projects, both commercial and personal.

## Special Thanks

Special thanks to all contributors:

* [Dan Horrigan](http://twitter.com/dhrrgn)
* [Tim Kinnane](http://twitter.com/etherealtim)
* [Brian Fenton](http://github.com/fentie)
* [Cameron Will](https://github.com/cwill747)

## License

The MIT License

Copyright (c) 2008-2014 Kenny Katzgrau <katzgrau@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
