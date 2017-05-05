<?php
/*
 * file used for water log crud. I've left out update for the moment as it isnt needed just yet. 
 completed 07/0/16
 

*/
include_once '../database/database.php';

class water_log{

	//get a water log entry for the user AND PAGNATE. 
	function getWaterLogEntry($user_id){
     
		 $res=sqlQuery("SELECT * FROM water_log WHERE user_id = '$user_id'");
    	  return $res;
	}

	 //add a log entry
	 function insertWaterEntry($user_id,$quantity,$unit){
	 	$res=sqlQuery("INSERT INTO water_log (date_added, user_id, quantity, unit) VALUES (NOW(),'$user_id','$quantity','$unit')");
	 }
	 //delete an entry
	 function deleteWaterEntry($id,$user_id,$qty,$unit){
         // $res=sqlQuery("DELETE FROM user_exercise_log WHERE id= '$id' and user_id = '$user_id' AND length='$length' AND date_added ='$date_added' LIMIT 1");
         $res = sqlQuery("DELETE FROM water_log WHERE id='$id' AND user_id = '$user_id' AND quantity ='$qty' AND unit='$unit' LIMIT 1");


	 }



}

?>