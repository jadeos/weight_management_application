<?php
/*
	@author Jade O'Sullivan
	Date updated: 21/1/2017
	Database class used to handle all interactions with the database
*/
define('DB_SERVER','localhost');
define('DB_USER','YOUR USER');
define('DB_PASS' ,'YOUR PASSWORD');
define('DB_NAME', 'YOUR DATABASE NAME');

 	$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME) or die("Failed to connect to the database server, please let admin know about this problem");


   if(!$connection){
     echo "<h1>Failed to Connect to the database Server</h1> ";
   }
   
   $count =0;

   //get the number of effected rows
   function no_of_rows(){
   	global $count;
   	global $connection;
   	return mysqli_affected_rows($connection);

   }

   //perform a query to the database, this is used in other files throughout the project
   function sqlQuery($query,$type=null){
   	global $count;
   	global $connection;

   	if($result=mysqli_query($connection,$query)){
   		$count ++;
   		return $result;
   	}else{
   		return 'There was an error proccessing your request';
   	}

   }

   //fetch the result. 
   function fetch_row($result){
      global $connection;
   	return mysqli_fetch_row($result) or die(mysqli_error($connection));

   }
    
//escape strings
   function escapeStrings($string){
   	global $connection;
   	return mysqli_real_escape_string($connection,$string);
   }


   
