<?php
/*
    File used for interaction with charts. 
    Used canvas.js frame work 
    URL: http://canvasjs.com/
    Authors: Jade O'Sullivan, Canvasjs.com
    Date Created: 4/3/17
    Date Modified: 26/3/17


*/
  // include_once '../db_models/users.php';
    $userLog = new weight_log();
    $data_points = array();
    $step_points =array();
    $user = new users();
    $foodlog = new food_log();
    $exerciseLog = new exercise_log();
    $date = date('Y-m-d');
    //get user steps 
    $steps = $exerciseLog->getSteps($_SESSION['user_id']);


    while($ex = mysqli_fetch_array($steps)){

       $date = date("d/m/Y", strtotime($ex['date_A'])); 
       $point = array("label" => $date, "y" => $ex['steps']);
       
         array_push($step_points, $point);

    }
   
    //user weight progrss chart details 
    $weightLog=$userLog->getUserLog($_SESSION['user_id']);
    //get food log for the user 
    $macros =$foodlog->getUserFoodLog($_SESSION['user_id'],$date);

     
    

    while($row=mysqli_fetch_array($weightLog)){
       // $sub = explode(" ",$row[0]);
       $date = date("d/m/Y", strtotime($row['date_added']));  
       $point = array("label" => $date, "y" => $row['previous_weight']);
       
         array_push($data_points, $point);

    }

 
  $protein_sum = 0;
  $carb_sum  = 0;
  $fat_sum =0;
  $today=0;

    //get the macros from the foods eaten for the current day. 
     while($row=mysqli_fetch_array($macros)){

          //Users macros progress
        
        //get all items from db 
        //add all protein fats and carbs
        $protein_sum += $row['protein'];
        $carb_sum +=$row['carbohydrates'];
        $fat_sum+= $row['fat'];
        $today =$row['today'];
        //format the date 
        $todayc = date_create($today);
        $todayf =date_format($todayc,"d/m/y");
    }

    //get the percentage for the total foods eaten in a single day 
    $total_percentage = $fat_sum +$protein_sum + $carb_sum;
    $fat = round($fat_sum / $total_percentage*100,2);
    $carb = round($carb_sum /$total_percentage*100,2);
    $protein = round($protein_sum /$total_percentage*100,2);

    


    if(($protein == 0)&&($fat==0)&&($carb ==0)){
        $empty ='No data has been entered for the current day';
      
        $dataP= array(
            
             array("y" => 100, "name" => "No  data")
           );

                
    }else{
        //populate the pie chart 
    $dataP = array(
                array("y" => $protein, "name" => "Protein", "exploded" => true),
                array("y" => $fat, "name" => "Fats"),
                array("y" => $carb, "name" => "Carbohydrates")
     );

    }
   
 
    

  
     //User Bmi cart calcualtions. 
    $current_BMI = 0;
    $weight = 0;
    $weight_unit=" ";
    $height = 0;
    $goal_BMI =0; 
    $height_unit =" ";
    $goal_weight =0;
    $calculated_current_weight=0;
    $calculated_goal_weight=0;
    $calculated_current_height =0; 
    $bmi_info = $user->get_BMI_info($_SESSION['user_id']);

    while($row=mysqli_fetch_array($bmi_info)){

       $weight =  $row['current_weight'];
       $weight_unit= $row['current_weight_unit'];
       $height= $row['height'];
       $height_unit=$row['height_unit'];
       $goal_weight =$row['goal_weight'];
          $current_weight_in_lbs=0;
          $goal_weight_in_lbs =0;
    }
    $date_added = "";
    $bmi_array = array();
    if(($weight_unit ==" ")&&($weight=" ")&&($height=="")){
     }else{

        //BMi calculation

        //make sure unit is in pounds. 
        if(($weight_unit != "lbs")||($weight_unit!="LBS")){
            //FIND THE WEIGHT UNIT AND CONVERT TO POUNDS
            if(($weight_unit=="KGS")||($weight_unit=="kgs")){
                 //CONVERSION TO POUNDS FROM KGS 
                //1kg=2.2pounds 
                $kg = 2.2; 
                $calculated_current_weight = $weight * $kg;
                $calculated_goal_weight = $goal_weight * $kg;
            }else{
                //CONVERSION TO POUNDS FROM STONE
                //1stone = 13 pounds. 
                $calculated_current_weight = $weight*14; 
                $calculated_goal_weight = $goal_weight * 14;
               // echo $calculated_goal_weight;

            }
        }else{
             $calculated_goal_weight = $goal_weight;
              $calculated_current_weight = $weight;
        } 
       // make sure height is in inches 
       if($height_unit != "inches"){
            //if cm, convert to inches, 
            if($height_unit=="cm"){
                //UNIT CONVERSION
                $cm = 0.3937;
                $calculated_current_height = $height *$cm; 
            }else{
                //FEET AND INCHES TO INCHES
                  $calculated_current_height = $height *12;
            }
        }
        else{

            $calculated_current_height = $height;
        }

        $goal_BMI=(($calculated_goal_weight  * 703)/($calculated_current_height *$calculated_current_height ));
        $current_BMI = (($calculated_current_weight  * 703)/($calculated_current_height *$calculated_current_height ));
        $weight_Array =array();
        while($row=mysqli_fetch_array($weightLog)){
            //array_push($weight_Array,$row['previous_weight']);

        }
 
    $dateArray=array(); 
    $dataArray = array();
    $weightArray=array();
    $recArray=array();
         $gpoints =array("y" =>$goal_BMI, "label"=>"Goal BMI<br/> ");
        
            array_push($data_Array, $gpoints);
       

      array_push($dataArray, $gpoints);

      $gpointss =array("y" =>$current_BMI,"label"=>"Current BMI");
        
            array_push($weightArray, $gpointss);
         $gpointsss =array("y" =>24.5, "label"=>"Reccomended BMI ");
         array_push($recArray, $gpointsss);
     }  



    
 ?>
  <script src="../../js/canvasjs.min.js"></script>
