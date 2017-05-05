<?php 

    /*
        Class cators for log modals and inserts to the database.
        Current Modals: Weight, Water Entry, exercise and food modals. 
        Date Created: 3/3/17
        Date Modified: 4/5/17
        @author Jade O'Sullivan
    */
 include_once '../database_functions/users.php';

  include_once '../database_functions/food_log.php';
  include_once '../database_functions/exercise_log.php';
  include_once '../database_functions/water_log.php';
   include_once '../database_functions/weight_log.php';

   //access required classes. 
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

     $meal = $_POST['mealt'];

     if($meal == "0"){
      $meal = "breakfast";
     }

     $item =$_SESSION['item'];
     $food_id=$_SESSION['food_id'];


     $insertF=$food->insertIntoFoodLog($_SESSION['user_id'],$food_id,$meal);
   }

   //Pre defined exercise directory
    if(isset($_POST['len'])){
            echo $helper->console_log("test");
            $lengtht = $_POST['len'];
             $exercise_id = $_SESSION['ex_id'];
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

      //if the steps are logged for the day
      if(isset($_POST['add_step_entry'])){
        $steps =$_POST['steps'];
        $calories=$_POST['calories'];
        $distance =$_POST['distance'];

        echo $exercise->add_steps($steps,$distance,$calories,$_SESSION['user_id']);
      }

      //weight log added
      if(isset($_POST['add_weight_entry'])){
        $nweight = $_POST['nweight'];
        $chosen_unit = $_POST['wunit'];

        //check users table for the chosen unit.
        $searchw = $con->searchUser($_SESSION['user_id']);

       $log = $weight->getUserLog($_SESSION['user_id']);
        //if there not the same as the new unit chosen, convert all the old weight to new chosen unit.ie update all entries in weight log and set there old values to new values.
        if($row=mysqli_fetch_array($searchw)){
          //previous weight
         $unit;
         $id;
          $result_unit=$row['current_weight_unit'];
          $start_weight = $row['start_weight'];
          $goal_weight =$row['goal_weight'];
          if($result_unit!=$chosen_unit){
            //query db then check and convert each entry to the chosen unit with the converted weight
            while($r =mysqli_fetch_array($log)){
                 $unit=$r['previous_weight'];
                 $id = $r['id'];
                 //conversions
                switch($result_unit){
                  case 'lbs':
                    if($chosen_unit == "kgs"){

                       $unit = $unit/2.2;
                     
                
                    }else if($chosen_unit =="stone"){
                      $unit =  $unit/14;
                    

                    }else{

                      $unit =$unit;
                    }
                    break;

                  case 'kgs':
                        if($chosen_unit == "lbs"){
                           $unit =  $unit*2.2;

                    }else if($chosen_unit =="stone"){
                       $unit = $unit/14;
                        $unit = $unit*2.2;
                        $unit = round($unit, 2); 
                    

                    }else{
                       $unit =$unit;
                    }
                    break;


                  case 'stone':
                       
                        if($chosen_unit == "lbs"){
                           $unit = $unit * 14;
                      

                    }else if($chosen_unit =='kgs'){
                       $unit = $unit *14;
                      $unit = $unit /2.2;
                     

                    }else{
                       $unit =$unit;
                    }
                    break;
  
                }

                 // update weight log with these entries
                  echo $weight->update_weight($unit,$id,$_SESSION['user_id']);



              }//log 
              switch($result_unit){
                 case 'lbs':
                     if($chosen_unit == "kgs"){

                       $start_weight = $start_weight/2.2;
                     $goal_weight = $goal_weight/2.2;
                     
                
                    }else if($chosen_unit =="stone"){
                      $start_weight =  $start_weight/14;
                      $goal_weight=$goal_weight/14;
                    }else{

                      $start_weight=$start_weight;
                      $goal_weight=$goal_weight;
                    }
                 break;

                case 'kgs':
                        if($chosen_unit == "lbs"){
                           $start_weight =  $start_weight*2.2;
                           $goal_weight =  $goal_weight*2.2;


                    }else if($chosen_unit =="stone"){
                       $start_weight = $start_weight/14;
                        $start_weight = $start_weight*2.2;
                        $start_weight = round($start_weight, 2); 
                        $goal_weight = $goal_weight/14;
                        $goal_weight = $goal_weight*2.2;
                        $goal_weight = round($goal_weight, 2); 
                      

                    }else{
                       $start_weight=$start_weight;
                      $goal_weight=$goal_weight;
                    }
                    break;


                 case 'stone':
                     
                        if($chosen_unit == "lbs"){
                           $start_weight = $start_weight * 14;
                           $goal_weight = $goal_weight * 14;
                        

                    }else if($chosen_unit =='kgs'){
                       $start_weight = $start_weight *14;
                      $start_weight = $start_weight /2.2;

                      $goal_weight = $goal_weight *14;
                      $goal_weight = $goal_weight /2.2;
                     
                    }else{
                        $start_weight=$start_weight;
                      $goal_weight=$goal_weight;
                    }
                     
                 break;
  
                 }

             

             }//if chosen!=result
           }
           //insert to weight log
           echo $weight->insertWeight($nweight,$_SESSION['user_id']);
           // //update users table with the start and goal weight 
           echo $con->update_current_weight($goal_weight,$start_weight,$nweight,$chosen_unit,$_SESSION['user_id']);

           }

?>