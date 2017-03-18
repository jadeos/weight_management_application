<?php
//ignore warning message relating to session
error_reporting(E_ERROR | E_PARSE);

?>
<nav class="navbar navbar-default navbar-fixed-top" >
  <div class="container-fluid" style="background-color:#6a378a; color:#ffffff;">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="#" class="img-rounded pull-left " ><img src="../assets/img/logo.png"> </a>
             <a class="navbar-brand" href="#" style=" color:#ffffff;"></a>
    </div>
     <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav" >
      <li><a href="../views/home.php" style=" color:#ffffff;">Home</a></li>

    <?php
    
        if(!isset($_SESSION)){
         session_start();
        }
        if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) {
         $user =$con->searchUser($_SESSION['user_id']);
         if($row=fetch_row($user)){
          if($row[2]=="admin"){
       //IF THE USER IS A REGUALR USER OR ADMIN.
       ?>
       <li> <a href="../views/adminView.php" style=" color:#ffffff;" name ="profile">Admin Panel</a></li>
       <?php
        }
      }
      ?> 
      <li><a href="../views/profile.php" style=" color:#ffffff;">My Profile</a></li>
      <li><a href="../classes/logout.php " name="logout" style=" color:#ffffff;">Log Out</a></li>
    </ul>
      <?php
   }else{
    ?>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#myModal" data-toggle="modal" data-target="#myModal" style=" color:#ffffff;">Login/Register</a></li>
   </ul>
   <?php
    }
    ?>
  </div>
 </div>
</nav>
