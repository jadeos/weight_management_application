/* 
Script will be used for basic functions that relate to progressive web app functionalities
Created by : Jade O'Sullivan 
Date: 15/2/17
Updated : 
*/
//window.onload = init();

//When page loads, basic functions should be called. 
//function init(){

	//detect if mobile or web browser 
// 	detect_device(); 
// 	if (navigator.serviceWorker) {
//     navigator.serviceWorker.register('../service-workers.js', {scope: './about'})
//         .then(function (registration) {
//             console.log(registration);
//         })
//         .catch(function (e) {
//             console.error(e);
//         })
//         console.log("SUPPORTED");
        
// 	} else {
// 	    console.log('Service Worker is not supported in this browser.');
// 	}
// 	self.addEventListener('install', function(event){
// 	console.log(event);
// 	console.log("install");
// 	});

// 	self.addEventListener('activate', function(event){
// 	    console.log(event);
// 	    console.log("activate");
// 	});
// 	//access camera based on button click 
// 	access_camera();

// 		//make sure that Service Workers are supported.


// }


// //perform wearable device functionalities. 
// //eg: bluetooth, location  

// function detect_device(){
// 	//check for mobile device or web browser 
// 	  testExp = new RegExp('Android|webOS|iPhone|iPad|' +
// 	    		       'BlackBerry|Windows Phone|'  +
// 	    		       'Opera Mini|IEMobile|Mobile' ,
// 	    		      'i');

// 	  	if (testExp.test(navigator.userAgent)){
// 	        alert(	"Your device is a Mobile Device");

// 		}else{
// 		  alert("Your device is NOT a Mobile Device");
// 		}

// }

// function access_camera(){
// 	//check for browser support to access camera (if needed for some pages eg photo uploading...)
// 	if (!navigator.mediaDevices.getUserMedia) {
// 	    alert("Your browser doesn't have support for the navigator.getUserMedia interface.");
// 	}else{
// 		navigator.mediaDevices.getUserMedia = (
// 		    navigator.getUserMedia ||  navigator.webkitGetUserMedia ||  navigator.mozGetUserMedia ||  navigator.msGetUserMedia
// 		);
// 		alert("media supported");
// 	}
// }

// function request_bluetooth_permission(){

// }

// function request_location_permission(){

// }


