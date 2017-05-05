<?php
 include_once '../index.php';
    if(!isset($_SESSION)){
    session_start();
  }

?>
<div class="panel panel-default" height="auto" style="margin-left: 1%;background-color:lightgrey">
  <h1 style="margin-left:35%;">Weight Mentor Homepage</h1>
<div id="carousel-example-generic" class="carousel slide" style="margin-left:5%; margin-right:5%; margin-top:5%; height:25%; background-color:transparent;" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" height="30%">
    <div class="item active">
      <img style="margin-left: 20%;" src="../img/exercise.jpg" alt="..."  width="57.5%">
      <div class="carousel-caption">
      	<h3></h3>
      </div>
    </div>
    <div class="item">
      <img style="margin-left: 20%; height:40%;" src="../img/weightloss.jpg" alt="weight"  width="60%">
      <div class="carousel-caption">
      	<h3></h3>
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div> <!-- Carousel -->

<div class="panel panel-default" style="margin-top:5%;margin-left: 5%; margin-right:5%;background-color:lightgrey">
  <div class="panel-body" style="margin-left:42%;"><h2>About Us</h2></div>
  <p style="margin-left:5%; margin-right:5%;">
  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
  </p>

</div>
</div>
<br/>
<br/>
<br/>
<br/>
