 



<?php 
//Code from https://(github.com/jeremiahlee/fitbit-web-demo 
// modified by Jade O'Sullivan on the 18/3/2017
// If user hasn't authed with Fitbit, redirect to Fitbit OAuth Implicit Grant Flow

//if 
if( $_SESSION['fitbit']==true){
?>
<script> 
var fitbitAccessToken;
var x =0; 
	//access the fitbit api login page if the user isnt logged in to fitbit
	 if (!window.location.hash) {
	 	window.location.replace('https://www.fitbit.com/oauth2/authorize?response_type=token&client_id=2285QS&redirect_uri=http%3A%2F%2Flocalhost%2FProject-Implementation%2Fviews%2Fprofile.php&scope=activity%20heartrate%20location%20nutrition%20profile%20settings%20sleep%20social%20weight&expires_in=604800');
	 } else {
		 	//the user is already logged in, get the access token. 
			var fragmentQueryParameters = {};
			window.location.hash.slice(1).replace(
			new RegExp("([^?=&]+)(=([^&]*))?", "g"),
			function($0, $1, $2, $3) { fragmentQueryParameters[$1] = $3; }
			);
			fitbitAccessToken += fragmentQueryParameters.access_token;
		
	}
	

//console.log("The access token is: "+window.location.hash);

// Make an API request and graph it
var processResponse = function(res) {
	console.log("processResponse");
	if (!res.ok) {
		throw new Error('Fitbit API request failed: ' + res.status);
	}
	var contentType = res.headers.get('content-type')
	if (contentType && contentType.indexOf("application/json") !== -1) {
	
	return res.json();

	} else {
	throw new Error('JSON expected but received ' + contentType);
	}
}
 var json = function(res){

	//if the request is sucessfull log the steps taken 
	var html = document.getElementById("steps");
	html.innerText = res.summary.steps;
 	console.log(res.summary.steps);	
}
	
//access token begins with undefined, need to split it so that it grabs just access token
var token = fitbitAccessToken.slice(9);
var auth ='Bearer ' + token;

fetch(

'https://api.fitbit.com/1/user/-/activities/date/today.json',
{
	headers: new Headers({
	'Authorization': auth
	}),
	mode: 'cors',
	method: 'GET'
}
).then(processResponse)
.then(json)
.catch(function(error) {
console.log(error);
});
</script>
<?php
}
?>

