/* 
*	For the profile page we need to activate the tabs on refresh.
* 	First we set a cookie variable to identify the tab selected. 
* 	Linked with functions.jd, and  the change of the html, cookies are used to keep the html selected up on users return to the page.
*	
*/

/*
* Set the cookie value based on the value assigned to the to function call. 
*/
function setActiveProfileTab(val){

	if(val == 0){
		document.cookie = "tab=0";
	}else if(val == 1){
		document.cookie = "tab=1";
	}else if(val==2){
		document.cookie = "tab=2";
	}else if(val==3){
		document.cookie = "tab=3";
	}else if(val==4){
		document.cookie = "tab=4";
	}else if(val==5){
		document.cookie="tab=5";
	}else if(val==6){
		document.cookie="tab=6";
	}
}


/*
* Load the selected tab upon page refresh by checking the value of the tab cookie string. 
* Based on the value of the cookie, we check if it matches the value assigned to each tab upon function call
*/

function loadActiveProfileTab(){


	var tab = readCookie("tab");
	
	if(tab==0){
		document.getElementById('dash').className="active";
		// $('.nav nav-tabs a[href="#dashboard"]').tab('show');
	 changeToDashboard();
	}else if(tab==1){
		document.getElementById('profile').className="active";
	// $('.nav-tabs a[href="#about_user"]').tab('show');
	 changeToProfile();

	}else if(tab==2){
		document.getElementById('weighta').className="active";
	 
	 changeToWeightLog();

	}else if(tab==3){
		document.getElementById('fooda').className="active";
	  changeToFoodLog();
	

	}else if(tab==4){

	document.getElementById('exa').className="active";
	 changeToExLog();

	}else if(tab==5){

	document.getElementById('wat').className="active";
	 changeToWaterLog();

	}
	else if(tab==6){

	document.getElementById('se').className="active";
	 changeToSettings();

	}

}

/*
* Get the cookie string selected for one or multiple cookies set.
*/
function readCookie(name) {
	var name2 = name + "=";
	//split the cookie string (if more than one cookies) after the ; 
	var ca = document.cookie.split(';');
	//loop through each to identify the each cookie and get the cookie string.
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(name2) == 0) return c.substring(name2.length,c.length);
	}
	return null;
}

