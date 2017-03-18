<?php
//require_once ' ';
//base url: weightmentor.jadeosullivan.com/
include_once '../config/db.php';
global $connection;
class users{

function selectAllUsers(){
  //$res = mysql_query("SELECT * FROM  users  ORDER BY user_id ASC");
 
  $res = sqlQuery( "SELECT * FROM  users  ORDER BY user_id ASC");

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
function updateUsers($username,$name,$email,$image,$path,$about,$dob,$gender,$goalw, $currentw,$w_unit,$waist,$neck,$hips,$bust,$height,$m_unit,$h_unit,$id){

 // $res=mysql_query("UPDATE users SET user_name='$username', fullname ='$name', email='$email', profile_image='$image', image_content='$path', about_user='$about', dob='$dob', gender='$gender', goal_weight='$goalw', current_weight='$currentw', current_weight_unit= '$w_unit', waist='$waist', neck='$neck', hips='$hips', bust='$bust', height='$height',measurment_unit='$m_unit', height_unit='$h_unit' WHERE user_id='$id' ");
 
  $res= sqlQuery( "UPDATE users SET user_name='$username', fullname ='$name', email='$email', profile_image='$image', image_content='$path', about_user='$about', dob='$dob', gender='$gender', goal_weight='$goalw', current_weight='$currentw', current_weight_unit= '$w_unit', waist='$waist', neck='$neck', hips='$hips', bust='$bust', height='$height',measurment_unit='$m_unit', height_unit='$h_unit' WHERE user_id='$id' ");

  return $res;
}
function updateType($type,$id){
 // $res=mysql_query("UPDATE users SET user_type ='$type' WHERE user_id='$id' ");
  
  $res= sqlQuery("UPDATE users SET user_type ='$type' WHERE user_id='$id' ");

  return $res;
}
function updatePass($password,$email){
   
  $res= sqlQuery( "UPDATE users SET password='$password' WHERE email='$email'");

  // $res=mysql_query("UPDATE users SET password='$password' WHERE email='$email'");
  return $res;
}

//delete users from the table and insert into the deleted table
function deleteUsers($id){
  //find the user in the table.
  //$user =  mysql_query("SELECT * FROM  users WHERE user_id = '$id' LIMIT 1");
    $type='';
    $user =   sqlQuery("SELECT * FROM  users WHERE user_id = '$id' LIMIT 1");
 // while ($row = mysql_fetch_row($user)){
     if(mysqli_affected_rows($connection)){
    while ($row = fetch_row($user)){
    $user_id=$row[0];
    $username=$row[1];
    $type=$row[2];
    $name = $row[3];
    $email = $row[4];
    $password=$row[5];
    $about = $row[9];
    $dob = $row[10];
    $age = $row[11];
    $gender = $row[12];
    $goalw = $row[13];
    $sweight = $row[14];
    $cweight =$row[15];
    $weight_unit =$row[16];
    $bmi =$row[17];
    $bmr = $row[18];
    $bfp = $row[19];
    $waist = $row[20];
    $neck =$row[21];
    $hips =$row[22];
    $bust = $row[23];
    $height = $row[24];
      
    //$password = $row[4];
    $type =$row[2];
  }
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
    $insert =  sqlQuery( "INSERT INTO `deleted_users`( `user_name`,'user_type','fullname','email',`password`,'about_user','dob','age,gender','goal_weight','start_weight','current_weight','current_weight_unit','bmi','bmr','body_fat_percentage','waist','neck', 'hips', 'bust', 'height') VALUES ('$username','$type','$name','$email','$password','$about','$dob','$age','gender','$goalw','$sweight','cweight','$weight_unit','$bmi','$bmr','$bfp','$waist','$neck','$hips','$bust','$height')");
    //remove them from the users table
    $res =  sqlQuery( "DELETE FROM users WHERE user_id ='$id'");
     echo '<script type="text/javascript">window.location.replace("http://weightmentor.jadeosullivan.com/views/adminView.php");</script>';

    }
  
  }
  return $res;
}
function update_startWeight($startw,$id){
  //$res=mysql_query("UPDATE users SET start_weight='$startw' WHERE user_id ='$id' ");
   
  $res=sqlQuery( "UPDATE users SET start_weight='$startw' WHERE user_id ='$id' ");

  return $res;
}
function get_BMI_info($id){
  $res =  sqlQuery( "SELECT current_weight, current_weight_unit, height FROM users WHERE user_id = '$id'");
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
}
