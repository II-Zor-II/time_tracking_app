<?php 

	/* function for Transforming date into readable format */
	function datetime_to_text($datetime=""){
		$unixdatetime = strtotime($datetime);
		return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
	}

	/* ex: 01/05/2017 --> 1/5/2017 */
	function strip_zeros_from_date($marked_string=""){
		//first remove the marked zeros
		$no_zeros = str_replace('*0','',$marked_string);
		//then remove any remaining marks
		$cleaned_string = str_replace('*','',$no_zeros);
		return $cleaned_string;
	}
	
	// Redirection function
	function redirect_to($location = NULL){
		if($location!=NULL){
			header("Location: {$location}");
			exit;
		}
	}

	function __autoload($class_name){
		$class_name = strtolower($class_name);
		$path = INCLUDES_DIR."/{$class_name}.php";
		if(file_exists($path)){ // file_exists — Checks whether a file or directory exists
			require_once($path);
		}else{
			die("The file {$class_name}.php could not be found.");
		}
	}
	
	function include_layout_template($template=""){
		include(MAIN_DIR.'/public/layouts/'.$template);
	}

	//displays $message if there are any.
	function output_message($message=""){
		if(!empty($message)){
			return "<p class=\"message\">{$message}</p>";
		}else{
			return "";
		}
	}
	
	 /*get difference between dates. 1st param = earlier date
	 	ex-formats: Y-n-j H:i:s	 */
	function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
	{
		$datetime1 = date_create($date_1);
		$datetime2 = date_create($date_2);

		$interval = date_diff($datetime1, $datetime2);

		return $interval->format($differenceFormat);
	}

	function time_to_seconds($str_time){

		sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

		$time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
		
		return $time_seconds;
	}

?>