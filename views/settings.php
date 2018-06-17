
<?php
//Settings-eg security, etc PASSWORD Reset, email changes,notifications etc


 
  
 include_once '../index.php';
 

     if(!isset($_SESSION)){
    session_start();
  }

  include_once '../database_functions/weight_log.php';
  include_once '../database_functions/users.php';
  include_once '../classes/notifications.php';
  include_once '../database_functions/food_log.php';
  include_once '../database_functions/exercise_log.php';
  include_once '../database_functions/water_log.php';
  include_once '../classes/notifications.php';


//database functions classes 
    $con = new users();
   $weight = new weight_log();
    $food= new food_log();
   $exercise = new exercise_log();
    $water= new water_log();
      $helper  = new functions();
    $notification = new notifications();
    $notify = new motivational_messages();

  if($_SESSION['loggedin']==true){
  		//get user information 
  	 $res =$con->searchUser($_SESSION['user_id']);
  	 ?>


  	  <div class="panel panel-default" height="auto" style="margin-left: 1%;;background-color:lightgrey">

     <div class="panel-heading" id ="panel" style="background-color: grey;">Account Settings</div>
     <ul class="nav nav-tabs">
       <li role="presentation" id="gen"><a href="#general" data-toggle="tab" onclick="showGeneralSettings(),setSettab(0)">General Settings</a> </li>
      <li role="presentation" id="not"><a href="#notifications" data-toggle="tab" onclick="showNotificationSettings(),setSettab(1)">Notification Settings</a>  </li>
         <li role="presentation" id ="sec"><a href="#security" data-toggle="tab" onclick="showSecuritySettings(),setSettab(2)">Security Settings</a>
                    </li>
                   
      </ul>


         <div id="general">
	     	 <h3>General Settings</h3>
         <div class="container-fluid">
            <div class="row">
              <div class="col-sm-3" style ="min-width:33%">
                  <div class="verticalLine" style="border-right: 1px solid grey">
  	     	        <form method="post" action=" ">
    	     	         <div id ="email-settings">
    		     	         <h4>Change Your Email Address</h4>
    		     	         <label> Old Email Address </label>
    		     	         <input type="email" name="oldemail"/><br/><br/>
    		     	         <label> New Email Address </label>
    		     	        <input type="email" name="newemail"/><br/><br/>
    		     	        <label> Confirm New Email Address </label>
    		     	       <input type="email" name="confirmemail"/><br/><br/>
                     <div class="col-sm-3" style ="margin-left:75%">
    		     	       <button type="submit" name="submitemail">Save</button>
                     </div>
    	     	        </div>
    	     	     </form>
                 </div>
                </div>
            <div class="col-sm-3" style="min-width:33%;">
            <div class="verticalLine" style="border-right: 1px solid grey">
  	     	  <div id ="password-settings">
  	     	   <form method="post" action=" ">
  		     	 <h4>Change Your Password</h4>
  		     	 <label> Old Password </label>
  		     	 <input type="password" name="oldpass"/><br/><br/>
  		     	 <label> New Password </label>
  		     	 <input type="password" name="newpass"/><br/><br/>
  		     	 <label> Confirm New Password </label>
  		     	 <input type="password" name="confirmpass"/><br/><br/>
             <div class="col-sm-3" style ="margin-left:75%">
  		     	 <button type="submit" name="submitpass">Save</button>
             </div>
  	     	 </div>
  	     	 </form>
           </div>
           </div>
	    
            <div class="col-sm-3" style="min-width:33%;">
            <div class="verticalLine" style="border-right: 1px solid lightgrey">
	     	  <form method="post" action=" ">
	     	  <div id="delete_account">

		     	 <h4>Delete Account</h4>
		     	 <label>Do you wish to delete your account? </label>
		     	    <br/>
              <div class="col-sm-6" style ="margin-left:50%">
		     	 <button type="submit" name="delete_account">Delete Account</button>
           </div>
		     </div>
         </div>
         </div>
         </div>
         </div>
     	 </div>
      
          <div id="notifications" style="display:none">
              <div class="container-fluid">
               <div class="row">
             
				      <h3>Notification Settings</h3>
				      <strong> Please provide infomation when you would like to be notified by weight mentor </strong>
				      <hr>

				      <form method ="post" action " ">
               <div class="col-sm-3" style ="min-width:33%">
                <div class="verticalLine" style="border-right: 1px solid grey">
				      <label> ON/OFF</label>
				      <input type ="radio" value="on">On</input>
				      <input type ="radio" value="off">Off</input>
              </div>
				        </div>
				       <div class="col-sm-3" style ="min-width:33%">
                <div class="verticalLine" style="border-right: 1px solid grey">

				      <label> Notification Time: </label>
				      <select id ="timeSettings" name="time">
				        <option name ="time" value="00:00 ">00:00</option>
				        <option name ="time" value="1:00 ">1:00</option>
				        <option name ="time" value="02:00">02:00</option>
				        <option name ="time" value="03:00">03:00</option>
				        <option name ="time" value="04:00">04:00</option>
				        <option name ="time" value="05:00 ">05:00</option>
				        <option name ="time" value="06:00">06:00</option>
				        <option name ="time" value="07:00 ">07:00</option>
				        <option name ="time" value="08:00">08:00</option>
				        <option name ="time" value="09:00">09:00</option>
				        <option name ="time" value="10:00">10:00</option>
				        <option name ="time" value="11:00">11:00</option>
				        <option name ="time" value="12:00">12:00</option>
				        <option name ="time" value="13:00">13:00</option>
				        <option name ="time" value="14:00">14:00</option>
				        <option name ="time" value="15:00">15:00</option>
				        <option name ="time" value="16:00">16:00</option>
				        <option name ="time" value="17:00">17:00</option>
				        <option name ="time" value="18:00">18:00</option>
				        <option name ="time" value="19:00">19:00</option>
				        <option name ="time" value="20:00">20:00</option>
				        <option name ="time" value="21:00">21:00</option>
				        <option name ="time" value="22:00">22:00</option>
				        <option name ="time" value="23:00">23:00</option>
				      </select>
                  </div>
				        </div>
                 <div class="col-sm-3" style ="min-width:33%">
				      <label> Notification Type:</label>
		
				      <input type = "checkbox" name="type" value="reminder">Reminder</input>
				      <input type = "checkbox" name="type" value="daily fact">Daily Fact</input>
				      <input type = "checkbox" name="type" value="inspire me">Inspire Me!</input>
              </div>
               <div class="col-sm-3" style ="margin-left:80%;min-width:33%">
				      <br/>
				      <button type="submit" name="setNotiication">Save </button>
              <button type ="submit" name="testNotification">Send Test Notification</button>
              </div>
				       </form>

				        <br/>
				      <hr>
              </div>
              </div>
				   </div>

           <?php
           if(isset($_POST['testNotification'])){
             echo $notification->notifiy();
           
           }
           ?>


        <div id="security" style="display:none">
        	
           <div class="container-fluid">
            <div class="row" style ="margin-left:33%;">
              <h3>Security Settings</h3>
              <div class="col-sm-3" style ="min-width:63%">
          <form method ="post" action=" ">
        	<label> Current Security Question:</label>
          <?php
              if($z= mysqli_fetch_array($res)){
                echo "<strong>".$z['security_question']."</strong>";
              }

          ?>
          <br/>
        	<label> Current Security Answer: </label>
          <input type ="text" name="old_answer">
          <br/>
          <label>Security Question:</label>
  
          <select name ="question">
            <option name ="qe" value ="What was your mothers maden name?">What was your mothers maden name?</option>
            <option name ="qe" value ="What was the name of your first pet?">What was the name of your first pet?</option>
            <option name ="qe" value ="What was the colour of your first car?">What was the colour of your first car?</option>
            <option name ="qe" value ="What was the name of your favorite teacher?">What was the name of your favorite teacher?</option>
            <option name ="qe" value ="What is the name of your oldest relative">What is the name of your oldest relative</option>
          </select>
            <br/>
            <br/>
        	<label> New Security Answer </label>
          <input type ="text" name="new_answer">
            <br/>
             <div class="col-sm-3" style ="margin-left:70%;">
            <button type ="submit" name="saveSec">Save </button>
            </div>
            </form>
        </div>
        </div>
        </div>
        </div>
         <br/>
      <hr>
      <script>
  loadSet();
  $(document).ready(function(){
  $(".link").click(function(){
  $(this).tab('show');
  });
  });

  $("ul.nav-tabs a").click(function (e) {
  e.preventDefault();
  //$(this).tab('show');
  });

  </script>
      <br/>


        <?php 
        //if the security question has been set
        if(isset($_POST['saveSec'])){
          
          $old_answer =$_POST['old_answer'];
          $new_q = $_POST['question'];
          $new_answer =$_POST['new_answer'];
            $ress =$con->searchUser($_SESSION['user_id']);
          //query the database based on the user id 
          if($x = mysqli_fetch_array($ress)){
           
            //check to see if the security answer in the db matches the old answer 
            if($x['security_answer']==$old_answer){
              echo $helper->console_log("correct");
              //now we update secruity question and answer for the user id
              echo $con->updateSecurity($new_q,$new_answer,$_SESSION['user_id']);
            }else{
              echo $helper->console_log("error invalid security answer. Cannot change security question");
            }

          }
        }
        //if email address has been changed : 
        if(isset($_POST['submitemail'])){
        	//CHECK IF OLD EMAIL ADDRESS EXISTS IN DB
        	$oldemailaddress = $_POST['oldemail'];
        	$emailc = $con->searchEmail($oldemailaddress);
        	 if(no_of_rows()>0){
        		//CHECK IF NEW EMAIL ADDRESS IS = TO CONFIRM EMAIL
        		$newemailaddress = $_POST['newemail'];
        		$confirmemail = $_POST['confirmemail'];
        		if($newemailaddress == $confirmemail){
        			//perform the update
        			echo $con->updateEmail($newemailaddress,$_SESSION['user_id']);
        			echo "Your email address has been changed!";

        		}else{
        			echo "Error - The new email address's don't match!";
        		}

         }else{
        	 	echo "Error - This email address doesnt exist!";
        	 }
        	
        }

        //if password has been changed
         if(isset($_POST['submitpass'])){
        	//CHECK IF OLD EMAIL ADDRESS EXISTS IN DB
        	$oldpassword = $_POST['oldpass'];
        	$password= $con->checkpass($_SESSION['user_id']);

        	 if($row = mysqli_fetch_array($password)){
        		//CHECK IF NEW EMAIL ADDRESS IS = TO CONFIRM EMAIL

        		$queried_password = $row['password'];
        		$email = $row['email'];

        		
        		echo $_POST['newpass'];
        		echo $oldpassword; 

        		//echo password_verify($oldpassword,$queried_password));
        		 if(password_verify($oldpassword,$queried_password)){

        			//if right, check new passowrd against conform password. 
        			$newpass = $_POST['newpass'];
        			$confirmpass = $_POST['confirmpass'];
        			if($newpass == $confirmpass){
        				//update the password 
        				$hashed_pass = password_hash($newpass,PASSWORD_DEFAULT);
        				echo $con->updatePass($hashed_pass,$email);
        				echo "Your Password has been changed!";
        			}else{
        				echo "Error - Passwords don't match!";
        			}

        		}else{
        			echo "The old password is incorrect";
        		}
        		

        	}



         
        	
        }
                //delete the user from the database
       if(isset($_POST['delete_account'])){

       $delete=$con->deleteUsers($_SESSION['user_id']);
       echo '<script type="text/javascript">window.location.replace("https://weightmentor.eu/views/home.php");</script>';

       //send user an email to let them know there account has been removed.
       $emailCheck=$con->searchEmail($email);
        if($row=mysqli_fetch_array($emailCheck)){
          echo "Lolllll";
       $to = $email ;
       $subject = "Confirmation that your account has been deleted by the administrator.";
         $headers = 'Content-type:text/html;charset=utf8'."\r\n"."From:info.weightmentor@gmail.com";
       $body ="Hi $user This message confirms that your account has been deleted.<br/> If you have not requested that we shut down your account please do not hesitate to contact our team.You can email us at info.weightmentor@gmail.com .<br/><br/>Regards Weight Mentor Administration Team. ";
       echo " Sending Email to ".$email;
       mail($to, $subject, $body, $headers);
       if(mail($to, $subject, $body, $headers)) {
        echo'<div class="alert alert-success">An Email has been sent to this users account.</div>';
       }else{
        echo "Error sending email to ".$email;
       }
     }
     //remove the session 
     session_unset();
  session_destroy();
   }
        //if the notifications have been saved 

          if(isset($_POST['setNotiication'])){
            //IF THE NOTIFICATONS ARE ON 
            if($_POST['radio']="on"){
              //do stuff
              $time =$_POST['time'];
              $type =$_POST['type'];
        

              if($type =="reminder"){
              	$reminder="none";
              }else{
              	$reminder=$type;
              }
              //save the values in the database 
              echo $notify->set_notification($_SESSION['user_id'],'on',$time,$reminder);
            }else{

              //turn the notifcation  off
            }

         }
       }else{
        ?>
        <div class="panel-heading">Please Log in to View Your Profile</div>

        <?php

       }



        ?>


    </div>
</div>

</div>
