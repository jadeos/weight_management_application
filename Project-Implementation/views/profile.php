<?php
/*
*  Handle User Profile interaction 
*   Interacts with users basic infrmation, charts of recent progress, logs and update of the users profile.
Author: Jade O'Sullivan
Date Created :21/1/17
*/
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
?>

<?php
 


  include_once '../index.php';
  //include_once '../classes/log_classes.php';
  include_once '../db_models/weight_log.php';
  include_once '../db_models/users.php';
  //include_once '../ddb_models/food_log.php';
  //include_once '../database_functions/exercise_log.php';
  //include_once '../database_functions/water_log.php';
  include_once'../assets/helpers/charts.php';
  //  include_once '../helpers/pagnation.php';
  include_once '../classes/logs.php';
  include_once '../assets/js/fitbit.php';

  //database functions classes 
  $con = new users();
  $weight = new weight_log();
  // $food= new food_log();
  // $exercise = new exercise_log();
  // $water= new water_log();
  $helper  = new functions();

  // $pagnator =new pagnation();
  $logs = new logs();

  if($_SESSION['loggedin']==true){
    if(isset($_POST['update_details'])){
       echo $helper -> redirect("views/updateAccount.php");
    //  header("Location:  updateAccount.php");
    }

  
    //Find the user profile and log information.
    $res =$con->searchUser($_SESSION['user_id']);
    $weightLog = $weight->getUserLog($_SESSION['user_id']);
    // $mylog = $food->getUserBreakfast($_SESSION['user_id']);
    // $mylunchlog = $food->getUserLunch($_SESSION['user_id']);
    // $mydinnerlog =$food->getUserDinner($_SESSION['user_id']);
    // $mysnacklog =$food->getUserSnack($_SESSION['user_id']);
    // $exerciselog =$exercise->getExerciseLogItem($_SESSION['user_id']);
    // $water_log = $water->getWaterLogEntry($_SESSION['user_id']);

    //fetch user details.
    if($row =fetch_row($res)){
        $type = $row[2];
        //if there is no starting weight set it to the current weight.And add it to the database
        if($row[14]==0){
          $row[14]=$row[15];
          echo $con->update_startWeight($row[14],$_SESSION['user_id']);
          //insert weight into db
          //   $weight_insert=$weightLog->insertWeight($row[14],$_SESSION['user_id']);
        }

?>
 <?php
        }
        ?>

       <div class="panel panel-default" height="auto" style="margin-left: 1%;">
      <div class="panel-heading">My Profile </div>
      <!-- Tabbed Layout for Profile Menu -->
      <ul class="nav nav-tabs">
        <li role="presentation" >  <a  href ="#dashboard" id ="dashboard"  data-toggle="tab" onclick ="changeToDashboard(),setActiveProfileTab(0)">Dashboatd</a></li>

        <li role="presentation" >  <a  href ="#about_user" id ="aboutu"  data-toggle="tab" onclick ="changeToProfile(),setActiveProfileTab(1)">About Me</a></li>
        <li role="presentation"><a href ="#weightlog" id="weight" data-toggle="tab" onclick ="changeToWeightLog(),setActiveProfileTab(2)" >Weight Log</a><li>
        <li role="presentation"><a href ="#foodlog" id="food" data-toggle="tab" onclick ="changeToFoodLog(),setActiveProfileTab(3)" >Food Log</a><li>
        <li role="presentation"><a href ="#exerciselog" id="exercise" data-toggle="tab" onclick ="changeToExLog(),setActiveProfileTab(4)" >Exercise Log</a><li>  
        <li role="presentation"><a href ="#waterlog" id="water" data-toggle="tab" onclick ="changeToWaterLog(),setActiveProfileTab(5)" >Water Log</a><li>            
      </ul>

      <!---User Dashboard-->
      <div id ="dashboard">

      </div>

      <!--User Profile Information Tab-->
      <div id ="about_user" >
        <h3>About Me</h3>
        <label> <strong>Username:</strong><?php echo $row[1] ?><br/>
        <Label> <strong>Name:</strong></label><?php echo $row[3]  ?><br/>
        <Label> <strong>Age:</strong></label><?php echo $row[11]  ?><br/>
        <Label> <strong>Gender:</strong></label><?php   echo $row[12] ?><br/>
        <Label> <strong>Start Weight:</strong></label><?php echo $row[14].$row[16]; ?><br/>
        <Label> <strong>Current Weight:</strong></label><?php echo $row[15].$row[16]  ?><br/>
        <Label> <strong>Goal Weight:</strong></label><?php echo $row[13].$row[16] ?><br/>
        <Label> <strong>BMI:</strong></label><?php echo $row[17]?><br/><br/>

        <label><strong>Steps: </strong></label>
        <div id="steps">
        </div>
        <label> <strong>Select a device to use</strong></label>

        <form method ="post" action="updateAccount.php">
          <!--select wearable device options--> 
          <select name="device_select">
          <option name ="default" selected>No Device</option>
          <option name="fitbit">Fitbit</option>
          <option name ="android_w">Android Wear</option>
          </select>
          <br/>
          <br/>
          <button type ="submit" name="update_details">Update My Infromation</button>
        </form>
        <br/>
        <br/>
        <div class="panel panel-default" style="margin: 1%;">
          <div class="panel-heading">Users Progress</div>
          <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
          </div>
        <br/>
        <br//>
        <div class="panel panel-default" style="margin: 1%;">
          <div class="panel-heading">Nutritional Information</div>
          <div id="chartContainer" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
        <div class="panel-heading">BMI</div>
          <div id="bmichartContainer" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    
        
      </div> <!--about user div-->

      <!--User Weight Log Tab-->
      <div id ="weightlog"  style="visibility:hidden; margin: 2%; display:none:">
        <h3>Weight Log</h3>
        <div class="table-responsive">
          <table class="table" width="40%;">
            <?php echo $logs->weight_log();?>
          </table>
        </div>
        <nav aria-label="...">
          <ul class="pager">
            <li><a href="#">Previous</a></li>
            <li><a href="#">Next</a></li>
          </ul>
        </nav> 
      </div><!--weight log-->


      <!-- Food Log-->
      <div id ="foodlog"  style="visibility:hidden; margin: 2%; display:none:">
            <h3>Food Log</h3>

            <!--Search Directory-->
            <div class="row">
              <div class="col-lg-4" style="margin-left:65%;">
                <div class="input-group">
                  <form method = "post" action ="">
                    <input type="text" class="form-control" id="item" name="item" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" id="food_search" onclick="changeToFoodLog();showSearchResults();" type="submit">Search
                      </button>
                    </span>
                 </form>
                </div><!-- /input-group -->
              </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            <!--Hidden table for search results-->
            <div class="table-responsive" style="display:none;" id="food_search_results">
            <?php
            //Output buffering is on to remember any information that was shown before submit
            // ob_start();
            //  //If the search button was clicked,search the database for the item based on name and food group. 
            //  if(isset($_POST['item'])){
            //    $item = $_POST['item'];  
            //    $search_directory = $food->getFoodDirectoryItem($item);
            //    //If the results are found, display it in a table and if not let the user know along with an option to create a custom entry.
            //    if(mysqli_num_rows($search_directory)>=1){          
            ?>
              <table class="table" width="40%;">
                <th>Description</th>
                <th>Calories</th>
                <th>Protein</th>
                <th>Fat</th>
                <th>Carbohydrates</th>
                <th>Sugar</th>
                <th>Food Group</th>
                <th>Meal type</th>
                <th>Actions</th>
                <?php
                // while($row=fetch_row($search_directory)){
                ?>
                <tr>
                  <form method ="get" action=" ">
                    <td><?php //echo $row[2];?></td> 
                    <td><?php //echo $row[3];?></td>
                    <td><?php //echo $row[6];?></td>
                    <td><?php //echo $row[5];?></td>
                    <td><?php// echo $row[7];?></td>
                    <td><?php //echo $row[4];?></td>
                    <td><?php //echo $row[1];?></td>
                    <td>
                      <select name="mealt" id="foodtype">
                        <option value="0">Select Food Group</option>
                        <option value="breakfast">Breakfast</option>
                        <option value="lunch">Lunch </option>
                        <option value="dinner">Dinner</option>
                        <option value="snack">Snacks</option>              
                      </select>
                    </td>
                    <td> 
                      <button type="submit" name="add_to_db" value=1 class="btn btn-default btn-sm">
                      <span class="glyphicon glyphicon-remove"></span>Add Entry
                    </button>
                    </td>
                  </form>
                </tr>
              <?php
              //  if(isset($_GET['mealt'])){
              //    echo $helper->console_log("test");
              //    $meal = $_GET['mealt'];
              //    if($meal == "0"){
              //     $meal = "breakfast";
              //    }
              //    $item =$row[2];
              //    $food_id=$row[0];
              //    $insertF=$food->insertIntoFoodLog($_SESSION['user_id'],$food_id,$meal);
              //  }
              // }
              ?>
              </table>
              <form method ='post' action=''><p>Not the results you are looking for? Click<a href="#theModal" data-toggle="modal" data-target="#themodal">here </a>to add a custom entry!</p><input type='hidden' name='create_entry'/>
              </form>
              <?php
              // }else{
              //     echo "<form method ='post' action=''><p>No Search Results Found <br/>Click <a href='#theModal' data-toggle='modal'  data-target='#themodal'>here </a>to add a custom entry!</p><input type='hidden' name='create_entry'/></form>";
              //  }
              //}
              // $content = ob_get_contents();
              // ob_end_flush();

              // echo $helper -> console_log($content);
              ?>   
             </div>
            <?php 
            //load the buffer html content to the page if there is any
            if($content !=""){
            echo "<h3>Your Search Results </h3><br/>".$content;
            }
            ?>
             <h5>Breakfast</h5>
             <div class="table-responsive" >
                <table id="bfast" class="table" width="40%;">
                  <?php
                  // echo $logs->breakfast_log();
                  ?>
                </table>
              </div><!--END BREAKFAST LOG-->
              <!--Lunch-->
              <h5>Lunch</h5>
              <div class="table-responsive">
                <table class ="table" width="10%" id="lunch">
                //  <?php echo $logs->lunch_log();?>
                </table>
               </div> <!--END LUNCH LOG-->
                <!--dinner-->
              <h5>Dinner</h5>
              <div class="table-responsive" >
                <table class ="table" width="10%" id ="dinner">
                <?php// echo $logs->dinner_log();?>

                </table>
             </div><!--end DINNER LOG-->
            <!--Snack Log -->
            <h5>Snacks</h5>
            <div class="table-responsive">
              <table class ="table" width="10%" id  ="snack">
              <?php// echo $logs->snack_log();
              ?>
              </table>
            </div><!--end snack log-->
            <div id="page-selection">
              <nav aria-label="...">
                <ul class="pager">
                  <li><a href="#">Previous</a></li>
                  <li><a href="#">Next</a></li>
                </ul>
              </nav>
            </div>
      </div><!--food log-->

      <!--exercise log-->
    <div id ="exerciselog"  style="visibility:hidden; margin: 2%; display:none:">
    <h3>Exercise Log</h3>
      <!--Search Directory-->
      <div class="row">
        <div class="col-lg-4" style="margin-left:65%;">
          <div class="input-group">
            <form method = "post" action ="">
              <input type="text" class="form-control" id="ex_item" name="ex_item" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-default" id="ex_search" onclick="changeToExLog();showExSearchResults();" type="submit">Search
                </button>
              </span>
            </form>
          </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->

      <!--hidden search results field for exercise search-->
      <div class="table-responsive" style="display:none;" id="ex_search_results">
      <?php
      //Output buffering is on to remember any information that was shown before submit
      // ob_start();
      // //check to see if the exercise search button has been clicked
      // if(isset($_POST['ex_item'])){
      //    $items =$_POST['ex_item'];
      //    $ex_search_directory = $exercise->getExerciseDirectoryItem($items);
      //     if(mysqli_num_rows($ex_search_directory)>=1){          
      ?>
        <table class="table" width="40%;">
          <th>Exercise</th>
          <th>Description</th>
          <th>Type</th>
          <th>Length (mins)</th>
          <th>Actions</th>
          <?php
          // while($row=fetch_row($ex_search_directory)){
          ?>
          <tr>
            <form method ="get" action=" ">
              <td><?php// echo $row[1];?></td> 
              <td><?php //echo $row[3];?></td>
              <td><?php //echo $row[2];?></td> 
              <td>
                <input class="form-control" name="len" type="text" id="lengtht">
              </td>
              <td> 
                <button type="submit" name="add_to_edb" value=1 class="btn btn-default btn-sm">
                  <span class="glyphicon glyphicon-remove"></span>Add Entry
                </button>
              </td>
            </form>
          </tr>
          <?php 
          // if(isset($_GET['len'])){
          //   echo $helper->console_log("test");
          //   $lengtht = $_GET['len'];
          //    $exercise_id = $row[0];
          //  //  ECHO $length." ".$exercise_id." ".$_SESSION['user_id'];
          //    $exInsert = $exercise->insertIntoExerciseLog($exercise_id,$_SESSION['user_id'],$lengtht);

          // }

          //  }
          ?>
        </table>
        <form method ='post' action=''><p>Not the results you are looking for? Click<a href="#exModal" data-toggle="modal" data-target="#exModal">here </a>to add a custom entry!</p><input type='hidden' name='create_c_entry'/>
        </form>
        <?php
        // }else{
        ?>
        <form method ='post' action =''><p>No Search Results found; Click <a href="#exModal" data-toggle="modal" data-target="#exModal">here </a>to add a custom entry!</p><input type='hidden' name='create_c_entry'/>
        <?php
        // }
        // }
        // $contentss = ob_get_contents();
        // ob_end_flush();

        ?>   
     </div><!--end seach results-->
      <?php 
      //load the buffer html content to the page if there is any
        if($contentss  !=""){
        echo "<h3>Your Search Results </h3><br/>".$contentss;
      }
      ?>
      <div class="table-responsive ">
        <table class="table" width="40%;">
          <?php
          // echo $logs->exercise_log();
          ?>
        </table>
      </div>
      <nav aria-label="...">
        <ul class="pager">
          <li><a href="#">Previous</a></li>
          <li><a href="#">Next</a></li>
        </ul>
      </nav>
    </div><!--exercise log-->
    <!---water Log-->
    <div id ="waterlog"  style="visibility:hidden; margin: 2%; display:none:">
      <h3>Water Log</h3>
      <form method = "post" action="">
        <span style ="cursor:pointer;" name = "add_water"><a href = "#mywModal" data-toggle="modal" data-target="#mywModal">Add an entry</a></span>
      </form>
      <div class="table-responsive">
        <table class="table" width="40%;">
        <?php //echo $logs->water_log();?>

        </table>
      </div>
      <nav aria-label="...">
        <ul class="pager">
          <li><a href="#">Previous</a></li>
          <li><a href="#">Next</a></li>
        </ul>
      </nav>
    </div><!--water log-->
  <!--End Of Profile Panel-->
  </div>
</div>

<script>
//Load the selected cookie upon page refresh
loadActiveProfileTab();
</script>

<!--user macros-->
<div class="panel panel-default" style="margin: 1%;">
<div class="panel-heading" >Nurtrition Details</div>
<div id = "nutrition" style="min-width: 310px; height: 400px; margin: 0 auto">  </div>
</div>

<script>
//Functions for tab changes etc
$(document).ready(function(){
$(".link").click(function(){
$(this).tab('show');
});
});
$("ul.nav-tabs a").click(function (e) {
e.preventDefault();
$(this).tab('show');
});
</script>
<?php
}else{
//Show the user that they need to log in. 
?>
<div class="panel-heading">Please Log in to View 

<?php
}


