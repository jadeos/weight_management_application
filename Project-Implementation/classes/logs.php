<?php
/*
  helper class with functions used to query database and handle part of views.
  Author: Jade O'Sullvan
  Date Created: 24/2/17

*/
  

 
 class logs{


    function weight_log(){

         $con = new users();
        $weight = new weight_log();
         $res =$con->searchUser($_SESSION['user_id']);
        $weightLog = $weight->getUserWLog($_SESSION['user_id']);
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
              <td><?php echo $row[1];?></td>
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
           //  echo '<script type="text/javascript">window.location.replace("http://localhost/Project-Implementation/views/profile.php?id="'.$_SESSION['user_id'].'");</script>';
          //echo '<script> window.location.href=document.url+"?id="'.$_SESSION['user_id'].'"#weightlog"</script>';
            // echo '<script>("#mydiv").load(location.href + " #mydiv");';
             ?>

            
             <?php
           
          }
          ?>
      
            <?php 
           
    }
    
    function exercise_log(){
           $con = new users(); 
           $exercise = new exercise_log();
             $exercise = new exercise_log();
          $exerciselog =$exercise->getExerciseLogItem($_SESSION['user_id']);
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
           <td><?php echo $row['type'];?></td> 
          <td><?php echo $row['length'];?></td> 
       
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
        echo '<script type="text/javascript">window.location.replace("http://localhost/Project-Implementation/views/profile.php?id="'.$_SESSION['user_id'].'");</script>';
        
       }
   

    
        
    }
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
             echo '<script type="text/javascript">window.location.replace("http://localhost/Project-Implementation/views/profile.php?id="'.$_SESSION['user_id'].'");</script>';
            
       }
       
      ?>

            <?php
         
     }
     
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
                   echo '<script type="text/javascript">window.location.replace("http://localhost/Project-Implementation/views/profile.php?id="'.$_SESSION['user_id'].'");</script>';
                 
                 }
              
     }
     
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
              echo '<script type="text/javascript">window.location.replace("http://localhost/Project-Implementation/views/profile.php?id="'.$_SESSION['user_id'].'");</script>';
             
             }
        
     }
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
        echo '<script type="text/javascript">window.location.replace("http:/localhost/Project-Implementation/views/profile.php?id="'.$_SESSION['user_id'].'");</script>';
       
       }
      ?>
    
<?php
        
    }
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
            echo '<script type="text/javascript">window.location.replace("http://localhost/Project-Implementation/views/profile.php?id="'.$_SESSION['user_id'].'");</script>';         
       }
          
        
    }
    
     
     /*
        For pagnation we need a few things, table name, no of fields in table and the no of dates that are the same. 
     */
    function pagnate($table,$no_matches,$date_matches){
        
        $pages = ceil(fetch_row($no_matches),0) * $date_matches;
        $start = ($page-1)*  $date_matches;                   $adjacent=$pages;
        $page = (isset($_GET['page'])) ? (int)$_GET['page']:1;   
        
        $prev_page= ($page==1)?1:$page-1;
        
       
    }
    

//maybe do dropdown with date ranges gotten from database, and use result in that query to get the dates of the items and display them. ie so onchange will dispaly selected date and will change when requested.
}
?>
