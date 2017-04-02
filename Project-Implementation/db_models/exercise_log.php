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
	function getExerciseDirectoryItem($item){
		
		  $res=sqlQuery("SELECT * FROM exercise_directory WHERE exercise  LIKE '%$item%' OR description LIKE '%$item%' ");
    	  return $res;

	}

	//get the exercise that the user has logged
	function getExerciseLogItem($user_id){
		$res=sqlQuery("SELECT l.id,l.date_added,d.exercise,d.description,d.type,l.length FROM user_exercise_log l 
      JOIN exercise_directory d ON d.id = l.exercise_id WHERE l.user_id='$user_id' ORDER BY l.date_added DESC");
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






}
?>