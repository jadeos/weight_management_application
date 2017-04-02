 



<?php 


//Code from https://(github.com/jeremiahlee/fitbit-web-demo 
// modified by Jade O'Sullivan on the 18/3/2017 to handle more queries to the database 
// If user hasn't authed with Fitbit, redirect to Fitbit OAuth Implicit Grant Flow

//if a session has been by clicking login with fitbit
if( $_SESSION['fitbit']==true){

?>
<script> 
var fitbitAccessToken;
var x =0; 
	//access the fitbit api login page if the user isnt logged in to fitbit
	 if (!window.location.hash) {
	 	window.location.replace('https://www.fitbit.com/oauth2/authorize?response_type=token&client_id=2285QS&redirect_uri=http%3A%2F%2Fweightmentor.jadeosullivan.com%2Fviews%2Fprofile.php&scope=activity%20heartrate%20location%20nutrition%20profile%20settings%20sleep%20social%20weight&expires_in=604800');
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
	console.log("processResponse");
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

//Logt the body fat percentage
var fat = function(res){
	console.log("Body Fat Query: Date: "+ res.fat[0].date + " Body Fat"+res.fat[0].fat+"%");
}

//Get Steps and goal steps and activities
 var json = function(res){

	//if the request is sucessfull log the steps taken 
	var html = document.getElementById("steps");
	var goal = res.goals.steps;
	var taken = res.summary.steps;
	var remaining = goal -taken;
	html.innerText = "Goal: "+res.goals.steps +"\n Taken: "+res.summary.steps+"\n  Remaining: "+remaining;
 	console.log("Activities Query: Steps taken from fitbit: " +res.summary.steps);
 	console.log(res);
}

//get weight, BMI etc
var weight =function(res){
	console.log("Weight Query: Date: "+res.weight[0].date+" Weight:"+res.weight[0].weight+" BMI: "+res.weight[0].bmi);
}
	
//access token begins with undefined, need to split it so that it grabs just access token
var token = fitbitAccessToken.slice(9);
var auth ='Bearer ' + token;

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
console.log(today);

//get Body fat for a single week starting on the current day
fetch(

'https://api.fitbit.com/1/user/-/body/log/fat/date/'+today+'/1w.json',
{
	headers: new Headers({
	'Authorization': auth
	}),
	mode: 'cors',
	method: 'GET'
}
).then(processResponse)
.then(fat)
.catch(function(error) {
console.log(error);
});


//get body weight
fetch(

'https://api.fitbit.com/1/user/-/body/log/weight/date/'+today+'/1m.json',
{
	headers: new Headers({
	'Authorization': auth
	}),
	mode: 'cors',
	method: 'GET'
}
).then(processResponse)
.then(weight)
.catch(function(error) {
console.log(error);
});
</script>
<?php

}
?>

