<?php
include_once '../database_functions/users.php';
    include_once '../index.php';
    $con = new users();
      $em =$_GET['email'];
  
   if(isset($_POST['home'])){
     header("Location: home.php");
   }
   if(isset($_POST['resetPassword'])){
     $email=$_POST['emailA'];
     $password =$_POST['password'];
     $confirm = $_POST['cpassword'];
     $answer =$_POST['security_answer'];
   
     if($confirm !=$password){
       echo "Passwords dont match!";
     }else if((!strlen($password)>5)||(!ctype_upper($password[0]))||(! preg_match('~[0-9]~', $password))){
       echo "Password must be at least 6 charactors in lenght<br/> THe first letter must be uppercase and their must be a number";
     }else{

       $getAnswer=$con->getSecurityAnswer($answer,$em);
      //IF IT EXISTS!
        if($row1=mysqli_fetch_array($getAnswer)){
          if($row1['security_answer']==$answer){
         //check if email exists in db before updating
         $emailCheck=$con->searchEmail($email);
         if($row=fetch_row($emailCheck)){

         //we can now update the password.
          $hashed_pass = password_hash($password,PASSWORD_DEFAULT);
          $pass =$con->updatePass($hashed_pass,$email);
            echo "password changed";
            header("Location: index.php");
          }else{
            echo "That email doesnt exist on our system";
          }
        }else{
          echo "Invalid Security Answer";
        }
      }
    }
  }
   ?>
<div class="panel panel-default" height="auto" style="margin-left: 1%;;background-color:lightgrey;padding-bottom:5%;">
  <div id = "container">
   <div id = "signup">
    <h2 style ="margin-left:6%;">Password Reset</h2>
    <hr>
    <form method="post" action ="">
    <label style ="margin-left:6%;">Re-enter Email:</label> <input type ="email" name ="emailA" id="input" value =""required><br/>
    <label style ="margin-left:6%;">Security Question: </label>
    <?php
         //get security question from database and print it out. 

          //display security question for the email address
         $question = $con->get_securityQuestion($em);
          if($r=mysqli_fetch_array($question)){
            $quest=$r['security_question'];
            echo "<label>".$quest."</label>";
        }
      
    ?>

   <br/>
   <label style ="margin-left:6%;">Security Answer: </label>
   <input type="text" name="security_answer" required></input>
   <br/>
    <label style ="margin-left:6%;">Password:</label> <input type ="password" name ="password" id="input" value ="" required=""><br/>
    <label style ="margin-left:6%;">Confirm Password:  </label> <input type ="password" name ="cpassword"required=""><br/></br/>
    <div id ="buttons">
    <button style ="margin-left:6%;" type="submit" name ="resetPassword" id="update">Reset password</button>
    <div>
    </form>
    <div id="home">
     <form method="post" action ="">
     <button type="submit"  style ="margin-left:6%;" name ="home" onclick="this.form.submit()">Cancel</button>
   </form>
   </div>
  </form>
  </div>
  </div>
  </div>
