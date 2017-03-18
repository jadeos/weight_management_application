<?php
/*
File used to manage users data
*/
  include '../index.php';
  if(!isset($_SESSION)){
    session_start();
  }
  ?>


   <div class="panel panel-default" style="margin-top:50px;margin-left:5%;">

     <div class="panel-heading">Users List</div>


   <?php

   $user = $con->searchUser($_SESSION['user_id']);


  if($row =fetch_row($user)){
       $id=$row[0];
       $user= $row[1];
       $pass=$row[5];
       $type =$row[2];

       if($type =="admin"){
         ?>
          <div class="panel-body">



<div class="table-responsive">
         <table class="table" width="40%;">
          <tr> <th style="padding:2px;">User Id</th><th style="padding:2px;">Username</th><th style="padding:2px;">Email Address</th><th style="padding:2px;">User Type</th><th style="text-align:right;padding-right:10px;">Actions</th></tr>
          <?php
          //get all users from the database
          $list = $con->selectAllUsers();
          while($row = fetch_row($list)){
            $id=$row[0];
            $user= $row[1];
            $email=$row[4];
            $pass=$row[5];
            $type =$row[2];
            //dispaly users data

            ?>
            <tr><td><?php echo $id?></td><td><?php echo $user ?></td><td><?php echo $email?></td>  <td><?php echo $type ?></td><td align ="right" style="padding-right:5px;"><form method ="post"action =""><input type='radio' name='user' id="admin" value="admin" <?php if($type=="admin"){echo "checked";}?> onclick="this.form.submit()">Admin</input><input type='radio'name='user' value='user' id="user" <?php if($type=="user"){echo "checked";}?>  onclick="this.form.submit()">User</input><input type="hidden" name="users_id" value="<?php echo $id ?>"></form><form method ="post"action =""><button type ='submit'class="btn btn-default" name='delete'>Delete this user</button><input type="hidden" name="users_id" value="<?php echo $id ?>"></form></td></tr>
              <?php
          }

        //update user type with radio buttons
        if(isset($_POST['user'])){
          $update= $con->updateType($_POST['user'],$_POST['users_id']);
        }
        //delete the user from the database
       if(isset($_POST['delete'])){

       $delete=$con->deleteUsers($_POST['users_id']);
       echo '<script type="text/javascript">window.location.replace("http://weightmentor.jadeosullivan.com/views/adminView.php");</script>';
       //send user an email to let them know there account has been removed.
       $to = $email ;
       $subject = "Confirmation that your account has been deleted by the administrator.";
         $headers = 'Content-type:text/html;charset=utf8'."\r\n"."From:info.weightmentor@gmail.com";
       $body ="Hi $user This message confirms that the Administrator of Weight Mentor has deleted your account.<br/> This email has been sent for the following reasons: <br/> 1. You have requested that we shut down your account. <br/>2. We have received a number of complaints in relation to your account. <br/>3.Your account has been compromised.<br/> <br/> If you have not requested that we shut down your account please do not hesitate to contact our team.You can email us at info.weightmentor@gmail.com .<br/><br/>Regards Weight Mentor Administration Team. ";
       if (mail ($to, $subject, $body, $headers)) {
        echo'<div class="alert alert-success">An Email has been sent to this users account.</div>';
       }
     }
        ?>
        </table>
      </div>
      </div>
        <?php
     }else{
       echo "Please login to view this content";
     }
}

  ?>
  </div>

