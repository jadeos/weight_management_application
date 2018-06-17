<?php
//ignore warning message relating to session

 if(!isset($_SESSION)){
      session_start();
    }

?>

<body>
<nav class="navbar navbar-default navbar-fixed-top" >
  <div class="container-fluid" style="background-color:#6a378a; color:#ffffff;">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="#" class="img-rounded pull-left " ><img src="../img/logo.png"> </a>
             <a class="navbar-brand" href="#" style=" color:#ffffff;"></a>
    </div>
     <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav" >
      <li><a href="../views/home.php" style=" color:#ffffff;">Home</a></li>


    <?php
    
   
    if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) {


     $user =$con->searchUser($_SESSION['user_id']);

     if($row=mysqli_fetch_array($user)){
      //register the service worker if the user is logged in. 
      ?>

          <script>
    if('serviceWorker' in navigator) {
         navigator.serviceWorker.register('/service_workers.js').then(function(reg) { 
           // console.log("Service Worker Registered"); 
            reg.addEventListener("updatefound", function(event) {
              var worker = reg.installing
              //update the service worker on page 
              reg.installing.addEventListener("statechange", function(e) {
                  if(worker.state == "installed"){
                    worker.postMessage({action: "update"});
                  }

              })
            });
          });
}
</script>
       <li><a href="profile.php?id='<?php echo $_SESSION['user_id'];?>" style=" color:#ffffff;">My Profile</a></li>
       <?php
       if($row['user_type']=="admin"){
       //IF THE USER IS A REGUALR USER OR ADMIN.
       ?>
       <li> <a href="../views/adminView.php?type=admin&privil=true" style=" color:#ffffff;" name ="profile">Admin Panel</a></li>
       </ul>

       <?php
        }
       $name =$row['fullname'];
       ?>
       <ul class="nav navbar-nav navbar-right">
           <li><a href="../views/profile.php?id='<?php echo $_SESSION['user_id'];?>"  style=" color:#ffffff;">
            <?php echo "Welcome ". $name;?></a></li>
        
          
      
       <li><a href="../views/settings.php?id=?id='<?php echo $_SESSION['user_id'];?>"  style=" color:#ffffff;">Settings</a></li>
         <?php
      }
                 
      ?> 
     
      <li><a href="../classes/logout.php" name="logout" style=" color:#ffffff;">Log Out</a></li>
    </ul>
      <?php

   }else{
    ?>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#myModal" class="showModel" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#myModal" style=" color:#ffffff;">Login/Register</a></li>
   </ul>
   <?php
    }
    ?>
  </div>
 </div>
</nav>
     


