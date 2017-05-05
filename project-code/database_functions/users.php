<?php
//require_once ' ';
//base url: weightmentor.jadeosullivan.com/
//include_once '../config/db.php';
include_once '../database/database.php';
global $connection;
class users{

function selectAllUsers($start_from, $limit){
  //$res = mysql_query("SELECT * FROM  users  ORDER BY user_id ASC");
 
  $res = sqlQuery("SELECT * FROM  users  ORDER BY user_id LIMIT $start_from, $limit");

  return $res;

}
function AllUsers(){
  //$res = mysql_query("SELECT * FROM  users  ORDER BY user_id ASC");
 
  $res = sqlQuery("SELECT COUNT(*)`total` FROM  users");

  return $res;

}
///log in user
function login($username){
    $res =sqlQuery("SELECT * FROM  users WHERE user_name = '$username' LIMIT 1");
    return $res;
}
///log in user
function searchUser($id){
   // $res = mysql_query("SELECT * FROM  users WHERE user_id = '$id' LIMIT 1");
  
     $res =  sqlQuery( "SELECT * FROM  users WHERE user_id = '$id' LIMIT 1");
   
    return $res;
}
function searchEmail($email){
  //$res = mysql_query("SELECT * FROM  users WHERE email = '$email' LIMIT 1");
  
  //$res=sqlQuery( "SELECT * FROM  users WHERE email = '$email' LIMIT 1");
   $res =  sqlQuery( "SELECT * FROM users WHERE email = '$email' LIMIT 1");
    return $res;
}

//register user
function signup($username,$name,$email,$password,$dob,$gender){
  
    $res =sqlQuery( "INSERT into users (user_name, fullname,email,password,dob,gender) VALUES('$username','$name','$email','$password','$dob','$gender')");
  
   //   $res = mysql_query("INSERT into users (user_name, fullname,email,password,dob,gender) VALUES('$username','$name','$email','$password','$dob','$gender')");
   return $res;
}
//update user information
function updateUsers($username,$name,$image,$path,$about,$dob,$gender,$goalw, $currentw,$w_unit,$height,$h_unit,$id){

 // $res=mysql_query("UPDATE users SET user_name='$username', fullname ='$name', email='$email', profile_image='$image', image_content='$path', about_user='$about', dob='$dob', gender='$gender', goal_weight='$goalw', current_weight='$currentw', current_weight_unit= '$w_unit', waist='$waist', neck='$neck', hips='$hips', bust='$bust', height='$height',measurment_unit='$m_unit', height_unit='$h_unit' WHERE user_id='$id' ");
 
  $res= sqlQuery( "UPDATE users SET user_name='$username', fullname ='$name', profile_image='$image', image_content='$path', about_user='$about', dob='$dob', gender='$gender', goal_weight='$goalw', current_weight='$currentw', current_weight_unit= '$w_unit', height='$height', height_unit='$h_unit' WHERE user_id='$id' ");


}
function updateType($type,$id){
 // $res=mysql_query("UPDATE users SET user_type ='$type' WHERE user_id='$id' ");
  
  $res= sqlQuery("UPDATE users SET user_type ='$type' WHERE user_id='$id' ");


}
function updatePass($password,$email){
   
  $res= sqlQuery( "UPDATE users SET password='$password' WHERE email='$email'");

  // $res=mysql_query("UPDATE users SET password='$password' WHERE email='$email'");

}

//delete users from the table and insert into the deleted table
function deleteUsers($id){
  //find the user in the table.
  //$user =  mysql_query("SELECT * FROM  users WHERE user_id = '$id' LIMIT 1");
    $type='';
    $user = sqlQuery("SELECT * FROM  users WHERE user_id = '$id' LIMIT 1");
 // while ($row = mysql_fetch_row($user)){
  //if(mysqli_affected_rows($connection)){
    if($row = mysqli_fetch_array($user)){
    $user_id=$row['user_id'];
    $username=$row['user_name'];
    $type=$row['user_type'];
    $name = $row['fullname'];
    $email = $row['email'];
    $password=$row['password'];
    $about = $row['about_user'];
    $dob = $row['dob'];
    $age = $row['age'];
    $gender = $row['gender'];
    $goalw = $row['goal_weight'];
    $sweight = $row['start_weight'];
    $cweight =$row['current_weight'];
    $weight_unit =$row['current_weight_unit'];
    $bmi =$row['bmi'];
    $bmr = $row['bmr'];
    $bfp = $row['body_fat_percentage'];
    $waist = $row['waist'];
    $neck =$row['neck'];
    $hips =$row['hips'];
    $bust = $row['bust'];
    $height = $row['height'];
    $height_unit =$row['height_unit'];
    $security_question=$row['security_question'];
    $security_answer=$row['security_answer'];
      
    //$password = $row[4];
    $type =$row['user_type'];
   // echo $user_id." ".$username." ".$type." ".$email." ".$height." ".$height_unit." ".$security_question." ".$security_answer;
  //}
    //we cant delete the admin user
    if($type=="admin"){
        echo  '<div class="alert alert-danger">Warning- You Cannot Delete an Admin User.<br/>Try updating users status from Admin to User.</div>';
        return false;
    }else{
    //insert them into the deleted users table
    // $insert = mysql_query("INSERT INTO `deleted_users`( `user_name`,'user_type','fullname','email',`password`,'about_user','dob','age,gender','goal_weight','start_weight','current_weight','current_weight_unit','bmi','bmr','body_fat_percentage','waist','neck', 'hips', 'bust', 'height') VALUES ('$username','$type','$name','$email','$password','$about','$dob','$age','gender','$goalw','$sweight','cweight','$weight_unit','$bmi','$bmr','$bfp','$waist','$neck','$hips','$bust','$height')");
    // //remove them from the users table
    // $res = mysql_query("DELETE FROM users WHERE user_id ='$id'");
    //  echo '<script type="text/javascript">window.location.replace("http://weightmentor.jadeosullivan.com/views/adminView.php");</script>';
   //insert them into the deleted users table
    $insert =  sqlQuery( "INSERT INTO deleted_users (user_name,user_type,fullname, email,password,about_user,dob,age,gender,goal_weight,start_weight,current_weight,current_weight_unit,bmi,bmr,body_fat_percentage,waist,neck,hips, bust,height,height_unit,  security_question,security_answer) VALUES ('$username','$type','$name','$email','$password','$about','$dob','$age','gender','$goalw','$sweight','cweight','$weight_unit','$bmi','$bmr','$bfp','$waist','$neck','$hips','$bust','$height','$height_unit','$security_question','$security_answer')");

    // //remove them from the users table
     $res =  sqlQuery( "DELETE FROM users WHERE user_id ='$id'");
     // echo '<script type="text/javascript">window.location.replace("https://weightmentor.eu/views/adminView.php");</script>';

    }
  
  }
  return $res;
}
function update_startWeight($startw,$id){
  //$res=mysql_query("UPDATE users SET start_weight='$startw' WHERE user_id ='$id' ");
   
  $res=sqlQuery( "UPDATE users SET start_weight='$startw' WHERE user_id ='$id' ");


}
function get_BMI_info($id){
  $res =  sqlQuery( "SELECT current_weight, goal_weight, current_weight_unit, height, height_unit FROM users WHERE user_id = '$id'");
  return $res;

}

function get_securityQuestion($email){
  $res = sqlQuery("SELECT security_question FROM users WHERE email='$email' ");
  return $res;
}
function getSecurityAnswer($answer,$email){
  $res = sqlQuery("SELECT security_answer from users WHERE email='$email' ");
  return $res;
}

function updateBmi($BMI,$user_id){
  $res  = sqlQuery("UPDATE users SET bmi = '$BMI' WHERE user_id = '$user_id'");
}

function update_current_weight($goal_weight,$start_weight,$weight,$unit,$user_id){
  $res = sqlQuery("UPDATE users SET goal_weight ='$goal_weight', start_weight='$start_weight', current_weight='$weight',current_weight_unit='$unit' WHERE user_id = '$user_id'");

}

function updateEmail($email,$user_id){
  $res = sqlQuery("UPDATE users SET email ='$email' WHERE user_id = '$user_id'");

}

function checkpass($user_id){
  $res=sqlQuery("SELECT password, email FROM users WHERE user_id='$user_id' LIMIT 1");
  return $res;
}

function updateSecurity($security_question,$security_answer,$user_id){
  $res = sqlQuery("UPDATE `users` SET security_question='$security_question',security_answer='$security_answer' WHERE user_id='$user_id'");

}


function insert($user_id,$user_name,$password){
$res =sqlQuery( "INSERT into users (user_id, user_name,password) VALUES('$user_id','$user_name','$password')");
}

}