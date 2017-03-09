<!--registeration form for users-->
<?php
  include_once '../index.php';
include 'classes/register_process.php';
?>
<div class="container" id="wrap">
	<div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form action="" method="post" accept-charset="utf-8" class="form" role="form">   <h1>Sign Up</h1>
				<div class="row">
          <div class="col-xs-6 col-md-6">
          <input type="text" name="fullname" value="" class="form-control input-lg" placeholder="fullname" required />                        </div>
          </div>
					<input type="email" name="email" value="" class="form-control input-lg" placeholder="Your Email"required  /><br/>
          <input type="tel" name="phone" value="" class="form-control input-lg" placeholder="Phone" required  /><br/>
					<input type="text" name="username" value="" class="form-control input-lg" placeholder="Select a username" required /><br/>
					<input type="password" name="password" value="" class="form-control input-lg" placeholder="Select a Password" required /><br/>
					<input type="password" name="cpassword" value="" class="form-control input-lg" placeholder="Confirm Password" required /> <br/>
					<label>Birth Date</label>
					<input id ="dateT" type="date" name="bday" onchange="getDate()" required>
					<input id = "finalDate" type="hidden" value="" name="bDay">
					<script>
					function getDate(){
						var mydate=	getId("dateT").value;
						getId("finalDate").value=mydate;
					}
					</script>
	       <label>
					 Gender :
				 </label>
				 <label class="radio-inline">
	          <input type="radio" name="gender" value="M" id=male checked="checked"/>  Male
	      	</label>
	      <label class="radio-inline">
	          <input type="radio" name="gender" value="F" id=female />Female
	      </label>
	      <br />
	      <span class="help-block">By clicking Create my account, you agree to our Terms and that you have read our Data Use Policy, including our Cookie Use.</span>
	         <br/>
	 			 <button name="register" type="submit">Create my account</button>
	    </form>
	  </div>
