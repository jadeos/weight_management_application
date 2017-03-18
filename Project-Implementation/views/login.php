
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
          <button class="form-control btn btn-primary"  type="submit" name ="login">Login</button>
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

            <button class="form-control btn btn-primary" type="submit"  name="register">Register</button>
        </form
                          </div>
                          </div>
                          
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
