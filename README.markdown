# KLogger: A Simple Logging Class For PHP

A project written by Kenny Katzgrau and originally hosted at
[CodeFury.net](http://codefury.net/projects/klogger/). This marks the
development of a newer version of KLogger.

## About

KLogger is an easy-to-use logging class for PHP. It supports standard log levels
like debug, info, warn, error, and fatal. Additionally, it isn't naive about
file permissions (which is expected). It was meant to be a class that you could
quickly include into a project and have working right away.

The class was written in 2008, but I have since received a number of emails both
saying 'thanks' and asking me to add features.

This github project will host the development of the next version of KLogger.
The original version of KLogger is tagged as version 0.1, and is available for
download [here](http://github.com/katzgrau/KLogger/downloads).

## Basic Usage

    $log = new KLogger('/var/log/'); # Specify the log directory
    $log->logInfo('Returned a million search results'); //Prints to the log file
    $log->logFatal('Oh dear.'); //Prints to the log file
    $log->logInfo('Here is an object', $obj); //Prints to the log file with a dump of the object

## Goals

All of KLogger's internal goals have been met (there used to be a list here).
If you have a feature request, send it to katzgrau@gmail.com

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

Special thanks to all contributors, which right now includes three people:

[Tim Kinnane](http://twitter.com/etherealtim)
[Brian Fenton](http://github.com/fentie)
[Cameron Will](https://github.com/cwill747)

## License

The MIT License

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
