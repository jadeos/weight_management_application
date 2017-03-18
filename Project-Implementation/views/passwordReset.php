<?php
  include_once '../index.php';

  include_once '../db_interactions/users.php';

  $con = new Users();
 ?>

  <?php
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
      if($row=fetch_row($emailCheck)){
        $message ="HI there, please click herehttp://jadeosullivan.com/Project-Implementation/views/resetform.php?email=".$email." to reset your password.<br/>Please do not reply to this email. This is automatically generated.<br/>If you havent requested to update your password, please ignore this email <br/>regards staff";
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
</head>
<body>
  <div id = "">
   <h2>Password Reset</h2>
   <hr>
   <p> Please enter your email address and we will send you a link to reset your password.
   <form method="post" action ="">
   
  
   <label>Email:</label> <input type ="email" name ="emailA" id="input" value ="" required><br/>
     <button type='submit' name='home'>Return Home</button>
   <button type="submit" name ="send" >Send Email</button>
 </form>

</div>
</body>