?>


<!---------------- LOG MODALS ---------------->
<!-- Add Custom Food Entry Form Modal-->
<div class="modal fade" id="themodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h4 class="modal-title" id="myModalLabel">Add Custom Food Entry</h4>
</div>

<form method ="post" action="">
<div class="modal-body">
<!--Custom Entry Form-->    
<!--One row-->   
<div class="form-group row">

<div class="col-xs-4">
<label for="name">Name</label>
<input class="form-control" name="name" type="text"id="name">
</div>

<div class="col-xs-4">
<label for="calories">Calories</label>
<input class="form-control" name="calories" type="text"  id="calories">
</div>
<!--End One Row-->
</div>
<br/>
<div class="form-group row">
<div class="form-group col-xs-4">
<label for="foodtype">Meal Type</label>
<select class="form-control"  name="meal" id="foodtype">
<option value="breakfast">Breakfast</option>
<option value="lunch">Lunch </option>
<option value="dinner">Dinner</option>
<option value="snack">Snacks</option>
</select>
</div>
<div class="form-group col-xs-4">
<label for="foodgroup">Food Group</label>
<select class="form-control" name="group" id="foodgroup">
<option>Please Select a food type </option>
<option>Meat </option>
<option>Vegetables </option>
<option>Fruit</option>
<option>Carbohydrates</option>
<option>Dairy</option>
<option>Sweat and Savory</option>        
</select>
</div>
</div>
<br/>
<div class="form-group row">
<div class="form-group col-xs-2">
<label for="protein">Protein  </label>
<input class="form-control" name ="protein" type="text"  id="protein">
</div>
<div class="form-group col-xs-2">
<label for="fat">Fat</label>
<input class="form-control" name="fat" type="text"  id="fat">  
</div>

