<!-- LOGIN FORM / MODAL -->

<!--Modal Tabs Header --> 
<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top:5%;outline: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <a href="#" class="img-rounded pull-left" ><img src="img/logo.png" width="25" height="25" hspace="10"> </a>
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
              <input type="checkbox" value=<?php if(isset($_COOKIE['remember_me'])) {echo 'checked="checked"';}	else {	echo '';}?>> Remember me
            </label>
          </div> <!-- /.checkbox -->
          <button class="form-control btn btn-primary"  type="submit" name = "reset"> Reset Password </button> 
          <button class="form-control btn btn-primary"  type="submit" name ="login">Login</button>
          <button class="form-control btn btn-primary"  type="submit" id="fitbit_login" name ="login_with_fitbit">Login with FitBit</button>
       

        </form>
         
        </div>

        <!--Registeration Modal -->
        <div id="menu1" class="tab-pane fade">

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
                 var mydate=	getId("dateT").value;
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
      </form>
    </div>
  </div>

  </div> <!-- /.modal-body -->
    <div class="modal-footer">
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
