<?php
//include_once '../config/db.php';
include_once'../database/db.php';
global $connection;

/*
 Food Log interacts with two tables. User_Food_Log and Food Directory.
 User_Food_Log is a link table to link the user id of the user and the food id together.
 Food Directory consists of a food id which will be used in a join to get the food of the user
 We need to be able to connect to the users table however this will be done through a session variable stored when logged in.

*/
class food_log{

  //retrieve all information from the log for a user
  function getUserFoodLog($id, $date){
    $res=sqlQuery("SELECT CURDATE() `today`, d.protein,d.fat,d.carbohydrates FROM user_food_log l JOIN food_directory d ON d.food_id = l.food_id WHERE l.user_id='$id' AND l.date_a='$date' ORDER BY l.date_a DESC");
    return $res;

  }
  //function to retrieve a food item from food drirectory-search 
  function getFoodDirectoryItem($item){
    $res=sqlQuery("SELECT * FROM food_directory WHERE name LIKE '%$item%' OR food_group LIKE '%$item%' ");
    return $res;
  }
  //get the food item from user food log eg users food that was logged
  function getUserBreakfast ($user_id){
      $res=sqlQuery("SELECT l.food_id, l.date_a, d.food_group, d.name,d.calories,d.protein,d.fat,d.carbohydrates,d.sugar,l.entry_type FROM user_food_log l JOIN food_directory d ON d.food_id = l.food_id WHERE l.user_id='$user_id' AND l.entry_type LIKE 'breakfast' ORDER BY l.date_a DESC");
     
      return $res;
  }
  function getUserLunch ($user_id){
      $res=sqlQuery("SELECT l.food_id, l.date_a,  d.food_group, d.name,d.calories,d.protein,d.fat,d.carbohydrates,d.sugar,l.entry_type FROM user_food_log l 
      JOIN food_directory d ON d.food_id = l.food_id WHERE l.user_id='$user_id' AND l.entry_type LIKE 'lunch' ORDER BY l.date_a DESC");
      return $res;
  }
   function getUserDinner ($user_id){
      $res=sqlQuery("SELECT l.food_id, l.date_a,  d.food_group, d.name,d.calories,d.protein,d.fat,d.carbohydrates,d.sugar,l.entry_type  FROM user_food_log l 
    JOIN food_directory d ON d.food_id = l.food_id WHERE l.user_id='$user_id' AND l.entry_type LIKE 'dinner'  ORDER BY l.date_a DESC");
      return $res;
  }
   function getUserSnack($user_id){
      $res=sqlQuery("SELECT l.food_id, l.date_a,  d.food_group, d.name,d.calories,d.protein,d.fat,d.carbohydrates,d.sugar,l.entry_type FROM user_food_log l 
      JOIN food_directory d ON d.food_id = l.food_id WHERE l.user_id='$user_id' AND l.entry_type LIKE 'snack'  ORDER BY l.date_a DESC");
      return $res;
  }


  // //insert food item to food directory-used when creating a custon item.
   function insertIntoDirectory($group,$name,$calories,$sugar,$fat,$protein,$carbs){
       $res=sqlQuery("INSERT INTO food_directory (food_group, name, calories, sugar, fat, protein, carbohydrates) VALUES ('$group','$name','$calories','$sugar','$fat','$protein','$carbs')");
        return $res;
   }

  // //Add a food to the food log upon entry
   function insertIntoFoodLog($user_id,$food_id,$entry_type){
    //TODAYS DATE
    $date = date('Y-m-d');
     $res=sqlQuery("INSERT INTO user_food_log (date_a, user_id, food_id, entry_type) VALUES ('$date','$user_id','$food_id', '$entry_type')");
    //echo "test";
    //$res =sqlQuery("INSERT INTO user_food_log (date_a, user_id, food_id, entry_type) VALUES (now(),'28','5', 'breakfast')");
   }
  
  
   function removeLogEntry($id,$user_id,$entry_type) {
     $res=sqlQuery("DELETE FROM user_food_log WHERE food_id= '$id' and user_id = '$user_id' AND entry_type ='$entry_type' LIMIT 1");
  
   }
}



 ?>
