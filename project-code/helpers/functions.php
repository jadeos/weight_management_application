<?php

/*
  Class used to manage different functions and short cut different commands such as loading css, js scripts etc
  @author Jade O'Sullivan 
  Date Created: 1/8/16
  Date Modified: 07/2/17
*/
class functions {
 
   //load css files
 function loadcss($data){
  
   $link ='<link href ="https://weightmentor.eu/'.$data.'" rel="stylesheet" type ="text/css" /><br/>';
   return $link;
 }

 //load js Files
 function loadjs($data){


   $script ='<script type ="text/javascript" src="https://weightmentor.eu/'.$data.'"></script>';
   return $script;
 }

 //log to console for debugging purposes
 function console_log($message){
   $script = "<script>console.log('".$message."');</script>";
   return $script;
 }

 //redirect to a page
 function redirect($location){
  
   $link = header("Location: ".$location);
   return $link;
 }
 function loadBasepath(){
   return   include_once '../index.php';
 }

//function include_all($file=arra{
//   for($x=0;$x<=count($file);$x++){
    ///
    //    include_once $file[x];
    
//}
 



}
