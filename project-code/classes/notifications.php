<?php
	include_once '../index.php';
	include_once '../database_functions/notification_messages.php';
	include_once '../database_functions/food_log.php';
	include_once '../database_functions/exercise_log.php';


 
	class Notifications{
		function notifiy(){
			$helper =  new functions();
			 $notification = new motivational_messages();
			 $res =  $notification->get_notification();
			 if(no_of_rows()>0){
			 	while($row=mysqli_fetch_array($res)){
			 	echo "<script>createTestNotification('".$row['type']."','".$row['message']."');</script>";

			
				}
			 }

		}
		//Test Notification
		function populate(){

			//if set is true, user has opted for daily facts 
			$helper =  new functions();
			 $notification = new motivational_messages();
			 $res =  $notification->get_notification();

			 if(no_of_rows()>0){
			 	while($row=mysqli_fetch_array($res)){
				 	echo $helper->console_log("notification");
					echo "<script>createNotification('".$row['type']."','".$row['message']."');</script>";

			
				}
			 }else{
			 	echo $helper->console_log("There is nothin to see here");
			 }
			 
		}

	//set the notification for the user  
	function setNotification(){
		   
    session_start();
  
		
		$helper =  new functions();
		$notification = new motivational_messages();

		$checkNotifications = $notification->get_user_notifications($_SESSION['user_id']);
			

		while($row = mysqli_fetch_array($checkNotifications)){

			$type = $row['reminder'];
			$time =$row['sent_time'];
			$current_time = localtime($_SERVER['REQUEST_TIME'],true);
			$hour =$current_time['tm_hour']+1;
			$mins =$current_time['tm_min'];
			if($hour >='24'){
				$start = $hour %24; 
				$hour = $start;
			}

			if($hour<10){
				$hour= '0'.$hour;
			}
			if($mins<10){
				$mins= '0'.$mins;
			}
			
			$todays_time =$hour.":".$current_time['tm_min'];
			// check if type is reminder 
				if($row['reminder'] == "none"){
					//its a reminder. Neet to check logs 
					$food = new food_log();
					$todays_date = date('Y-m-d');
					//check logs for the current day 
					$food_log = $food->getUserFoodLog($_SESSION['user_id'], $todays_date );

					if(mysqli_num_rows($food_log)<1){

						echo "<script>createNotification('Reminder:','You haven\'t logged any food for today!','".$todays_time."','".$time."');</script>";
						
					}

					$calorie_sum_check = $food->calorie_summary($_SESSION['user_id']); 
					if($r = mysqli_fetch_array($calorie_sum_check)){
						if($r['total_cals'] == 2000){
							echo "<script>createNotification('Reminder:','You have reached your daily calorie intake for today, well done!','".$todays_time."','".$time."');</script>";
						}
					}

				}else{
					$res = $notification->get_notification();
					if(no_of_rows()>0){
			 			while($rows=mysqli_fetch_array($res)){
				 
					echo "<script>createNotification('".$rows['type']."','".$rows['message']."','".$todays_time."','".$time."');</script>";

				}
			//}
		}
	}

		 
	}
}

	function setReminder(){
		echo $helper->console_log("SETTING REMINDERS!");
		//checks food long for the current day to see if empty if empty retrun true; if not return false; 
		$helper =  new functions();
		$notification = new motivational_messages();
		$food = new food_log();
		$todays_date = date('Y-m-d');


		$food_log = $food->getUserFoodLog($_SESSION['user_id'], $todays_date );

		if(mysqli_num_rows($food_log)==0){
			echo $helper->console_log("No INFORMATION LOGGED!");
		}
		//if($r= mysqli_fetch_array($food_log))

	}
	


	
}

?> 
