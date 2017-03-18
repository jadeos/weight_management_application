<?php
include_once '../db_models/users.php';
    include_once '../index.php';
    $con = new users();
      $em =$_GET['email'];
  
   if(isset($_POST['home'])){
     header("Location: bloglist.php");
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
        if($row1=fetch_row($getAnswer)){
          if($row1[0]==$answer){
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

   <div id = "signup">
    <h2>Password Reset</h2>
    <hr>
    <form method="post" action ="">
    <label>Re-enter Email:</label> <input type ="email" name ="emailA" id="input" value =""required><br/>
    <label>Security Question: </label>
    <?php
         //get security question from database and print it out. 

          //display security question for the email address
         $question = $con->get_securityQuestion($em);
          if($row=fetch_row($question)){
            $quest=$row[0];
            echo "<label>".$quest."</label>";
        }
      
    ?>

   <br/>
   <label>Security Answer: </label>
   <input type="text" name="security_answer" required></input>
   <br/>
    <label>Password:</label> <input type ="password" name ="password" id="input" value ="" required=""><br/>
    <label>Confirm Password:  </label> <input type ="password" name ="cpassword"required=""><br/></br/>
    <div id ="buttons">
    <button type="submit" name ="resetPassword" id="update">Reset password</button>
    <div>
    </form>
    <div id="home">
     <form method="post" action ="">
     <button type="submit" name ="home" onclick="this.form.submit()">Cancel</button>
   </form>
   </div>
  </form>
  </div>
