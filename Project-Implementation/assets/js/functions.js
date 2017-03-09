/*Javascript file to represent basic functions for all uses*/

/*this function shortens get element by id*/
function getId(obj){
  return document.getElementById(obj);
}

function changeToWeightLog(){

    getId('about_user').style.visibility="hidden";
    getId('weightlog').style.visibility="visible";
    getId('weightlog').style.display="inline";
    getId('about_user').style.display="none";
    getId('foodlog').style.visibility="hidden";
    getId('foodlog').style.display="none";
    getId('exerciselog').style.visibility="hidden";
    getId('exerciselog').style.display="none";
    getId('waterlog').style.visibility="hidden";
   getId('waterlog').style.display="none";

  }
/*Function changeMenuOptions changes the tabbed menu in the user profile page*/
function changeToProfile(){

    getId('about_user').style.visibility="visible";
    getId('weightlog').style.visibility="hidden";
    getId('weightlog').style.display="none";
      getId('about_user').style.display="inline";
  getId('foodlog').style.visibility="hidden";
  getId('foodlog').style.display="none";
  getId('exerciselog').style.visibility="hidden";
  getId('exerciselog').style.display="none";
     getId('waterlog').style.visibility="hidden";
   getId('waterlog').style.display="none";


}
function changeToFoodLog(){
   getId('foodlog').style.visibility="visible";
   getId('foodlog').style.display="inline";
   getId('about_user').style.display="none";
   getId('weightlog').style.visibility="hidden";
   getId('weightlog').style.display="none";
   getId('about_user').style.visibility="hidden";
   getId('exerciselog').style.visibility="hidden";
   getId('exerciselog').style.display="none";
      getId('waterlog').style.visibility="hidden";
   getId('waterlog').style.display="none";

}
function changeToExLog(){
   getId('exerciselog').style.visibility="visible";
   getId('exerciselog').style.display="inline";
   getId('about_user').style.display="none";
   getId('weightlog').style.visibility="hidden";
   getId('weightlog').style.display="none";
   getId('about_user').style.visibility="hidden";
   getId('foodlog').style.visibility="hidden";
   getId('foodlog').style.display="none";
    getId('waterlog').style.visibility="hidden";
   getId('waterlog').style.display="none";

}
function changeToWaterLog(){
   getId('waterlog').style.visibility="visible";
   getId('waterlog').style.display="inline";
   getId('about_user').style.display="none";
   getId('weightlog').style.visibility="hidden";
   getId('weightlog').style.display="none";
   getId('about_user').style.visibility="hidden";
   getId('foodlog').style.visibility="hidden";
   getId('foodlog').style.display="none";
    getId('exerciselog').style.visibility="hidden";
   getId('exerciselog').style.display="none";

}
function showSearchResults(){
    getId('food_search_results').style.display="inline";

    
    
}
function showExSearchResults(){
    getId('ex_search_results').style.display="inline";

    
    
}

