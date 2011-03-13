#!/usr/bin/php -q

<?php

	// set timezone
	date_default_timezone_set('Europe/London');
	
	// vars
	$digest = 0;
	$email = "";
	$usernames = array();
	
	parse($argc, $argv);

	// parse args
	function parse($argc, $argv) {
		// get number of args passed
		// (first [0] is always name of file)
		$numArgs = $argc - 1;

		// min number of args
		if ($numArgs < 3) {
			error("Min args");
		} else {
			// need some type checking here
			$digest = $argv[1];
			$email = $argv[2];
			
			for ($i=3;$i<$argc;$i++) {
				$usernames[] = $argv[$i];
			}
			
			checkNames($usernames, $digest, $email);
			
			//print_r($usernames);
		}	
	}
	
	function checkNames($usernames, $digest, $email) {
		$results = array();
		
		foreach($usernames as $u) {
			$result = nameAvailable($u);
			if($digest || $result) {
				$results[] = array($u, $result);
			}
		}
		
		//print_r($results);
		
		output($results, $digest, $email);
	}	

	function output($results, $digest, $email) {
		echo "twitsquat results:\n\n";
		if(count($results) === 0) {
			echo "None available.\n\n\n";
			return;
		}
		
		// pull in our template
		$template = file_get_contents(dirname(__FILE__) . "/email.html");
		// chop it up
		$head = explode("{START}", $template);
		$foot = explode("{END}", $template);
		$bodyr = explode("{END}", $head[1]);
		$head = $head[0];
		$foot = $foot[1];
		$bodyr = $bodyr[0];
		
		$body = "";
		
		//output and insert our results into email template
		foreach($results as $r) {
			echo $r[0] . ": " . ($r[1] ? "Available!" : "Unavailable.") . "\n";
			
			$row = str_replace("{USERNAME}", $r[0], $bodyr);
			$row = str_replace("{VALUE}", $r[1] ? "Available!" : "Unavailable.", $row);
		
			$body .= $row;
		}
		
		$date = date("Y-m-d H:i:s");
		$head = str_replace("{DATETIME}", $date, $head);
		
		$subject = "twitsquat update (" . $date . ")";
		$headers = "From: " . $email . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		@mail($email, $subject, $head.$body.$foot, $headers);
		
		echo "\n\n\n";
	}

	function nameAvailable($username) {
		//return 1;
		@file_get_contents("http://api.twitter.com/1/users/show.json?screen_name=" . $username,0,null,null);
		
		if($http_response_header[0] == "HTTP/1.1 404 Not Found") {
			return 1;
		} else {
			return 0;
		}
	}

	function error($msg) {
		die($msg);
	}
?>