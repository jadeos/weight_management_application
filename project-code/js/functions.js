/*Javascript file to represent basic functions for all uses*/

/*this function shortens get element by id*/
function getId(obj){
  return document.getElementById(obj);
}


function changeToAnalytics(){
    getId('usersL').style.display="none";
    getId('analytics').style.display="inline";

}
function changeToUsers(){
    getId('analytics').style.display="none";
    getId('usersL').style.display="inline";

}

function changeToDashboard(){
 //   getId('about_user').style.visibility="hidden";
    getId('weightlog').style.visibility="hidden";
    getId('weightlog').style.display="none";
   // getId('about_user').style.display="none";
    getId('foodlog').style.visibility="hidden";
    getId('foodlog').style.display="none";
    getId('exerciselog').style.visibility="hidden";
    getId('exerciselog').style.display="none";
    getId('waterlog').style.visibility="hidden";
     getId('waterlog').style.display="none";
     getId('dashboard').style.visibility="visible";
    getId('dashboard').style.display="inline";
    //     getId('settings').style.visibility="hidden";
    // getId('settings').style.display="none";


}

function changeToWeightLog(){

   // getId('about_user').style.visibility="hidden";
    getId('weightlog').style.visibility="visible";
    getId('weightlog').style.display="inline";
  //  getId('about_user').style.display="none";
    getId('foodlog').style.visibility="hidden";
    getId('foodlog').style.display="none";
    getId('exerciselog').style.visibility="hidden";
    getId('exerciselog').style.display="none";
    getId('waterlog').style.visibility="hidden";
   getId('waterlog').style.display="none";
    getId('dashboard').style.visibility="hidden";
   getId('dashboard').style.display="none";
    // getId('settings').style.visibility="hidden";
    // getId('settings').style.display="none";

  }
/*Function changeMenuOptions changes the tabbed menu in the user profile page*/
function changeToProfile(){

   // getId('about_user').style.visibility="visible";
    getId('weightlog').style.visibility="hidden";
    getId('weightlog').style.display="none";
   //   getId('about_user').style.display="inline";
  getId('foodlog').style.visibility="hidden";
  getId('foodlog').style.display="none";
  getId('exerciselog').style.visibility="hidden";
  getId('exerciselog').style.display="none";
     getId('waterlog').style.visibility="hidden";
   getId('waterlog').style.display="none";
    getId('dashboard').style.visibility="hidden";
   getId('dashboard').style.display="none";
    // getId('settings').style.visibility="hidden";
    // getId('settings').style.display="none";


}
function changeToFoodLog(){
   getId('foodlog').style.visibility="visible";
   getId('foodlog').style.display="inline";
  // getId('about_user').style.display="none";
   getId('weightlog').style.visibility="hidden";
   getId('weightlog').style.display="none";
  // getId('about_user').style.visibility="hidden";
   getId('exerciselog').style.visibility="hidden";
   getId('exerciselog').style.display="none";
      getId('waterlog').style.visibility="hidden";
   getId('waterlog').style.display="none";
    getId('dashboard').style.visibility="hidden";
   getId('dashboard').style.display="none";
    // getId('settings').style.visibility="hidden";
    // getId('settings').style.display="none";

}
function changeToExLog(){
   getId('exerciselog').style.visibility="visible";
   getId('exerciselog').style.display="inline";
  // getId('about_user').style.display="none";
   getId('weightlog').style.visibility="hidden";
   getId('weightlog').style.display="none";
  // getId('about_user').style.visibility="hidden";
   getId('foodlog').style.visibility="hidden";
   getId('foodlog').style.display="none";
    getId('waterlog').style.visibility="hidden";
   getId('waterlog').style.display="none";
    getId('dashboard').style.visibility="hidden";
   getId('dashboard').style.display="none";


}
function changeToWaterLog(){
   getId('waterlog').style.visibility="visible";
   getId('waterlog').style.display="inline";
 //  getId('about_user').style.display="none";
   getId('weightlog').style.visibility="hidden";
   getId('weightlog').style.display="none";
  // getId('about_user').style.visibility="hidden";
   getId('foodlog').style.visibility="hidden";
   getId('foodlog').style.display="none";
    getId('exerciselog').style.visibility="hidden";
   getId('exerciselog').style.display="none";
    getId('dashboard').style.visibility="hidden";
   getId('dashboard').style.display="none";
   // getId('settings').style.visibility="hidden";
   //  getId('settings').style.display="none";

}

function showSearchResults(){
    getId('food_search_results').style.display="inline";

    
    
}
function showExSearchResults(){
    getId('ex_search_results').style.display="inline";

    
    
}

function activity_log_options(){
  console.log("activity_log_options");
  var select = document.getElementById("ex_log_type");
  var option = select.options[select.selectedIndex].value;
   if(option == "Activity Log"){
    showActivityLog();
   }else{
     showStepLog();
   }
}
function showActivityLog(){
  getId('exercise_log_table').style.display="inline";
   getId('step_log_table').style.display="none";
}

function showStepLog(){
  getId('step_log_table').style.display="inline";
   getId('exercise_log_table').style.display="none";

}

function showGeneralSettings(){
  getId('general').style.display="inline";
  getId('notifications').style.display="none";
  getId('security').style.display="none";
  getId('gen').className="active";

}
 function showNotificationSettings(){
     getId('general').style.display="none";
  getId('notifications').style.display="inline";
  getId('security').style.display="none";
   getId('not').className="active";
 }

 function showSecuritySettings(){
   getId('general').style.display="none";
  getId('notifications').style.display="none";
  getId('security').style.display="inline";
   getId('sec').className="active";

 }
