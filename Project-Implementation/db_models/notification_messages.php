<?php
//include_once '../config/db.php';
include_once '../database/database.php';
global $connection;

class motivational_messages{

	//get notifcation
	function get_notification(){
		$res = sqlQuery("SELECT message FROM msg");

  		return $res;
	}

}
?>