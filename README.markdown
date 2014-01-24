# eklogger: A logging class for PHP

eklogger is a simple yet powerful logging class for PHP

eklogger is based on [KLogger](https://github.com/katzgrau/Klogger) written by
[Kenny Katzgrau](http://codefury.net/projects/klogger/).

## About

eklogger is an easy-to-use logging class for PHP. It supports standard log levels
like debug, info, warn, error, and fatal. Additionally, it isn't naive about
file permissions (which is expected). It also provides output to STDOUT.


## Installation

Use [composer](http://getcomposer.org) and add eklogger to your composer.json to use it:

    require: {
        ...
        "deralex/eklogger": "*",
        ...
    }

Then hit `composer install` to get eklogger.

## Basic Usage

    use DerAlex\eklogger\EKLogger;

    $log = new EKLogger('/tmp/', EKLogger::INFO); # Specify the log directory and minimum severity level
    $log->info('Returned a million search results'); //Prints to the log file
    $log->fatal('Oh dear.'); //Prints to the log file
    $log->info('Here is an object', $obj); //Prints to the log file with a dump of the object


## License

The MIT License

Copyright (c) 2014 Alexander Kluth <contact@alexanderkluth.com>
Copyright (c) 2008-2010 Kenny Katzgrau <katzgrau@gmail.com>

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
