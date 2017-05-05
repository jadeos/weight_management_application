<?php

include_once '../database/database.php';

/*
 Ecercise interacts with two tables. User_Exercise_Log and Exercise Directory.
 User_Exercise_Log is a link table to link the user id of the user and the food id together.
 Food Directory consists of a food id which will be used in a join to get the food of the user
 We need to be able to connect to the users table however this will be done through a session variable stored when logged in.

*/
class exercise_log{

	//function to retrieve a exercise item from exercise drirectory-search 
	//get a list of steps for the user from the db
	function getSteps($user_id){
		$res =sqlQuery("SELECT * FROM step_log WHERE user_id='$user_id'"); 
		return $res;

	}
	function get_step_summary($user_id){
		$res =sqlQuery("SELECT sum(steps) `todays_steps` FROM step_log WHERE user_id='$user_id' AND date_A LIKE CURDATE()"); 
		return $res;
	}
	//insert steps 
	function add_steps($steps, $distance,$calories,$user_id){
		$res=sqlQuery("INSERT INTO step_log (date_A, steps,distance,calories, user_id) VALUES (NOW(),'$steps', '$distance','$calories','$user_id')");

	 }
	// //remove steps
	function remove_steps($id,$user_id,$steps,$dateA,$calories)
	{
		 $res = sqlQuery("DELETE FROM step_log WHERE id='$id' AND user_id = '$user_id' AND steps ='$steps' AND date_A= '$dateA' AND calories = '$calories' LIMIT 1");
		 return $res;
	}
	function countAllEx($user_id,$DATE){
			$res = sqlQuery("SELECT date_added FROM user_exercise_log WHERE user_id = '$user_id' AND date_added LIKE '$DATE'");
        return $res;
	}
	function getExerciseDirectoryItem($item){
		
		  $res=sqlQuery("SELECT * FROM exercise_directory WHERE exercise  LIKE '%$item%' OR description LIKE '%$item%' ");
    	  return $res;

	}

	//get the exercise that the user has logged
	function getExerciseLogItem($user_id,$start_from,$limit){
		$res=sqlQuery("SELECT l.id,l.date_added,d.exercise,d.description,d.type,l.length FROM user_exercise_log l 
      JOIN exercise_directory d ON d.id = l.exercise_id WHERE l.user_id='$user_id'  ORDER BY date_added limit $start_from, $limit");
      return $res;
	}

	//add a custom exercise to the exercise directory. 
	function insertIntoExerciseDirectory($name,$type,$description){
		$res=sqlQuery("INSERT INTO exercise_directory (exercise,type,description) VALUES ('$name','$type','$description')");

	}
	function insertIntoExerciseLog($exercise_id,$user_id,$length){
		$res=sqlQuery("INSERT INTO user_exercise_log (date_added, exercise_id, user_id, length) VALUES (NOW(),'$exercise_id','$user_id', '$length')");

	}
	function removeExerciseLogEntry($id,$user_id,$length,$date_added){
		 $res=sqlQuery("DELETE FROM user_exercise_log WHERE id= '$id' and user_id = '$user_id' AND length='$length' AND date_added ='$date_added' LIMIT 1");

	}

	//get all dates in the db 
	function countDates($user_id){
		//$res = sqlQuery("SELECT COUNT('date_added') `date_sum` date_added FROM user_exercise_log WHERE user_id='$user_id' AND date_added BETWEEN ");
		$res =sqlQuery("SELECT date_added FROM user_exercise_log WHERE user_id='$user_id'"); 
		return $res;
	}

	


	 


/*
Get a list of all the dates? 
To get the limit, loop through each date, 

*/


}
?>