<?php
//include_once '../config/db.php';
include_once '../database/database.php';
//class required for user weight information.update not needed as will always be updated and each update should be shown.
class weight_log{

  //log all weight added by any user in a common table.
  function insertWeight($weight,$user_id){
      $res=sqlQuery("INSERT INTO weight_log (date_added,previous_weight,user_id) VALUES (now(),'$weight','$user_id')");
      
  }

  //GET ALL WEIGHT INFO FOR THE USER WHO WANTS TO ACCESS IT
  function getUserLog($user_id){
    $res=sqlQuery("SELECT * FROM weight_log WHERE user_id='$user_id' ORDER BY date_added ASC ");
    return $res;
  }

  //delete users weight
  function deleteWeight($weight,$user_id){
    $res= sqlQuery("DELETE FROM weight_log WHERE previous_weight='$weight' and user_id = '$user_id' LIMIT 1");
    echo '<script type="text/javascript">window.location.replace("https://weightmentor.eu/views/profile.php?id="'.$_SESSION['user_id'].'");</script>';

  }
    function countAll($user_id){
        $res = sqlQuery("SELECT COUNT(*)`total` FROM weight_log WHERE user_id = '$user_id'");
        return $res;
    }

     //GET ALL WEIGHT INFO FOR THE USER WHO WANTS TO ACCESS IT
  function getUserWLog($user_id,$start_from,$limit){
  
    $res=sqlQuery("SELECT * FROM weight_log WHERE user_id='$user_id' ORDER BY date_added  LIMIT $start_from, $limit");
    return $res;
  }

  function update_weight($weight,$id,$user_id){
    $res=sqlQuery("UPDATE `weight_log` SET previous_weight ='$weight' WHERE id = '$id' and user_id = '$user_id'");
   
  }
}
