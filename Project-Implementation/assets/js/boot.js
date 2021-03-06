//Code from https://github.com/jeremiahlee/fitbit-web-demo 
// If user hasn't authed with Fitbit, redirect to Fitbit OAuth Implicit Grant Flow
var fitbitAccessToken;


if (!window.location.hash) {
    window.location.replace('https://www.fitbit.com/oauth2/authorize?response_type=token&client_id=2285QS&redirect_uri=http%3A%2F%2Flocalhost%2FProject-Implementation%2Fviews%2Fprofile.php&scope=activity%20heartrate%20location%20nutrition%20profile%20settings%20sleep%20social%20weight&expires_in=604800');
} else {
    var fragmentQueryParameters = {};
    window.location.hash.slice(1).replace(
        new RegExp("([^?=&]+)(=([^&]*))?", "g"),
        function($0, $1, $2, $3) { fragmentQueryParameters[$1] = $3; }
    );

    fitbitAccessToken = fragmentQueryParameters.access_token;
}

// Make an API request and graph it
var processResponse = function(res) {
    if (!res.ok) {
        throw new Error('Fitbit API request failed: ' + res);
    }else{
        console.log("Api Request successful");
    }

    var contentType = res.headers.get('content-type');
    if (contentType && contentType.indexOf("application/json") !== -1) {
        return res.json();
    } else {
        throw new Error('JSON expected but received ' + contentType);
    }
}

$.getJSON('https://api.fitbit.com/1/user/-/activities/steps/date/today/1m.json', function(fitbit){
    console.log(fitbit.activities.steps);
});


// var processHeartRate = function(timeSeries) {
//     return timeSeries['activities-heart-intraday'].dataset.map(
//         function(measurement) {
//             return [
//                 measurement.time.split(':').map(
//                     function(timeSegment) {
//                         return Number.parseInt(timeSegment);
//                     }
//                 ),
//                 measurement.value
//             ];
//         }
//     );
// }

// var graphHeartRate = function(timeSeries) {
//    // console.log(timeSeries);
//     var data = new google.visualization.DataTable();
//     data.addColumn('timeofday', 'Time of Day');
//     data.addColumn('number', 'Heart Rate');

//     data.addRows(timeSeries);

//     var options = google.charts.Line.convertOptions({
//         height: 450
//     });

//     var chart = new google.charts.Line(document.getElementById('chart'));

//     chart.draw(data, options);
// }

// fetch(
//     'https://api.fitbit.com/1/user/-/activities/steps/date/today/1m.json'
//     //'GET https://api.fitbit.com/1/user/-/activities/date/.json'
//     //'GET https://api.fitbit.com/1/user/-/activities/heart/date/2016-03-19/1d/1sec/time/21:00/23:00.json',
//     {
//         headers: new Headers({
//             'Authorization': 'Bearer ' + fitbitAccessToken
//         }),
//         mode: 'cors',
//         method: 'GET'
//     }
//     console.log(activities.steps);
// ).then(processResponse)
// .then(processHeartRate)
// .then(graphHeartRate)
// .catch(function(error) {
//     //console.log(error);
// });


