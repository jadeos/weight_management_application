<?php
require_once '../database_functions/users.php';

require_once '../database_functions/weight_log.php';

$con = new users();
 $weight = new weight_log();
$helper  = new functions();
if(isset($_POST['register'])){
  $username=escapeStrings(stripslashes($_POST['username']));
  $password =escapeStrings(stripslashes($_POST['password']));
  $cpassword=escapeStrings(stripslashes($_POST['cpassword']));
  $name =escapeStrings(stripslashes($_POST['fullname']));
  $email =escapeStrings(stripslashes($_POST['email']));
  $gender =escapeStrings(stripslashes($_POST['gender']));
  $sec_question = escapeStrings(stripslashes($_POST['question']));
  $security_answer =escapeStrings(stripslashes($_POST['sec_answer']));




  //current weight is starting weight 
  $cweight =escapeStrings(stripslashes($_POST['currentw']));
  
  $wunit =escapeStrings(stripslashes($_POST['unit']));
  $hunit =escapeStrings(stripslashes($_POST['height_unit']));
   $height =escapeStrings(stripslashes($_POST['height']));


 


 //  //CHECK UNITS 
  if($wunit=="stone"){
  $wunit="stone";
 }else if($wunit=="lbs"){
  $wunit="lbs";
 }else{
  $wunit="kgs";
 }  

 if($hunit =="feet"){
  $hunit="feet/inches";
 } else if($hunit =="cm"){
    $hunit="cm";
 }else{
  $h_unit="inches";
 }
          
          $profile_pic =" ";
  //check gender values
  if($gender =="M"){
    $gender = "male";
    $profile_pic ="../img/icons8-user-male-26.png"; 
  }else{
    $gender ="female";
    $profile_pic ="../img/icons8-female-user-26.png"; 
  }

 $dob = date('Y-m-d', strtotime($_POST['bDay']));
$byear = explode('-', $dob);
$year = $byear[0];
$month =$byear[1];
$day = $byear[2];
$date1=date_create($dob);
$date2=date_create(date('Y-m-d'));
$diff=date_diff($date1,$date2);
$daydiff = $diff->format("%R%a days");
$years = $daydiff / 365;
$age = floor($years);

echo $helper->console_log("The age is: ".$age);
 
 

//  $date1=date_create($dob);
// $date2=date_create(date('y-m-d'));
// $diff=date_diff($date1,$date2);
// echo $helper->console_log("The difference is: ".$diff);
//echo $age;


//$month   = $orderdate[1];
//$day  = $orderdate[2];

// echo getAge($year, $month, $day);
// function getAge($year, $month, $day){
//     $date = "$year-$month-$day";
//     if(version_compare(PHP_VERSION, '5.3.0') >= 0){
//         $dob = new DateTime($date);
//         $now = new DateTime();
//         return $now->diff($dob)->y;
//     }
//     $difference = time() - strtotime($date);
//    // echo $difference/31556926;
//     return floor($difference / 31556926);
// }
 


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

      //$security_question,$security_answer,$startw,$cweight,$wunit,$height,$heightunit
      //add the to the database.
//   $res=$con->signup($username,$name,$email,$password,$dob,$gender,$sec_question,$security_answer,$sweight,$cweight,$wunit,$height,$hunit);
      $res=$con->signup($username,$name,$email,$hashed_pass,$profile_pic,$dob,$age,$gender,$cweight,$cweight,$wunit,$height,$hunit,$sec_question,$security_answer);

      //Log customer in to the acc after registration
      $res1=$con->login($username);
      if($row=mysqli_fetch_array($res1)){

      $user_id=$row['user_id'];
      $_SESSION['user_id']=$user_id;
       $_SESSION['loggedin']=true;
       if(isset($_COOKIE['loginUser'])){
          unset($_COOKIE['loginUser']);
          }
          if(isset($_COOKIE['login'])){
          unset($_COOKIE['login']);
          }
          //insert weight into weight log table so can view history
        $rm= $weight->insertWeight($cweight,$user_id);
        echo $helper->redirect("../views/profile.php?id=".$_SESSION['user_id']);

      }
  




    }
  }
}
 
