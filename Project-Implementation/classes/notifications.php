<?php
	include_once '../index.php';
	include_once '../database_functions/notification_messages.php';

	class Notifications{
		//Daily Motivational Fact 
		function populate(){
			//if set is true, user has opted for daily facts 
			$helper =  new functions();
			 $notification = new motivational_messages();
			 $res =  $notification->get_notification();

			 if(no_of_rows()>0){
			 	while($row=mysqli_fetch_array($res)){
				 	echo $helper->console_log($row['message']);
					echo "<script>createNotification('".$row['message']."');</script>";

			
				}
			 }else{
			 	echo $helper->console_log("There is nothin to see here");
			 }
			 
		}
	}
?>
