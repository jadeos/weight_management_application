
<?php
/*
File used to manage users data, google analytics etc
*/
  include '../index.php';
  if(!isset($_SESSION)){
    session_start();
  }


   if($_SESSION['loggedin']==true){
  ?>
   <div class="panel panel-default" style="margin-left:1%; background-color:lightgrey;">
   <div class="panel-heading" id ="panel" style="background-color: grey;">Admin Panel</div>
   <ul class="nav nav-tabs">
        <li role="presentation" id="anal"><a href ="#analytics" id="ana" data-toggle="tab" onclick ="changeToAnalytics(), setAdminTab(0)" >Analytics Overview</a><li>
        <li role="presentation" id="userL">  <a href ="#usersL" id ="users_tab"  data-toggle="tab" onclick ="changeToUsers(), setAdminTab(1)">Users List</a></li>
        
           
      </ul>
   


   <?php

   $user = $con->searchUser($_SESSION['user_id']);


  if($row =mysqli_fetch_array($user)){
       $id=$row['user_id'];
       $user= $row['user_name'];
       $pass=$row['password'];
       $type =$row['user_type'];

       if($type =="admin"){
         ?>
          

      <!--Google Analytics --> 
      

      <div id="analytics" style=" margin-left:6%;">
      <h3 style=" margin-left:6%;">Analytics Dashboard</h3>
      <section id="auth-button" style="display:inline; margin-left:6%;"></section>
      <section id="view-selector" style="display:inline; margin-left:6%;"></section>
      <section id="timeline" style="display:inline; margin-left:6%;"></section>
      <br/>
<br/>
<br/>
<br/>


 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script>
(function(w,d,s,g,js,fjs){
  g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(cb){this.q.push(cb)}};
  js=d.createElement(s);fjs=d.getElementsByTagName(s)[0];
  js.src='https://apis.google.com/js/platform.js';
  fjs.parentNode.insertBefore(js,fjs);js.onload=function(){g.load('analytics')};
}(window,document,'script'));
</script>

<script>
gapi.analytics.ready(function() {

  var CLIENT_ID = '298078751314-2e565sjcm4r2u2h8s7i6gvnurpk69e2l.apps.googleusercontent.com';

  gapi.analytics.auth.authorize({
    container: 'auth-button',
    clientid: CLIENT_ID,
  });

  // Step 4: Create the view selector.

  var viewSelector = new gapi.analytics.ViewSelector({
    container: 'view-selector'
  });

  // Step 5: Create the timeline chart.

  var timeline = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'dimensions': 'ga:date',
      'metrics': 'ga:sessions',
      'start-date': '30daysAgo',
      'end-date': 'today',
    },
    chart: {
      type: 'LINE',
      container: 'timeline'
    }
  });

  // Step 6: Hook up the components to work together.

  gapi.analytics.auth.on('success', function(response) {
    viewSelector.execute();
  });

  viewSelector.on('change', function(ids) {
    var newIds = {
      query: {
        ids: ids
      }
    }
    timeline.set(newIds).execute();
  });
});
</script>
</div>
<div id = "usersL" style="display:none">
            <h3 style="margin-left:6%;">Users: </h3>


            <div class="table-responsive">
               <table class="table table-striped table-responsive" style="width:85%;margin-left:6%;">
                <tr> <th style="padding:2px;">User Id</th><th style="padding:2px;">Username</th><th style="padding:2px;">Email Address</th><th style="padding:2px;">User Type</th><th style="text-align:right;padding-right:10px;">Actions</th></tr>
                <?php
                $limit =15;
                 if (isset($_GET["page"])){
                      $page  = $_GET["page"]; 
            }else { 
              $page=1; 
            };  
          $start_from = ($page-1) * $limit;   
                //get all users from the database
                $list = $con->selectAllUsers($start_from, $limit);
                while($row = mysqli_fetch_array($list)){
                  $id=$row['user_id'];
                  $user= $row['user_name'];
                  $email=$row['email'];
                  $pass=$row['password'];
                  $type =$row['user_type'];
                  //dispaly users data

                  ?>
                  <tr><td><?php echo $id?></td><td><?php echo $user ?></td><td><?php echo $email?></td>  <td><?php echo $type ?></td><td align ="right" style="padding-right:5px;"><form method ="post"action =""><input type='radio' name='user' id="admin" value="admin" <?php if($type=="admin"){echo "checked";}?> onclick="this.form.submit()">Admin</input><input type='radio'name='user' value='user' id="user" <?php if($type=="user"){echo "checked";}?>  onclick="this.form.submit()">User</input><input type="hidden" name="users_id" value="<?php echo $id ?>"></form><form method ="post"action =""><button type ='submit' class="btn btn-default" name='delete'>Delete this user</button><input type="hidden" name="users_id" value="<?php echo $id ?>"></form></td></tr>
                    <?php
                }

              //update user type with radio buttons
              if(isset($_POST['user'])){
                $update= $con->updateType($_POST['user'],$_POST['users_id']);
              }
              //delete the user from the database
             if(isset($_POST['delete'])){

             $delete=$con->deleteUsers($_POST['users_id']);
             echo '<script type="text/javascript">window.location.replace("https://weightmentor.eu/views/adminView.php");</script>';
             //send user an email to let them know there account has been removed.
             $emailCheck=$con->searchEmail($email);
              if($row=mysqli_fetch_array($emailCheck)){
               
             $to = $email ;
             $subject = "Confirmation that your account has been deleted by the administrator.";
               $headers = 'Content-type:text/html;charset=utf8'."\r\n"."From:info.weightmentor@gmail.com";
             $body ="Hi $user This message confirms that the Administrator of Weight Mentor has deleted your account.<br/> If you have not requested that we shut down your account please do not hesitate to contact our team.You can email us at info.weightmentor@gmail.com .<br/><br/>Regards Weight Mentor Administration Team. ";
            
             mail($to, $subject, $body, $headers);
             if(mail($to, $subject, $body, $headers)) {
              echo'<div class="alert alert-success">An Email has been sent to this users account.</div>';
             }else{
              echo "Error sending email to ".$email;
             }
           }
         }

        $total_records=0;
      $count = $con->AllUsers();
      while($r=mysqli_fetch_array($count)){
        $total_records =$r['total'];
              }
        $total_pages = ceil($total_records / $limit);  
        
      $pagLink = "<div class='pagination' style='margin-left:6%;'><ul class='pager'>";  
      for ($i=1; $i<=$total_pages; $i++) {  
                   $pagLink .= "<li><a href='?page=".$i."'>".$i."</a></li>";  
      }  
      echo $pagLink . "</ul></div>"; 
              ?>
              </table>
       </div>
      </div>
<br/>
<script>
  loadAdmin();
  $(document).ready(function(){
  $(".link").click(function(){
  $(this).tab('show');
  });
  });

  $("ul.nav-tabs a").click(function (e) {
  e.preventDefault();
  //$(this).tab('show');
  });

  </script>
<br/>
<br/>
<br/>
<br/>
</div>

        <?php
    
}
}
 }else{
      ?>
      <div class="panel panel-default" height="auto" style="margin-left: 1%;;background-color:lightgrey">
      <?php
       echo "Please login to view this content";
       ?>
       </div>
       <?php 
     }


  ?>
  </div>
  

