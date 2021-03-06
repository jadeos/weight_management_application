 //Code from https://github.com/jeremiahlee/fitbit-web-demo 
// If user hasn't authed with Fitbit, redirect to Fitbit OAuth Implicit Grant Flow
var fitbitAccessToken;
if (!window.location.hash) {
window.location.replace('https://www.fitbit.com/oauth2/authorize?response_type=token&client_id=2285QS&redirect_uri=http%3A%2F%2Flocalhost%2FProject-Implementation%2Fviews%2Fprofile.php%2F&scope=activity%20heartrate%20location%20nutrition%20profile%20settings%20sleep%20social%20weight&expires_in=604800');
} else {
	var fragmentQueryParameters = {};
	window.location.hash.slice(1).replace(
	new RegExp("([^?=&]+)(=([^&]*))?", "g"),
	function($0, $1, $2, $3) { fragmentQueryParameters[$1] = $3; }
	);
	fitbitAccessToken += fragmentQueryParameters.access_token;
}



// Make an API request and graph it
var processResponse = function(res) {
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
	// var html = document.getElementById("steps");
	// html.appendChild(res.summary.steps);
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
