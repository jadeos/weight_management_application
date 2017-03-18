<?php
/* File Used to log user out of account. */
require '../assets/helpers/functions.php';
$helper = new functions();
  session_start();
  session_unset();
  session_destroy();
 
  header("Location: ../views/home.php");
