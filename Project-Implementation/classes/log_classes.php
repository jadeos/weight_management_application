<?php 

    /*
        Class cators for log modals. 
        Current Modals: Water Entry, exercise and food modals. 
    */
 include_once '../database_functions/users.php';

  include_once '../database_functions/food_log.php';
  include_once '../database_functions/exercise_log.php';
  include_once '../database_functions/water_log.php';
   include_once '../database_functions/weight_log.php';

   
    $con = new users();
  $weight = new weight_log();
  $food= new food_log();
  $exercise = new exercise_log();
  $water= new water_log();
  $helper  = new functions();
  
    if(!isset($_SESSION)){
    session_start();
  }

  //insert directory item to  user food log
   if(isset($_POST['mealt'])){

     echo $helper->console_log("test");
     $meal = $_POST['mealt'];
     echo $meal;
     if($meal == "0"){
      $meal = "breakfast";
     }

     $item =$_SESSION['item'];
     $food_id=$_SESSION['food_id'];
     echo $item;
     echo $food_id;

     $insertF=$food->insertIntoFoodLog($_SESSION['user_id'],$food_id,$meal);
   }

   //Pre defined exercise directory
    if(isset($_POST['len'])){
            echo $helper->console_log("test");
            $lengtht = $_POST['len'];
             $exercise_id = $_SESSION['ex_id'];
           //  ECHO $length." ".$exercise_id." ".$_SESSION['user_id'];
             $exInsert = $exercise->insertIntoExerciseLog($exercise_id,$_SESSION['user_id'],$lengtht);

          }
    //water logs
    if(isset($_POST['add_water_entry'])){
       
        //grab all post vars for water and add to water log
        $qty =$_POST['qty'];
        $unit =$_POST['unit'];
        
        $insert_w = $water->insertWaterEntry($_SESSION['user_id'],$qty,$unit);
 
   }




    //Exercise Logs : 
       if(isset($_POST['add_customs_entry'])){
        //get eveything posted and submit it. 
        $name =$_POST['name'];
       
        $type = $_POST['type'];
        $length =$_POST['length'];
        $description=$_POST['description'];
         $insertExDirectory= $exercise->insertIntoExerciseDirectory($name,$type,$description);
          $search_in_ex_directory = $exercise->getExerciseDirectoryItem($name);
          if(mysqli_num_rows($search_in_ex_directory)>=1){
             while($row=mysqli_fetch_array($search_in_ex_directory)){
               $exercise_id = $row['id'];
               $insertExIntoLog=$exercise->insertIntoExerciseLog($exercise_id,$_SESSION['user_id'],$length);
             }
           }
      }

     //Get Custom food Entry Post variables
      if(isset($_POST['add_custom_entry'])){
        //get eveything posted and submit it. 
        $name =$_POST['name'];
        $meal = $_POST['meal'];
        $group =$_POST['group'];
        $calories =$_POST['calories'];
        $protein =$_POST['protein'];
        $fat = $_POST['fat'];
        $carbs =$_POST['carb'];
        $sugar =$_POST['sugar'];
         $insertDirectory= $food->insertIntoDirectory($group,$name,$calories,$sugar,$fat,$protein,$carbs);
         $search_in_directory = $food->getFoodDirectoryItem($name);
          if(mysqli_num_rows($search_in_directory)>=1){
            while($row=mysqli_fetch_array($search_in_directory)){
              $food_id = $row['food_id'];
               $insertIntoLog=$food->insertIntoFoodLog($_SESSION['user_id'],$food_id,$meal);
            }
          }
      }


?>