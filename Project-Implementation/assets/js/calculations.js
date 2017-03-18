//
//  calculateBmr is used to estimate the total amount of calories the user can have a day.(Basic Motabolic Rate)
//  It take account weither or not the user is male or female.

function calculateBmr(weight,age,height,gender){
  var bmr = 23;
	if(gender == "male"){
     bmr = 66 +(13.7 * weight)+(5*height)-(6.8 *age);
	}else if(gender == "female"){
		bmr = 655 +(9.6 * weight)+(1.8*height)-(4.7 *age);
	}
  return Math.round(bmr);
}
/*
  calculate BMI is used to estimate the users body mass index
*/
function calculateBmi(weight,height){
     var bmi = 0;
     bmi = weight / height * height;
     return Math.round(bmi);
     document.getElementById("").innerHTML = Math.round(bmr);
}
/*
  The next few functins estimate the converson between different units of weight including lbs, kgs, stone
*/
function kgToLbs(kgs){
  var lbs = kgs * 2.2046;
  return lbs;

}

function kgToStone(kgs){
  var stone = kgs * 0.15747;
  return stone;
}

function stoneToKg(stone){
  var kgs= stone / 0.15747;
  return kgs;
}
function stoneToLbs(stone){
  var lbs= stone * 14.000;
  return lbs;
}
function lbsToKg(lbs){
  var kgs = lbs / 2.2046;
  return kgs;
}
function lbsToStone(lbs){
  var stone = lbs * 0.071429;
  return stone;
}
