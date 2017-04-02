<?php
require_once '../database_functions/users.php';

//require_once '../database_functions/weight_log.php';

$con = new users();
// $weight = new weight_log();
$helper  = new functions();
if(isset($_POST['register'])){
  $username=escapeStrings(stripslashes($_POST['username']));
  $password =escapeStrings(stripslashes($_POST['password']));
  $cpassword=escapeStrings(stripslashes($_POST['cpassword']));
  $name =escapeStrings(stripslashes($_POST['fullname']));
  $email =escapeStrings(stripslashes($_POST['email']));
  $gender =escapeStrings(stripslashes($_POST['gender']));
  //check gender values
  if($gender =="M"){
    $gender = "male";
  }else{
    $gender ="female";
  }
 $dob = date('y-m-d', strtotime($_POST['bDay']));
  $hashed_pass = password_hash($password,PASSWORD_DEFAULT);
  //checking passwords match,then charactors. The password must be a)6charactors in length b)have a cap letter at the start and contain a number
  if($password != $cpassword){
    echo '<div class="alert alert-warning" style="margin:60px">Password dont match</div>';
  }else if((!strlen($password)>5)||(!ctype_upper($password[0]))||(! preg_match('~[0-9]~', $password))){
    echo '<div class="alert alert-warning" style="margin:60px">Password must be at least 6 charactors in lenght<br/> THe first letter must be uppercase and their must be a number</div>';

  }else{
  //check to see if user exists
  $exists=$con->login($username);
    //if the user exist, display error messages
   $email_exists = $con-> searchEmail($email);

    if ($row=fetch_row($exists)){
      echo '<div class="alert alert-warning" style="margin:60px">Error this username already exists please enter a different username<?div>';
    }else if ($row=fetch_row($email_exists)){
        echo '<div class="alert alert-warning"style="margin:60px">Error this Email Address already exists please enter a different Email Address or log in using this email</div>';
    }else{

      //add the to the database.
      $res=$con->signup($username,$name,$email,$hashed_pass,$dob,$gender);
      echo '<div class ="alert alert-success" style="margin:60px">This account has been created. PLease <a href="index.php">login </a> to your account<?div>';




    }
  }
}
 
