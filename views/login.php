
<?php 
  include_once '../index.php';
  
?>
<div class="panel panel-default" height="auto" style="margin-left: 1%;;background-color:lightgrey;padding-bottom:5%;">
<div class="container">
                  
            
                    <div class="row">
                        <div class="col-sm-5">
                          
                          <div class="form-box">
                            <div class="form-top">
                              <div class="form-top-left">
                                <h3>Login </h3>
                                 
                              </div>
                              <div class="form-top-right">
                                <i class="fa fa-key"></i>
                              </div>
                              </div>
                              <div class="form-bottom">
                            
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
          <br/>
          <button class="form-control btn btn-primary"  type="submit" name ="login">Login</button>
          <button class="form-control btn btn-primary"  type="submit" id="fitbit_login" name ="login_with_fitbit">Login with FitBit</button>
         <button class="form-control btn btn-primary"  type="submit" name = "reset"> Forgot Password </button> 
        </form>
                          </div>
                        </div>
                    
                    
                        </div>
                        
                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                          
                        <div class="col-sm-5">
                          
                          <div class="form-box">
                            <div class="form-top">
                              <div class="form-top-left">
                                <h3>Sign up now</h3>
                                  
                              </div>
                              <div class="form-top-right">
                                <i class="fa fa-pencil"></i>
                              </div>
                              </div>
                              <div class="form-bottom">
                             <form method ="post" action="">
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
  
          <select name ="question">
            <option name ="qe" value ="What was your mothers maden name?">What was your mothers maden name?</option>
            <option name ="qe" value ="What was the name of your first pet?">What was the name of your first pet?</option>
            <option name ="qe" value ="What was the colour of your first car?">What was the colour of your first car?</option>
            <option name ="qe" value ="What was the name of your favorite teacher?">What was the name of your favorite teacher?</option>
            <option name ="qe" value ="What is the name of your oldest relative">What is the name of your oldest relative</option>
          </select>
          </div>
          </div>
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
              <input type="radio" name="unit" value="kg" <?php if($w_unit=="kg"){ echo "checked";} ?>/>KGS
            </label>
            <label >
              <input type="radio" name="unit" value="lbs" <?php if($w_unit=="lbs"){ echo "checked";}?>/>LBS
            </label>
            <label >
             <input type="radio" name="unit" value="stone" <?php if ($w_unit=="stone"){ echo "checked";}?>/>Stone
            </label>
        
      
         
         </div>
         <div class="form-group">
        
             <label for= "height">Height:</label>
              <input type ="text" name="height" value="<?php echo $height;?>">
      
               <br/><Br/>
             <label for= "height_unit">Height Unit:</label>
              <label>
              <input type ="radio" name="height_unit" value="cm" <?php if( $h_unit =="cm") { echo "checked";}?>/>CM
              </label>
              <label >
              <input type ="radio" name="height_unit" value="inches" <?php if( $h_unit =="inches") { echo "checked";}?>/>Inches
              </label>
              <label >
              <input type ="radio" name="height_unit" value="feet" <?php if( $h_unit =="feet") { echo "checked";}?>/>Feet
              </label>
       
            </div>
             <input type ="checkbox" name="t&cs" value="I agree to the terms and conditions" required />By checking this box, you are agreeing to our<a href ="" onclick="openInNewTab('https://weightmentor.eu/views/termsofuse.php');"> Terms and Conditions</a> <br/>
            <input type ="checkbox" name="privcay" value="I agree to the terms and conditions" required />By checking this box, you also agree to our<a href ="" onclick="openInNewTab('https://weightmentor.eu/views/privacypolicy.php');"> Privacy Policy</a><br/> <br/><br/>

            <button class="form-control btn btn-primary" type="submit"  name="register">Register</button>
        </form>
                          </div>
                          </div>
                          
                        </div>
                    </div>
                    
                </div>
            </div>
    
</div>
            
        </div>
      
      
</div>