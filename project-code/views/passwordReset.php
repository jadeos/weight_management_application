<?php
  include_once '../index.php';

  include_once '../database_functions/users.php';

  $con = new users();



 if(isset($_POST['home'])){
    header("Location: index.php");
  }
    if(isset($_POST['send'])){
     if(!$_POST['emailA']){
       echo "PLease enter an email address to continue";
     }else{
      $email = $_POST['emailA'];
      $answer =$_POST['security_answer'];
      //finjd the user with the email address. this needs t be inplemented.
     $emailCheck=$con->searchEmail($email);
     $getAnswer=$con->getSecurityAnswer($answer,$_SESSION['user_id']);
          //IF IT EXISTS!
      if($row=mysqli_fetch_array($emailCheck)){
        $message ="HI there, please click here https://weightmentor.eu/views/resetform.php?email=".$email." to reset your password.<br/>Please do not reply to this email. This is automatically generated.<br/>If you havent requested to update your password, please ignore this email <br/>regards staff";
        $message = wordwrap($message,70,"\r\n");
        $headers = 'Content-type:text/html;charset=utf8'."\r\n"."From:info.weightmentor@gmail.com";

        mail($email,'your password reset link',$message,$headers);
        if( mail($email,'your password reset link',$message,$headers)){
          echo "your message has been sent to ";
          echo $email;

      }else{
        echo "Oops there was an error sending your request. ";
      }

      }else{
        echo "<br/>This Email doesnt exist!.";
      }
     }

    }
  ?>

<div class="panel panel-default" height="auto" style="margin-left: 1%;;background-color:lightgrey;padding-bottom:5%;">
  <div id = "container">
   <h2 style ="margin-left:6%;">Password Reset</h2>
   <hr>
   <p style ="margin-left:6%;"> Please enter your email address and we will send you a link to reset your password.
   <form  method="post" action ="">
   
  
   <label style ="margin-left:6%;">Email:</label> <input type ="email" name ="emailA" id="input" value ="" required><br/>
     <button style ="margin-left:6%;" type='submit' name='home'>Return Home</button>
   <button  style ="margin-left:6%;" type="submit" name ="send" >Send Email</button>
 </form>

</div>
</div>

