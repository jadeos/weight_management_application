<?php 


//Code from https://(github.com/jeremiahlee/fitbit-web-demo 
// modified by Jade O'Sullivan on the 18/3/2017 to handle more queries to the database 
// If user hasn't authed with Fitbit, redirect to Fitbit OAuth Implicit Grant Flow

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

//if a session has been by clicking login with fitbit
if( $_SESSION['fitbit']==true){

?>
<script> 
var fitbitAccessToken;
var x =0; 
	//access the fitbit api login page if the user isnt logged in to fitbit
	 if (!window.location.hash) {
	 	window.location.replace('https://www.fitbit.com/oauth2/authorize?response_type=token&client_id=2285QS&redirect_uri=https%3A%2F%2Fweightmentor.eu%2Fviews%2Fprofile.php&scope=activity%20heartrate%20location%20nutrition%20profile%20settings%20sleep%20social%20weight&expires_in=604800');
	 } else {
		 	//the user is already logged in, get the access token from the URL. 
			var fragmentQueryParameters = {};
			window.location.hash.slice(1).replace(
			new RegExp("([^?=&]+)(=([^&]*))?", "g"),
			function($0, $1, $2, $3) { fragmentQueryParameters[$1] = $3; }
			);
			fitbitAccessToken += fragmentQueryParameters.access_token;
		
	}
	

// Make the API request to fitbit
var processResponse = function(res) {
	//console.log("processResponse");
	//if the request failed, log the error
	if (!res.ok) {
		throw new Error('Fitbit API request failed: ' + res.status);
	}
	var contentType = res.headers.get('content-type');
	if (contentType && contentType.indexOf("application/json") !== -1) {
		return res.json();
	} else {
		throw new Error('JSON expected but received ' + contentType);
	}
}

//get the activitie log 
// var activty_log = function(res){
// 	//console.log("Activity log : Activity Name "+res.activities[0].activityName+" Calories "++res.activities[0].)
// }

// //Log the body fat percentage
var fat = function(res){

// 	//console.log("Body Fat Query: Date: "+ res.fat[0].date + " Body Fat"+res.fat[0].fat+"%");
 }

//Get Steps and goal steps and activities
 var json = function(res){

	//if the request is sucessfull log the steps taken 
	var html = document.getElementById("steps");
	var ht = document.getElementById("step_summary");
	var goal = res.goals.steps;
	var taken = res.summary.steps;
	var remaining = goal -taken;
	html.innerText = "Goal: "+res.goals.steps +"\n Taken: "+res.summary.steps+"\n  Remaining: "+remaining;
	ht.innerText ="Total Steps Taken: "+res.summary.steps+"\n";
	ht.style.marginLeft = "75%";


	//graph steps from fitbit 
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
            dataPoints:[
            	{ x: new Date(), y: res.summary.steps},
            	{ x: new Date(2017, 05, 3), y: 1240},
            	{ x: new Date(2017, 05, 4), y: 5640},
            	{ x: new Date(2017, 05, 4), y: 1240},
            	{ x: new Date(2017, 05, 5), y: 1240},
            	{ x: new Date(2017, 05, 6), y: 2340},
            	{ x: new Date(2017, 05, 5), y: 1240}
            	
            	]
        } ]
    });
    chart.render();
});
    
  var images = [];
  var fruits= [];
  
  images.push({url: "http://i.imgur.com/UW6SbIn.png"});
  images.push({url: "http://i.imgur.com/Bqgq9ry.png"});
  images.push({url: "http://i.imgur.com/Pv9DAKM.png"});
  images.push({url: "http://i.imgur.com/wAgXbZW.png"});
  images.push({url: "http://i.imgur.com/tAJym5D.png"});

  addImages(chart);

  function addImages(chart){
    for(var i = 0; i < chart.data[0].dataPoints.length; i++){
      var label = chart.data[0].dataPoints[i].label;
      
      if(label){
        fruits.push( $("<img>").attr("src", images[i].url)
                    .attr("class", label)
                    .css("display", "none")
                    .appendTo($("#stepChartContainer"))
                   );        
      }
      
      positionImage(fruits[i], i);
    }    
  }
  
  function positionImage(fruit, index){ 
    var imageBottom = chart.axisX[0].bounds.y1;     
    var imageCenter = chart.axisX[0].convertValueToPixel(chart.data[0].dataPoints[index].x);
    
    fruit.width(chart.dataPointWidth * .5);
    fruit.height(chart.dataPointWidth * .42);
    fruit.css({"position": "absolute", 
               "display": "block",
               "top": imageBottom  - fruit.height(),
               "left": imageCenter - fruit.width()/2
              });
    chart.render();
  }
  
  $( window ).resize(function() {
    for(var i = 0; i < chart.data[0].dataPoints.length; i++){
    	positionImage(fruits[i], i);
    }
  }); 
}
  




