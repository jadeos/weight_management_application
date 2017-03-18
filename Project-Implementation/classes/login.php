<?php
require_once '../db_models/users.php';

//require_once '../database_functions/weight_log.php';
global $connection;
$con = new users();
// $weight = new weight_log();
$helper  = new functions();
if(isset($_POST['reset'])){
  // header("Location: passwordReset.php");
echo $helper->redirect("passwordReset.php");
}



//logs user in
  if(isset($_POST['login'])){
   
    //remember the user
       if(isset($_POST['rememberme'])){
         $year= time() + 31536000;
         setcookie('remember_me', $_POST['username'], $year);
       }else {
      	if(isset($_COOKIE['remember_me'])) {
      		$past = time() - 100;
      		setcookie(remember_me, gone, $past);
      	}
      }

    $username=escapeStrings(stripslashes($_POST['username']));
    $password =escapeStrings(stripslashes($_POST['password']));
    $res =$con->login($username);
    if(mysqli_affected_rows($connection)){
    if($row=mysqli_fetch_array($res)){

      $user_id=$row[0];
      $user_name=$row[1];
      $user_password=$row[5];

  
      if(password_verify($password,$user_password)){
        if(!isset($_SESSION)){
          session_start();
        }
    
        //check if user has 3 failed attempts.
          if($_COOKIE['loginUser']==$user_id){    
            echo '<div class="alert alert-warning" style="margin:60px">You have three failed log in attempts. PLease try agiain in 30 mins.</div>';
              include 'login.php';
        }else{
          $_SESSION['user_id']=$user_id;
          $_SESSION['loggedin']=true;
          unset($_COOKIE['loginUser']);
          unset($_COOKIE['login']);
          echo $helper->redirect("../views/profile.php?id=".$_SESSION['user_id']);
        }

      }else{
        echo '<div class="alert alert-warning">Your details are incorrect</div>';
        if(isset($_COOKIE['login'])){
          if($_COOKIE['login'] < 3){
             $attempts = $_COOKIE['login'] + 1;
            setcookie('login', $attempts, time()+60*30);


           }else{
            echo '<div class="alert alert-warning">You have three failed log in attempts. PLease try agiain in 30 mins</div>' ;
              setcookie('loginUser', $user_id, time()+60*30);
             
           }

         }else{
           //set the cookie to ban users from logging in for 30 mins
           setcookie('login', 1, time()+60*30);
         }

      }
      include 'login.php';
   }else{
     echo '<div class="alert alert-warning" >Invalid login</div>';
   
     
     include 'login.php';
       ?>
     <br/><br/>
     <?php
     
   }
 }
}

//login with fitbit option 
if(isset($_POST['login_with_fitbit'])){
 
   if(!isset($_SESSION)){
          session_start();
     }

  //set logged in session varable
   $_SESSION['user_id']=rand(345,789234567);
   $_SESSION['loggedin']=true;
   $_SESSION['fitbit']=true;
   require_once '../assets/js/fitbit.php';

   

    echo $helper->console_log("user". $_SESSION['user_id']);

    

   //  echo $helper->console_log("loggedin".$_SESSION['loggedin']);
   //   echo $helper->console_log("fitbit" .$_SESSION['fitbit']);

//echo $helper-> redirect("profile.php?id=".$$_SESSION['user_id']. )

  
}


