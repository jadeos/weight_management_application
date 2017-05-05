<?php



  include_once '../database_functions/weight_log.php';
$con =new users();
$weight =new weight_log();
 $helperr  = new functions();
if(isset($_POST['update_account'])){

  $username=escapeStrings(stripslashes($_POST['username']));

  $name =escapeStrings(stripslashes($_POST['fullname']));
  //$email =escapeStrings(stripslashes($_POST['email']));
  $gender =escapeStrings(stripslashes($_POST['gender']));
  //check gender values
  if($gender =="male"){
    $gender = "male";
  }else{
    $gender ="female";
  }
 $dob = date('y-m-d', strtotime($_POST['bDay']));
 //profile_image upload to file and store file path in db
 $image =$_FILES['profile_pic']['name'];
 $image_data =$_FILES['profile_pic']['tmp_name'];
 $path ="../img/".$image;
 move_uploaded_file($image_data,$path);

 $about =$_POST['about_user'];
 $goalw=$_POST['goalw'];
 $currentw =$_POST['currentw'];
 $height =$_POST['height'];

 $other_info = $con->searchUser($_SESSION['user_id']);
 $email=" ";
 if($r = mysqli_fetch_array($other_info)){
  $email = $r['email'];
 }
 // $hips=$_POST['hips'];
 // $bust=$_POST['bust'];
 // $neck=$_POST['neck'];
 // $waist=$_POST['waist'];
 // $m_unit=$_POST['measurment_unit'];
 //check measurment units
 // if($m_unit =="cm"){
 //  $m_unit="cm";

 // }else {
 //  $m_unit="inches";
 // }

 
 $h_unit = $_POST['height_unit'];
 //check height unit
 if($h_unit =="feet"){
  $h_unit="feet";

 }else{
  $h_unit="inches";
 }
 $w_unit = $_POST['unit'];
 //check weight unit
 if($w_unit=="stone"){
  $w_unit="stone";
 }else if($w_unit=="lbs"){
  $w_unit="lbs";
 }else{
  $w_unit="kgs";
 }



   $exists=$con->updateUsers($username,$name,$image,$path,$about,$dob,$gender,$goalw,$currentw,$w_unit,$height,$h_unit,$_SESSION['user_id']);
       $weight_insert=$weight->insertWeight($currentw,$_SESSION['user_id']);

        echo'<div class="alert alert-success"style="margin-top:4%">This Account Has been updated</div>';
        echo $helperr->redirect("profile.php?id=".$_SESSION['user_id']);







}

if(isset($_POST['profileu'])){
  echo $helperr->redirect("profile.php?id=".$_SESSION['user_id']);
}
?>