<div class="form-group col-xs-2">
<label for="carb">Carbs </label>
<input class="form-control" name ="carb" type="text"  id="carb">     
</div>

<div class="form-group col-xs-2">
<label for="sugar">Sugars </label>
<input class="form-control" name= "sugar" type="text"  id="sugar">  
</div>
</div>
<!--Close Modal Body-->
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" name="add_custom_entry" class="btn btn-primary">Add Entry</button>
</div>
</form>
</div>
</div>
</div>


<!-- Add Custom  Entry Form Modal-->
<div class="modal fade" id="exModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h4 class="modal-title" id="myModalLabel">Add Custom Exercise Entry</h4>
</div>
<form method ="post" action="">
<div class="modal-body">
<div class="form-group row">

<div class="col-xs-4">
<label for="name">Execise Name</label>
<input class="form-control" name="name" type="text" id="name">
</div>
<div class="col-xs-4">
<label for="type">Type</label>
<select class="form-control" name="type" id="type">
<option value ="strength">Strength</option>
<option value="cardio">Cardio </option>
<option value="stretching">Stretching</option>

</select>
</div>
<div class="col-xs-4">
<label for="length">Length (Mins)</label>
<input class="form-control" name="length" type="text" id="length">
</div>
</div>
<div class="form-group row">
<div class="col-xs-8">
<label for="name">Description</label>
<textarea class="form-control" name="description" type="text" id="description"></textarea>
</div>
</div>
<!--Close Modal Body-->
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" name="add_customs_entry" class="btn btn-primary">Add Entry</button>
</div>
</form>
</div>
</div>
</div>

