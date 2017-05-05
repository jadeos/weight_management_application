<?php
//include_once '../config/db.php';
include_once '../database/database.php';
global $connection;

class motivational_messages{

	//get notifcation
	function get_notification(){
		$res = sqlQuery("SELECT message, type FROM msg order by RAND() LIMIT 1");

  		return $res;
	}

	function getNotification($type){
		$res = sqlQuery("SELECT id, message FROM msg WHERE type='$type' order by RAND() LIMIT 1");
		return $res;
	}

	function set_notification($user_id,$status,$time,$reminder){
		$res = sqlQuery("INSERT into notifications (user_id, status, sent_time, reminder) VALUES('$user_id','$status','$time','$reminder')");

	}

	function get_user_notifications($id){
		$res = sqlQuery("SELECT id, user_id, status,sent_time,reminder FROM  notifications WHERE user_id = '$id'  ORDER BY RAND() LIMIT 1");
		return $res;
	}

}
?>