<script src="../../js/jquery.canvasjs.min.js"></script>
<script>
//step chart
 $(function () {
    var chart = new CanvasJS.Chart("stepChartContainer", {
        animationEnabled: true, 
        animationDuration: 10000, 
        theme: "theme2",
        zoomEnabled: true,
        animationEnabled: true,
        axisX:{
           viewportMinimum: 0,
       
        },
        subtitles:[
            {   text: "" }
        ],

            data: [{
            type: "line",                
            dataPoints: <?php echo json_encode($step_points, JSON_NUMERIC_CHECK); ?>
        } ]
    });
    chart.render();
});
//weight loss chart
 $(function () {
    var chart = new CanvasJS.Chart("container", {
        animationEnabled: true, 
        animationDuration: 10000, 
        theme: "theme2",
        zoomEnabled: true,
        animationEnabled: true,
        axisX:{
           viewportMinimum: 0,
       
        },
        subtitles:[
            {   text: "" }
        ],

            data: [{
            type: "line",                
            dataPoints: <?php echo json_encode($data_points, JSON_NUMERIC_CHECK); ?>
        } ]
    });
    chart.render();
});


var date = '<?php echo $todayf?>';
//macros
  $(function () {
        var chart = new CanvasJS.Chart("chartContainer",
        {
            animationEnabled: true, 
            animationDuration: 10000, 
            theme: "theme2",
            title:{
                text: date
            },
            exportFileName: "",
            exportEnabled: true,
            animationEnabled: true,     
            data: [
            {       
                type: "pie",
                showInLegend: true,
                toolTipContent: "{name}: <strong>{y}%</strong>",
                indexLabel: "{name} {y}%",
                dataPoints: <?php echo json_encode($dataP, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
    });


// //BMI 
$(function(){
 var chart = new CanvasJS.Chart("bmichartContainer",
 {
    animationEnabled: true, 
    animationDuration: 10000, 
    title:{
            text: ""
          },

          data: [
          {
         
            type: "bar",
            dataPoints:<?php echo json_encode($dataArray, JSON_NUMERIC_CHECK); ?>
          },
          {
            
            type: "bar",
            dataPoints: <?php echo json_encode($weightArray, JSON_NUMERIC_CHECK); ?>
          },
          {
            
            type: "bar",
            dataPoints: <?php echo json_encode($recArray, JSON_NUMERIC_CHECK); ?>
          },
          ]
        });

chart.render();


});
 


</script>


<?php


echo $user->updateBmi($current_BMI,$_SESSION['user_id']);
    

?>