//get weight, BMI etc
var weight =function(res){
	var html = document.getElementById('current_weight');
	// var date = res.weight[0].date;
	 var weight = res.weight[0].weight;
	// var bmi = res.weight[0].bmi;
	// html.innerText = "<label>Current Weight: </label> "+ weight; 
	 console.log(res.weight);
	//console.log("Weight Query: Date: "+res.weight[0].date+" Weight:"+res.weight[0].weight+" BMI: "+res.weight[0].bmi);
}

var calories = function(res){
	var html = document.getElementById("Calories");
	html.innerText = "Calories Consumed: "+res.summary.calories;


}

var getInfo = function(res){
		console.log(res);
}


	
//access token begins with undefined, need to split it so that it grabs just access token
var token = fitbitAccessToken.slice(9);
var auth ='Bearer ' + token;
//get the current date, and use it when querying fitbits database
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();

if(dd<10) {
    dd='0'+dd
} 

if(mm<10) {
    mm='0'+mm
} 

today = yyyy+'-'+mm+'-'+dd;

//fetch the activities (ie steps) for today
fetch(

'https://api.fitbit.com/1/user/-/activities/date/today.json',
{
	headers: new Headers({
	'Authorization': auth
	}),
	mode: 'cors',
	method: 'GET'
}
).then(processResponse)//make the api request 
.then(json) //dislpay information in the steps div
.catch(function(error) {
console.log(error);
});

//get the total calories eaten for the day
fetch(

'https://api.fitbit.com/1/user/-/foods/log/date/2017-04-03.json',
{
	headers: new Headers({
	'Authorization': auth
	}),
	mode: 'cors',
	method: 'GET'
}
).then(processResponse)//make the api request 
.then(calories) //dislpay information in the steps div
.catch(function(error) {
console.log(error);
});


//get activitie logs 
// fetch(
// 'https://api.fitbit.com/1/user/-/activities/list.json'
// {
// 	headers: new Headers({
// 	'Authorization': auth
// 	}),
// 	mode: 'cors',
// 	method: 'GET'
// }

// ).then(processResponse)
// .then(activty_log)
// .catch(function(error) {
// console.log(error);
// });


//get user information 
fetch(

'https://api.fitbit.com/1/user/-/profile.json',
{
	headers: new Headers({
	'Authorization': auth
	}),
	mode: 'cors',
	method: 'GET'
}
).then(processResponse)
.then(getInfo)
.catch(function(error) {
console.log(error);
});


//get Body fat for a single week starting on the current day
// fetch(

// 'https://api.fitbit.com/1/user/-/body/log/fat/date/'+today+'/1w.json',
// {
// 	headers: new Headers({
// 	'Authorization': auth
// 	}),
// 	mode: 'cors',
// 	method: 'GET'
// }
// ).then(processResponse)
// .then(fat)
// .catch(function(error) {
// console.log(error);
// });


// //get body weight
// fetch(

// 'https://api.fitbit.com/1/user/-/body/log/weight/date/'+today+'/1m.json',
// {
// 	headers: new Headers({
// 	'Authorization': auth
// 	}),
// 	mode: 'cors',
// 	method: 'GET'
// }
// ).then(processResponse)
// .then(weight)
// .catch(function(error) {
// console.log(error);
// });
</script>
<?php

}
?>

