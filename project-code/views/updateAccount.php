
<?php
/* 
  Update the users account page. 
  Author Jade O'Sullivan
  Date Modified: 1/5/17

*/
     include_once '../index.php';
     include_once '../classes/updateUser.php';

  if($_SESSION['loggedin']==true){
    $con = new users();
    $getUser = $con->searchUser($_SESSION['user_id']);

    if($row=mysqli_fetch_array($getUser)){
      $id=$row['user_id'];
     $username = $row['user_name'];
     $name=$row['fullname'];
      $email=$row['email'];
      $dob=$row['dob'] ;
      $gender=$row['gender'];
      $profile_pic=$row['image_content'];
       $about_user = $row['about_user'];
      $cw=$row['current_weight'];
      $gw= $row['goal_weight'];
      $height= $row['height'];
      $neck=$row['neck'];
      $hips=$row['hips'];
      $bust=$row['bust'];
      $waist= $row['waist'];
      $h_unit=$row['height_unit'];
      $w_unit=$row['current_weight_unit'];

     // if there is no starting weight set it to the current weight.And add it to the database
      if($row['start_weight']==0){
        $row['current_weight']=$row['start_weight'];
      }


 ?>
<!--Bootstrap Page version -->
<div class="panel panel-default" height="auto" style="margin-left: 1%;;background-color:lightgrey">
    <div class="panel-heading">Update Account Information </div>
     <form action="" method="post" accept-charset="utf-8" class="form" role="form" enctype="multipart/form-data">
        <div class="form-group row" style="padding-top:2%;padding-left:15%;"> 
          <div class="col-xs-4">
            <label for="fullname">Full Name:</label>
            <input class="form-control" name="fullname" type="text" id="name" value="<?php echo $name; ?>" required />
          </div>
        </div>
         <div class="form-group row" style="padding-top:2%;padding-left:15%;">
            <div class="col-xs-4">
            <label for="username">Username:</label>
            <input class="form-control" name="username" type="username" id="username" value="<?php echo $username; ?>"required />
          </div>
           <div class="col-xs-4">
            <label for="bday">Date Of Birth:</label><br/>
            <input id ="dateT" type="date" value ='<?php echo $dob ?>' name="bday" onchange="getDate()" ><br/>
             <input id = "finalDate" type="hidden" value="<?php echo $dob ?>" name="bDay">
           <script>
            function getDate(){
             var mydate= getId("dateT").value;
             getId("finalDate").value=mydate;
            }
           </script>
          </div>
        </div>
         <div class="form-group row" style="padding-top:2%;padding-left:15%;">
         <div class="col-xs-4">
           <label for="gender">Gender:</label><br/>
           <label >
            <input type="radio" name="gender" value="male" id="male"<?php if( $gender=="male") { echo "checked";}?>/>  Male
           </label>
           <label >
             <input type="radio" name="gender" value="female" id="female"<?php if ($gender=="female"){ echo "checked";}?> />Female
           </label>
         </div>
          <div class="col-xs-4">
            <label for ="profile_pic">Profle Photo: </label><Br/>
            <input type="file"   id="photo" name="profile_pic" id="fileToUpload" accept="image/*"/>
          </div>

        </div>
        <div class="form-group row" style="padding-top:2%;padding-left:15%;">
         <div class="col-xs-8">
          <label for= "about_user">About Me</label>
            <textarea id ="about"  name="about_user"   rows="8" style="min-width: 100%"><?php echo $about_user;?></textarea> 
         </div>
        </div>
        <div class="form-group row" style="padding-top:2%;padding-left:15%;">
         <div class="col-xs-2">
          <label for= "goalw">Goal Weight:</label>
          <input type ="text" value="<?php echo $gw;?>"name="goalw">
         </div>
         <div class="col-xs-2">
          <label for= "currentw">Current Weight:</label>
          <input type ="text" value=" <?php echo $cw;?>" name="currentw">
         </div>
         </div>
            <div class="form-group row" style="padding-top:2%;padding-left:15%;">
           <div class="col-xs-4">
            <label for= "unit">Weight Unit:</label>
            <label >
              <input type="radio" name="unit" value="kg" <?php if($w_unit=="kg"){ echo "checked";} ?>/>KGS
            </label>
            <label >
              <input type="radio" name="unit" value="lbs" <?php if($w_unit=="lbs"){ echo "checked";}?>/>LBS
            </label>
            <label >
             <input type="radio" name="unit" value="stone" <?php if ($w_unit=="stone"){ echo "checked";}?>/>Stone
            </label>
        
          </div>
      
         
         </div>
         <div class="form-group row" style="padding-top:2%;padding-left:15%;">
           <div class="col-xs-2">
             <label for= "height">Height:</label>
              <input type ="text" name="height" value="<?php echo $height;?>">
              </div>
               <div class="col-xs-2">
             <label for= "height_unit">Height Unit:</label><br/>
              <label >
              <input type ="radio" name="height_unit" value="cm" <?php if( $h_unit =="cm") { echo "checked";}?>/>CM
              </label>
              <label >
              <input type ="radio" name="height_unit" value="inches" <?php if( $h_unit =="inches") { echo "checked";}?>/>Inches
              </label>
              <label >
              <input type ="radio" name="height_unit" value="feet" <?php if( $h_unit =="feet") { echo "checked";}?>/>Feet
              </label>
            </div>
            </div>
        
          <div class="form-group row" style="padding-top:2%;padding-left:45%;">
           <div class="col-xs-8">
            <a href ="profile.php?id='<?php echo $_SESSION['user_id'];?>'">Back To Profile</a>
           <button name="update_account" type="submit">Update My Account</button>
          </div>
          </div>
          
         <br/><br/>
           <br/><br/>
             <br/><br/>




     </form>

</div>
</div>


        
      

 
<?php
 }
    }else{
        ?>
        <div class="panel-heading">Please Log in to View Your Profile</div>

        <?php

       }



        ?>
 
