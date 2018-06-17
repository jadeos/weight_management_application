<!-- LOGIN FORM / MODAL -->

<!--Modal Tabs Header --> 
<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top:5%;outline: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <a href="#" class="img-rounded pull-left" ><img src="../../img/logo.png" width="25" height="25" hspace="10"> </a>
        <h4 class="modal-title" id="myModalLabel">Weight Mentor</h4>
      </div> <!-- /.modal-header -->
      <div class="modal-body">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Login</a></li>
        <li><a data-toggle="tab" href="#menu1">Register</a></li>
      </ul>

      <!--Modal Login  -->
      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <form method ="post" action="">
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" id="uLogin" name="username"  placeholder="Login" value=<?php if (isset($_COOKIE['remember_me'])) { echo $_COOKIE['remember_me']; }else { echo "";} ?>>
              <label for="uLogin" class="input-group-addon glyphicon glyphicon-user"></label>
            </div>
          </div> <!-- /.form-group -->

          <div class="form-group">
            <div class="input-group">
              <input type="password" name ="password" class="form-control" id="uPassword" placeholder="Password">
              <label for="uPassword" class="input-group-addon glyphicon glyphicon-lock"></label>
            </div> <!-- /.input-group -->
          </div> <!-- /.form-group -->

          <div class="checkbox">
            <label>
              <input type="checkbox" value=<?php if(isset($_COOKIE['remember_me'])) {echo 'checked="checked"';} else {  echo '';}?>> Remember me
            </label>
          </div> <!-- /.checkbox -->
          </a><br/>
          <button class="form-control btn btn-primary"  type="submit" name ="login">Login</button>
          <button class="form-control btn btn-primary"  type="submit" id="fitbit_login" name ="login_with_fitbit">Login with FitBit</button>
         <button class="form-control btn btn-primary"  type="submit" name = "reset"> Forgot Password </button> 
         
          
        </form>
        </div>

        <!--Registeration Modal -->
        <div id="menu1" class="tab-pane fade">

          <form method ="post" action="" >
            <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control" id="fname" name ="fullname" placeholder="fullname">
                <label for="fname" class="input-group-addon glyphicon glyphicon-user"></label>
              </div>
            </div>
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" id="uLogin" name ="username"placeholder="UserName">
              <label for="uLogin" class="input-group-addon glyphicon glyphicon-user"></label>
            </div>
          </div> <!-- /.form-group -->

          <div class="form-group">
            <div class="input-group">
              <input type="password" name="password" class="form-control" id="uPassword" placeholder="Password">
              <label for="uPassword" class="input-group-addon glyphicon glyphicon-lock"></label>
            </div> <!-- /.input-group -->
          </div> <!-- /.form-group -->

          <div class="form-group">
            <div class="input-group">
              <input type="password" name = "cpassword" class="form-control" id="uPassword" placeholder="ConfirmPassword">
              <label for="uPassword" class="input-group-addon glyphicon glyphicon-lock"></label>
            </div> <!-- /.input-group -->
          </div> <!-- /.form-group -->

          <div class="form-group">
            <div class="input-group">
              <input type="email" name ="email" class="form-control" id="uemail" placeholder="Email">
              <label for="uemail" class="input-group-addon glyphicon glyphicon-Email"></label>
            </div> <!-- /.input-group -->
          </div> <!-- /.form-group -->

          <div class="form-group">
            <div class="input-group">
              <label>Birth Date</label>
               <input id ="dateT" type="date" name="bday" onchange="getDate()" required>
               <input id = "finalDate" type="hidden" value="" name="bDay">
               <script>
               function getDate(){
                 var mydate=  getId("dateT").value;
                 getId("finalDate").value=mydate;
               }
               </script>
            </div> <!-- /.input-group -->
          </div> <!-- /.form-group -->

        <div class="form-group">
          <div class="input-group">
          <label>
            Gender :
          </label>
          <label class="radio-inline">
             <input type="radio" name="gender" value="M" id=male checked="checked"/>  Male
           </label>
           <label class="radio-inline">
               <input type="radio" name="gender" value="F" id=female />Female
           </label>
         </div> <!-- /.input-group -->
       </div> <!-- /.form-group -->
       <div class="form-group">
          <div class="input-group">
       <label> Choose a Security Question: 
       </label>
  
          <select name ="sec_question">
             <option value="" checked>Select an option</option>
            <option name ="qe" value ="What was your mothers maden name?" id="qe">What was your mothers maden name?</option>
            <option name ="qe" value ="What was the name of your first pet?" id="qe">What was the name of your first pet?</option>
            <option name ="qe" value ="What was the colour of your first car?" id="qe">What was the colour of your first car?</option>
            <option name ="qe" value ="What was the name of your favorite teacher?" id="qe">What was the name of your favorite teacher?</option>
            <option name ="qe" value ="What is the name of your oldest relative" id="qe">What is the name of your oldest relative</option>
          </select>
          </div>
          </div>
          <script>
          //  var question = getId("qe");
          //  console.log(question);


          </script>
       <div class="form-group">
              <div class="input-group">
              <label>Security Answer:  </label>
                <input type="text" class="form-control" id="sec_answer" name ="sec_answer" placeholder="Security Answer">
                <label for="fname" class="input-group-addon glyphicon glyphicon-user"></label>
              </div>
            </div>
            <div class="form-group" >
              
                <label for= "currentw">Current Weight:</label>
                <input type ="text" value=" <?php echo $cw;?>" name="currentw">
              
            </div>
            <div class="form-group">
           
            <label for= "unit">Weight Unit:</label>
            <label >
              <input type="radio" name="unit" value="kg"/>KGS
            </label>
            <label >
              <input type="radio" name="unit" value="lbs"/>LBS
            </label>
            <label >
             <input type="radio" name="unit" value="stone" />Stone
            </label>
        
      
         
         </div>
         <div class="form-group">
        
             <label for= "height">Height:</label>
              <input type ="text" name="height" value="<?php echo $height;?>">
              <br/><br/>
               
             <label for= "height_unit">Height Unit:</label>
              <label>
              <input type ="radio" name="height_unit" value="cm"/>CM
              </label>
              <label >
              <input type ="radio" name="height_unit" value="inches"/>Inches
              </label>
              <label >
              <input type ="radio" name="height_unit" value="feet"/>Feet
              </label>
       
            </div>

            <input type ="checkbox" name="t&cs" value="I agree to the terms and conditions" required />By checking this box, you are agreeing to our<a href ="" onclick="openInNewTab('https://weightmentor.eu/views/termsofuse.php');" data-window="external" data-dismiss="modal"> Terms and Conditions</a> <br/>
            <input type ="checkbox" name="privacy" value="I agree to the privacy policy" required />By checking this box, you also agree to our<a href ="" onclick="openInNewTab('https://weightmentor.eu/views/privacypolicy.php');" data-window="external" data-dismiss="modal"> Privacy Policy</a><br/><br/><br/>

        
       <button class="form-control btn btn-primary" type="submit"  name="register">Register</button>
      </form>
      <script>
       function openInNewTab(url) {
  var win = window.open(url, '_blank');
  win.focus();
}</script>
      <?php 
      if(isset($_POST['register']) ){
       // $question = $_POST['qe'];
       // echo $question;

      }

     



      ?>
    </div>
  </div>

  </div> <!-- /.modal-body -->
    <div class="modal-footer">
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>

<!--t&cs-->

