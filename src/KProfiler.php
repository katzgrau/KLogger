<?php
/**
* KProfiler is a simple application which parses the time logs from KLogger. It then displays them via a web interface. This interface
* has the option to enable realtime polling so that the stats are updated in realtime. It also can display log messages to the console.
* KProfiler's goal is to allow you to find the bottleneck in your applications and with little overhead. It also has a simple REST (like) API.
* Thus, when you call display() it will either display a REST response or output the main console (if no parameters)
* @todo Introduce some sort of file locking to ensure we don't have race conditions.
* 
* Usage:
* $kprofiler = new KProfiler([log file directory]);
* $kprofiler->display();
* @author Sam Stewart <sam@samstewartapps.com>
* @since September 7, 2010
* @link samstewartapps.com
* @version 0.2
*/

/**
* Simple class which represents a log entry.
*/
class KLogEntry {
	public $time;
	public $type;
	public $message; //or "task" if timer entry
	//properties specific to timer logs
	public $elapsed_time;
	
	public function __construct($time, $type, $message, $elapsed_time) {
		$this->time = $time;
		$this->type = $type;
		$this->message = $message;
		$this->elapsed_time = $elapsed_time;
	}
}
/**
* Actual profiler class. Reads the log in and creates stats.
*/
class KProfiler 
{
	/**
	* @var string the log directory. We'll use this to display the most current log.
	*/
	private $_logDir;
	
	/**
	* @var array the list of KLogEntrys from the log file.
	*/
	private $_logEntries;
	
	public function __construct($log_dir) {
		$this->_logDir = $log_dir;
	}
	
	/** 
	* Filters and returns only the log entries with the specified type.
	* @param type the log type we're filtering for
	* @return array a filtered array containing only log entries that have the type specified.
	*/
	private function filterEntries($type) {
		
	}
	
	/**
	* Function which opens the specified file and reads in all the page entries.
	* @param log_file the log file path
	* @return array The array of KLogEntrys from the file
	*/
	private function readEntries($log_file) {
		
	}
	
	/**
	* Function which looks at all time entries, combines identical tasks, then sorts them in descending order
	* so that we can tell which tasks are taking the longest.
	* @param entries The log entries we're combining. They should all be TIMER entries (prefiltered)
	* @return array An array of KLogEntry items. However, there are no two entries with the same task (they're all combined). They're
	* also sorted in descending order (based on milliseconds)
	*/
	private function totalEntries($entries) {
		
	}
}
?>