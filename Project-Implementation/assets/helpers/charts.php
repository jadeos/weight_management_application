<?php
/*
    File used for interaction with charts. 
    Used canvas.js frame work 
    URL: http://canvasjs.com/
    Authors: Jade O'Sullivan, Canvasjs.com
    Date Created: 4/3/17
    Date Modified: 8/3/17


*/
  // include_once '../db_models/users.php';
    $userLog = new weight_log();
    $data_points = array();
    $user = new users();
    
    //user weight progrss chart details 
    $weightLog=$userLog->getUserLog($_SESSION['user_id']);
    
    while ($row = fetch_row($weightLog)) {
       // $sub = explode(" ",$row[0]);
       $date = date("d/m/Y", strtotime($row[0]));

           
        $point = array("label" => $date, "y" => $row[1]);
        
        array_push($data_points, $point);        
    }
    
    //Users macros progress
    $dataP = array(
                array("y" => 35, "name" => "Protein", "exploded" => true),
                array("y" => 20, "name" => "Fats"),
                array("y" => 55, "name" => "Carbohydrates")
            );

    // //User Bmi cart calcualtions. 
    // /*
    //     1.Current Weight 
    //     2. Height
    //     3. Square. 
    // */
    $current_BMI = 0;
    $weight = 0;
    $weight_unit=" ";
    $height = 0;
    $goal_BMI = 25.5; 
    $bmi_info = $user->get_BMI_info($_SESSION['user_id']);
    while($row=fetch_row($bmi_info)){
       $weight =  $row[0];
       $weight_unit= $row[1];
       $height= $row[2];
    }
    $date_added = "";
    $bmi_array = array();
    if(($weight_unit ==" ")&&($weight=" ")&&($height=="")){
        $weight = "No Weight Or height logged";
     }else{
        //BMi calc
        //make sure unit is in pounts. 
        if(($weight_unit != "lbs")||($weight_unit!="LBS")){
            //FIND THE WEIGHT UNIT AND CONVERT TO POUNDS
            if(($weight_unit=="KGS")||($weight_unit=="kgs")){
                //do the conversion -kgs to pounds

            }else{
                //stones to pounds

            }
        }

        //make sure height is in inches 
        // if(){
        //     //if cm, convert to inches, 
        //     //if feet convert to inches
   

        // if ($unit == "metric") {
        //   echo "A height of $height Meters and a weight of $weight Kilograms = " . round($metric, 1) . " BMI.<br />";
          $bmi = ($weight / ($height * $height));
        // } else if ($unit == "imperial") {
        //   echo "A height of $height Inches and a weight of $weight Pounds = " . round($imperial, 1) . " BMI.<br />";
        //   $bmi = (($weight * 703)/($height * $height));
        // }

if (isset($bmi)) {
  if ($bmi <= 18.5) {
    echo "Your BMI is below normal";
  } else if ($bmi >= 18.5 && $bmi <= 24.9) {
    echo "Your BMI is normal";
  } else {
    echo "Your BMI is above normal";
  }
}
      
        //find date the weight was logged 
        while ($row = fetch_row($weightLog)) {
           // $sub = explode(" ",$row[0]);
           $date_added .= date("d/m/Y", strtotime($row[0]));

          }
       // $dataP = array(
       //          array("y" => $, "name" => "Protein", "exploded" => true),
       //          array("y" => 20, "name" => "Fats"),
       //          array("y" => 55, "name" => "Carbohydrates")
       //      );

     //  array_push($date_added, var)

     }

    



 ?>
 <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
//weight loss chart
 $(function () {
    var chart = new CanvasJS.Chart("container", {
        theme: "theme2",
        zoomEnabled: true,
        animationEnabled: true,
        title: {
            text: "Weight Progress"
        },
        subtitles:[
            {   text: "" }
        ],
        data: [
        {
            type: "line",                
            dataPoints: <?php echo json_encode($data_points, JSON_NUMERIC_CHECK); ?>
        }
        ]
    });
    chart.render();
});

//macros
  $(function () {
        var chart = new CanvasJS.Chart("chartContainer",
        {
            theme: "theme2",
            title:{
                text: "Nutritional Information"
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

//BMI 
$(function () {
    var chart = new CanvasJS.Chart("bmichartContainer", {
                zoomEnabled: false,
                        animationEnabled: true,
            title:{
                text: "BMI History"
            },
            axisY2:{
                valueFormatString:"0.0 bn",
                
                maximum: 1.2,
                interval: .2,
                interlacedColor: "#F5F5F5",
                gridColor: "#D7D7D7",      
                tickColor: "#D7D7D7"                                
            },
                        theme: "theme2",
                        toolTip:{
                                shared: true
                        },
            legend:{
                verticalAlign: "bottom",
                horizontalAlign: "center",
                fontSize: 15,
                fontFamily: "Lucida Sans Unicode"

            },
            data: [
            {        
                type: "line",
                lineThickness:3,
                showInLegend: true,           
                name: "Goal BMI",
                axisYType:"secondary",
                dataPoints: [
                { x: new Date(2001, 00), y: 0.25 },
                { x: new Date(2002, 00), y: 0.25 },
                { x: new Date(2003, 0), y: 0.25},
                { x: new Date(2004, 0), y: 0.25 },
                { x: new Date(2005, 0), y: 0.25 },
                { x: new Date(2006, 0), y: 0.25 },
                { x: new Date(2007, 0), y: 0.25 },
                { x: new Date(2008, 0), y: 0.25  },
                { x: new Date(2009, 0), y: 0.25},
                { x: new Date(2010, 0), y: 0.25 },
                { x: new Date(2011, 0), y: 0.25 },
                { x: new Date(2012, 0), y: 0.25 }


                ]
            },
            {        
                type: "line",
                lineThickness:3,
                showInLegend: true,           
                name: "Current BMI",        
                axisYType:"secondary",
                dataPoints: [
                { x: new Date(2001, 00), y: 0.16 },
                { x: new Date(2002, 0), y: 0.17 },
                { x: new Date(2003, 0), y: 0.18},
                { x: new Date(2004, 0), y: 0.19 },
                { x: new Date(2005, 0), y: 0.20 },
                { x: new Date(2006, 0), y: 0.23 },
                { x: new Date(2007, 0), y: 0.261 },
                { x: new Date(2008, 0), y: 0.289  },
                { x: new Date(2009, 0), y: 0.3 },
                { x: new Date(2010, 0), y: 0.31 },
                { x: new Date(2011, 0), y: 0.32 },
                { x: new Date(2012, 0), y: 0.33 }


                ]
            }
            ],
          legend: {
            cursor:"pointer",
            itemclick : function(e) {
              if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
              e.dataSeries.visible = false;
              }
              else {
                e.dataSeries.visible = true;
              }
            chart.render();
            }
          }
        });
    chart.render();
});

        
            



</script>

<?php
    

?>
