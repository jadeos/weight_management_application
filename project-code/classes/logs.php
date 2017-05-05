<?php
/*
  helper class with functions used to query database and handle part of views.
  Author: Jade O'Sullvan
  Date Created: 24/2/17
  Date Modified: 2/5/17

*/
  
 class logs{

    //show weight log
    function weight_log(){
      $limit =15;
       if (isset($_GET["page"])){
             $page  = $_GET["page"]; 
        }else { 
          $page=1; 
        };  
        $start_from = ($page-1) * $limit;

         $con = new users();
        $weight = new weight_log();
         $res =$con->searchUser($_SESSION['user_id']);
        $weightLog = $weight->getUserWLog($_SESSION['user_id'],$start_from, $limit);
        ?>

           
          <th>Date Added</th>
          <th>Time </th>
          <th>Weight</th>
          <th>Actions</th>
          <?php
        $date='';

          while($row=mysqli_fetch_array($weightLog)){
               $timestamp =$row['date_added'];
            $weightt = $row['previous_weight'];
            
               $timestamp_array=explode(" ",$timestamp);
                $date=$timestamp_array[0];
                $time=$timestamp_array[1];
           ?>
            <tr>
              <td><?php echo $date;?></td>
              <td><?php echo $time;?></td>
              <td><?php echo $weightt?></td>
              <td>
                <form method="post" action ="profile.php">
                  <input type="hidden" name="userweight" value="<?php echo $weightt ?>"/>
                  <button type="submit" name="delete_weight" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-remove" onclick ="gototab();""></span> Remove
                  </button>
                </form>
              </td>
           </tr> <script>
             function gototab()
             {
              var url = location.href;
    location.href = "#"+  window.location.hash;               
}
         
             </script>

          <?php
          //delete action for users weight
           }
          if(isset($_POST['delete_weight'])){
             echo $weight->deleteWeight($_POST['userweight'],$_SESSION['user_id']);
             echo '<script type="text/javascript">window.location.replace("https://weightmentor.eu/views/profile.php?id="'.$_SESSION['user_id'].'");</script>';
           
          }  
          //pagnation
      $total_records=0;
      $count = $weight->countAll($_SESSION['user_id']);
      while($r=mysqli_fetch_array($count)){
        $total_records =$r['total'];
              }
        $total_pages = ceil($total_records / $limit);  
        
      $pagLink = "<div class='pagination' style='margin-left:6%;'><ul class='pager'>";  
      for ($i=1; $i<=$total_pages; $i++) {  
                   $pagLink .= "<li><a href='?page=".$i."'>".$i."</a></li>";  
      }  
      echo $pagLink . "</ul></div>";     
    }
    

    //show exercise log
    function exercise_log(){ 
        //get all the date entries in database 
           $con = new users(); 
           $exercise = new exercise_log();
          
             $today = date('Y-m-d');
             $date_arr =array();
             /*Pagnation attemt on exercise log

        $dates = $exercise->countDates($_SESSION['user_id']);
        while($row = mysqli_fetch_array($dates)){

         array_push($date_arr,$row['date_added']);   
           
        }
        $limit = sizeOf($date_arr);
        $sort = array();
        for($x = 0;$x<=sizeOf($date_arr);$x++){

            $sp1=explode(" ", $date_arr[$x]);
    
            array_push($sort,$sp1[0]);
     
      }
        for($x = 0;$x<=sizeOf($sort);$x++){
          if($sort[$x] == $sort[$x+1]){
             echo "limit before reduction: ".$limit."<br/>";
               $limit = $limit-1;
              echo "limit after reduction: ".$limit."<br/>";
            }else{
              $limit+=0;
            }
        }

       if (isset($_GET["page"])){
             $page  = $_GET["page"]; 
        }else { 
          $page=1; 
        };  
        $start_from = ($page-1) * $limit;
        $exerciselog =$exercise->getExerciseLogItem($_SESSION['user_id'],$start_from,$limit);
        &*/
        //change these when sorting out pagnation
        $start_from =0;
        $limit=100;
          $exerciselog =$exercise->getExerciseLogItem($_SESSION['user_id'],$start_from,$limit);
        ?>
    
       <th>Date Added</th>
       <th>Time</th>
        <th>Exercise</th>
       <th>Description</th>
       <th>Length</th>
       <th>Type</th>
       <th>Actions</th>
       <?php
       while($row=mysqli_fetch_array($exerciselog)){
        $id=$row['id'];
        $timestamp =$row['date_added'];
        $timestamp_array=explode(" ",$timestamp);
        $date=$timestamp_array[0];
        $time=$timestamp_array[1];
        $length=$row['length'];
        ?>
       <tr>
         <td><?php echo $date;?></td>  
         <td><?php echo $time;?></td> 
         <td><?php echo $row['exercise'];?></td> 
          <td><?php echo $row['description'];?></td> 
          <td><?php echo $row['length'];?></td> 
          <td><?php echo $row['type'];?></td> 
       
         <td> 
          <form method="post" action ="profile.php">
            <input type =hidden name="l_id" value="<?php echo $id ?>"/>
            <input type =hidden name="timestamp" value="<?php echo $timestamp ?>"/>
            <input type =hidden name="length" value="<?php echo $length ?>"/>

             <button type="submit" name="delete_exercise" class="btn btn-default btn-sm">
              <span class="glyphicon glyphicon-remove"></span> Remove
             </button>
            
          </form>
         </td>
       </tr>
        <?php
        }
          if(isset($_POST['delete_exercise'])){
        echo $exercise->removeExerciseLogEntry($_POST['l_id'],$_SESSION['user_id'],$_POST['length'],$_POST['timestamp']);
        echo '<script type="text/javascript">window.location.replace("https://weightmentor.eu/views/profile.php?id="'.$_SESSION['user_id'].'");</script>';
        
       }
       /*
       Pagnation attempt
      $total_records=sizeOf($date_arr);
      $total_pages = ceil($total_records / $limit);  
        
      $pagLink = "<div class='pagination'><ul class='pager'>";  
      for ($i=1; $i<=$total_pages; $i++) {  
                   $pagLink .= "<li><a href='?page=".$i."'>".$i."</a></li>";  
      }  
      echo $pagLink . "</ul></div>"; 
   
*/
    
        
    }
    //show users breakfast log
     function breakfast_log(){
          $con = new users();
         $food= new food_log();
        $mylog = $food->getUserBreakfast($_SESSION['user_id']);
         ?>
 
             <!--table headings-->
        <th>Date Added</th>
        <th>Description</th>
        <th>Calories</th>
        <th>Protein</th>
        <th>Fat</th>
        <th>Carbohydrates</th>
        <th>Sugar</th>
         <th>Food Group</th>
        <th>Actions</th>
      <?php
      //populate the table with code.
      while($row=mysqli_fetch_array($mylog)){
        $id =$row['food_id'];
        $entry = $row['entry_type'];
        $timestamp =$row['date_a'];
        
       ?>
       <tr>
        <td><?php echo $row['date_a'];?></td> 
        <td><?php echo $row['name'];?></td>
        <td><?php echo $row['calories'];?></td>
        <td><?php echo $row['protein'];?></td>
        <td><?php echo $row['fat'];?></td>
        <td><?php echo $row['carbohydrates'];?></td>
        <td><?php echo $row['sugar'];?></td>
        <td><?php echo $row['food_group'];?></td>
        <td> 
          <form method="post" action ="profile.php">
            <input type="hidden" name="logid" value="<?php echo $id ?>"/>
            <input type="hidden" name="entrytype" value="<?php echo $entry ?>"/>
            <button type="submit" name="delete_breakfast" class="btn btn-default btn-sm">
              <span class="glyphicon glyphicon-remove"></span> Remove
            </button>
           </form>
        </td></tr>
       <?php
      }
     //delete action for user breakfast item
     if(isset($_POST['delete_breakfast'])){
        echo $food->removeLogEntry($_POST['logid'],$_SESSION['user_id'],$_POST['entrytype']);
             echo '<script type="text/javascript">window.location.replace("https://weightmentor.eu/views/profile.php?id="'.$_SESSION['user_id'].'");</script>';
            
       }
       
     }
     
     //show users lunch log 
     function lunch_log(){
          $con = new users();
     $food= new food_log();
          $mylunchlog = $food->getUserLunch($_SESSION['user_id']);
         ?>
          <th>Date Added</th>
          <th>Description</th>
          <th>Calories</th>
          <th>Protein</th>
          <th>Fat</th>
          <th>Carbohydrates</th>
          <th>Sugar</th>
          <th>Food Group</th>
          <th>Actions</th>
           <?php
            while($row=mysqli_fetch_array($mylunchlog)){
                 $id =$row['food_id'];
        $entry = $row['entry_type'];
           $timestamp =$row['date_a'];
        
       ?>
       <tr>
        <td><?php echo $row['date_a'];?></td> 

        <td><?php echo $row['name'];?></td>
        <td><?php echo $row['calories'];?></td>
        <td><?php echo $row['protein'];?></td>
        <td><?php echo $row['fat'];?></td>
        <td><?php echo $row['carbohydrates'];?></td>
        <td><?php echo $row['sugar'];?></td>
        <td><?php echo $row['food_group'];?></td>
        <td> 
                  <form method="post" action ="profile.php">
                    <input type="hidden" name="logid" value="<?php echo $id ?>"/>
                    <input type="hidden" name="entrytype" value="<?php echo $entry ?>"/>
                    <button type="submit" name="delete_lunch" class="btn btn-default btn-sm">
                      <span class="glyphicon glyphicon-remove"></span> Remove
                    </button>
                   </form>
                </td>
              </tr>
              <?php
               }
                //delete action for user lunch item
               if(isset($_POST['delete_lunch'])){
                  echo $food->removeLogEntry($_POST['logid'],$_SESSION['user_id'],$_POST['entrytype']);
                   echo '<script type="text/javascript">window.location.replace("https://weightmentor.eu/views/profile.php?id="'.$_SESSION['user_id'].'");</script>';
                 
                 }
              
     }
     //shoe user dinnerlog
     function dinner_log(){
          $con = new users();
     $food= new food_log();
  $mydinnerlog =$food->getUserDinner($_SESSION['user_id']);
         ?>
         <th>Date Added</th>
              <th>Description</th>
            <th>Calories</th>
            <th>Protein</th>
            <th>Fat</th>
            <th>Carbohydrates</th>
            <th>Sugar</th>
             <th>Food Group</th>
            <th>Actions</th>
            <?php
            while($row=mysqli_fetch_array($mydinnerlog)){
               $id =$row['food_id'];
        $entry = $row['entry_type'];
           $timestamp =$row['date_a'];
        
       ?>
       <tr>
        <td><?php echo $row['date_a'];?></td> 
       
        <td><?php echo $row['name'];?></td>
        <td><?php echo $row['calories'];?></td>
        <td><?php echo $row['protein'];?></td>
        <td><?php echo $row['fat'];?></td>
        <td><?php echo $row['carbohydrates'];?></td>
        <td><?php echo $row['sugar'];?></td>
        <td><?php echo $row['food_group'];?></td>
        <td> 
                <form method="post" action ="profile.php">
                  <input type="hidden" name="logid" value="<?php echo $id ?>"/>
                  <input type="hidden" name="entrytype" value="<?php echo $entry ?>"/>
                  <button type="submit" name="delete_dinner" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-remove"></span> Remove
                  </button>
                </form>
              </td>
            </tr>
            <?php

            }
             //delete action for user dunner item
           if(isset($_POST['delete_dinner'])){
              echo $food->removeLogEntry($_POST['logid'],$_SESSION['user_id'],$_POST['entrytype']);
              echo '<script type="text/javascript">window.location.replace("https://weightmentor.eu/views/profile.php?id="'.$_SESSION['user_id'].'");</script>';
             
             }
        
     }
     //show user snack log
    function snack_log(){
     $con = new users();
     $food= new food_log();
  $mysnacklog =$food->getUserSnack($_SESSION['user_id']);
        ?>
       <th>Date Added</th>
        <th>Description</th>
        <th>Calories</th>
        <th>Protein</th>
        <th>Fat</th>
        <th>Carbohydrates</th>
        <th>Sugar</th>
        <th>Food Group</th>
        <th>Actions</th>
      <?php
      while($row=mysqli_fetch_array($mysnacklog)){
       $id =$row['food_id'];
        $entry = $row['entry_type'];
           $timestamp =$row['date_a'];
       
       ?>
       <tr>
        <td><?php echo $row['date_a'];?></td> 
        <td><?php echo $row['name'];?></td>
        <td><?php echo $row['calories'];?></td>
        <td><?php echo $row['protein'];?></td>
        <td><?php echo $row['fat'];?></td>
        <td><?php echo $row['carbohydrates'];?></td>
        <td><?php echo $row['sugar'];?></td>
        <td><?php echo $row['food_group'];?></td>
        <td> 
         <form method="post" action ="profile.php">
            <input type="hidden" name="logid" value="<?php echo $id ?>"/>
            <input type="hidden" name="entrytype" value="<?php echo $entry ?>"/>
            <button type="submit" name="delete_snack" class="btn btn-default btn-sm">
              <span class="glyphicon glyphicon-remove"></span> Remove
            </button>
           </form>
        </td>
      </tr>
      <?php
      }
       //delete action for user snack item
     if(isset($_POST['delete_snack'])){
        echo $food->removeLogEntry($_POST['logid'],$_SESSION['user_id'],$_POST['entrytype']);
        echo '<script type="text/javascript">window.location.replace("https://weightmentor.eu/views/profile.php?id="'.$_SESSION['user_id'].'");</script>';
       
       }

        
    }

    //dispaly the water log in a table 
    function water_log(){
        $con = new users();
        $water= new water_log();
         $water_log = $water->getWaterLogEntry($_SESSION['user_id']);
        ?>
        <th>Date Added</th>
          <th>Time</th>
          <th>Quantity</th>
           <th>Unit</th>
          <th>Actions</th>
          <?php
          while($row=mysqli_fetch_array($water_log)){
            $waterr = $row['id'];
              $timestamp =$row['date_added'];
               $timestamp_array=explode(" ",$timestamp);
                $date=$timestamp_array[0];
                $time=$timestamp_array[1];
           ?>
            <tr>
              <td><?php echo $date;?></td>
              <td><?php echo $time;?></td>
              <td><?php echo $row['quantity'];?></td>
               <td><?php echo $row['unit'];?></td>
              <td>
                <form method="post" action ="profile.php">
                  <input type="hidden" name="userwater" value="<?php echo $waterr?>"/>
                     <input type="hidden" name="userwaterqty" value="<?php echo $row[3]?>"/>
                     <input type="hidden" name="userwaterunit" value="<?php echo  $row[4] ?>"/>
                    
                  <button type="submit" name="delete_water" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-remove"></span> Remove
                  </button>
                </form>
              </td>
           </tr>
          <?php
          }
          //delete action for users water
       if(isset($_POST['delete_water'])){
           echo $water->deleteWaterEntry( $_POST['userwater'],$_SESSION['user_id'],$_POST['userwaterqty'],$_POST['userwaterunit']);
            echo '<script type="text/javascript">window.location.replace("https://weightmentor.eu/views/profile.php?id="'.$_SESSION['user_id'].'");</script>';         
       }
          
        
    }

    //display the step log in a table
    function step_log(){

       $con = new users(); 
       $exercise = new exercise_log();

       $steplog = $exercise->getSteps($_SESSION['user_id']);
       ?>
       <th>Id</th>
       <th>Date Added</th>
       <th>Steps</th>
        <th>Calories Burned</th>
       <th>Distance</th>
       <th>Actions</th>
       
       <?php
       while($row=mysqli_fetch_array($steplog)){
        $id=$row['id'];
        $date =$row['date_A'];
        $steps =$row['steps'];
        $distance=$row['distance'];
        $calories =$row['calories'];
        ?>
       <tr>
         <td><?php echo $id;?></td>  
         <td><?php echo $date;?></td> 
         <td><?php echo $steps?></td> 
          <td><?php echo $distance;?></td> 
           <td><?php echo $calories;?></td> 
        
       
         <td> 
          <form method="post" action ="profile.php">


             <button type="submit" name="delete_exercise" class="btn btn-default btn-sm">
              <span class="glyphicon glyphicon-remove"></span> Remove
             </button>
            
          </form>
         </td>
       </tr>
        <?php
        }
          if(isset($_POST['delete_exercise'])){
        echo $exercise->remove_steps($id,$_SESSION['user_id'],$steps,$date,$calories);
        echo '<script type="text/javascript">window.location.replace("https://weightmentor.eu/views/profile.php?id="'.$_SESSION['user_id'].'");</script>';
        
       }
    }
}
?>
