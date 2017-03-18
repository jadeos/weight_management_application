<?php

require 'assets/helpers/functions.php';
$helper = new functions();
?>
<!Doctype html>
<html lang ="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
   <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
   <![endif]-->
    <title> Weight Mentor</title>
<?php

	//costom css
   echo $helper->loadcss('assets/css/main.css');
    //bootstrap styles
   echo $helper->loadcss('assets/css/bootstrap.css');
   echo $helper->loadcss('assets/css/bootstrap-theme.min.css');
  echo $helper->loadcss('assets/css/bootstrap.min.css');

	//bootstrap/JQuery/highcharts
	 echo $helper->loadjs("assets/js/jquery-2.2.4.min.js");
	  // echo $helper->loadjs("js/pagtest.js");
	 echo $helper->loadjs("assets/js/bootstrap.js");

   //custom js
   echo $helper->loadjs('assets/js/index.js');

 
   echo $helper->loadjs('assets/js/functions.js');
  




  include_once 'classes/register_process.php'; 
  include_once 'classes/login.php';

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


