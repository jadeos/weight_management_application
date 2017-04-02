
<!Doctype html>
<?php

     if(!isset($_SESSION)){
    session_start();
  }
require 'helpers/functions.php';
$helper = new functions();
?>

<html lang ="en">
  <head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <link rel="manifest" href="./manifest.json">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
   <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
   <![endif]-->
    <title> Weight Mentor</title>
<?php
 
	//costom css
   echo $helper->loadcss('css/main.css');
     //  echo $helper->loadcss('assets/css/bootstrap-responsive.min.css');
    //bootstrap styles
   echo $helper->loadcss('css/bootstrap.css');
   echo $helper->loadcss('css/bootstrap-theme.min.css');
  echo $helper->loadcss('css/bootstrap.min.css');


	//bootstrap/JQuery/highcharts
	 echo $helper->loadjs("js/jquery-2.2.4.min.js");
	  // echo $helper->loadjs("js/pagtest.js");
	 echo $helper->loadjs("js/bootstrap.js");

   //custom js
    echo $helper->loadjs('js/service_workers.js');
   echo $helper->loadjs('js/notifications.js');
  // echo $helper->loadjs('js/index.js'); 
  echo $helper->loadjs('js/functions.js');
  echo $helper->loadjs('js/search.js');
   

    include_once 'classes/notifications.php';
  include_once 'classes/register_process.php'; 
  include_once 'classes/login.php';


$notification = new Notifications();
  //RANDOMISED MESSAGES (IE DAILY FACTS?)
  echo $notification->populate();

 ?>
   <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
   <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
     <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
   <![endif]-->

</head>
<body>


<?php

include_once 'views/includes/header.php';
include_once 'views/includes/login_register_model.php';
include_once 'views/includes/footer.php';