<!--Modal Tabs Header for water logs --> 
<div class="modal fade" id="mywModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top:5%;outline: none;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
<a href="#" class="img-rounded pull-left" ><img src="img/logo.png" width="25" height="25" hspace="10"> </a>
<h4 class="modal-title" id="myModalLabel">Weight Mentor</h4>
</div> <!-- /.modal-header -->
<div class="modal-body">
<ul class="nav nav-tabs">
<li class="active"><a data-toggle="tab" href="#water">Add Entry</a></li>

</ul>

<!--Modal water  -->
<div class="tab-content">
<div id="water" class="tab-pane fade in active">
<form method ="post" action="">
<div class="form-group">
<div class="input-group">
<label for="name">Quantity</label>
<input class="form-control" name="qty" type="text" id="qty">
</div>
</div> <!-- /.form-group -->

<div class="form-group">
<div class="input-group">
<label for= "unit">Unit:  </label><br/>
<label> <input type="radio" value ="Cups" name="unit"> Cups </label>&nbsp;
<label>  <input type="radio"value ="Litires" name="unit"> Litires </label>&nbsp;
<label> <input type="radio" value ="ml" name="unit">  ML </label>&nbsp;
<label> <input type="radio" value="oz" name="unit">   OZ  </label>
</div> <!-- /.input-group -->
</div> <!-- /.form-group -->
</div> <!-- /.water div -->
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" name="add_water_entry" class="btn btn-primary">Add Entry</button>
</div>
</form>
</div>

<?php

?>
