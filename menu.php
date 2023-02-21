<?php

echo "<pre>";
print_r( $_SERVER );

echo "sld";
exit;

require("config.php");
require("header.php");
?>

<html>
<head>
<style>
	.cover_pic {
			background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("images/3.jpg");
			height:300px;
			width:50%;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			position: relative;
			}
			.profile_pic{
			width: 200px;
			height: 200px;
			justify-content: center;
			align-content: center;
			display: flex;
			border-radius: 50%;
			border: 2px solid white;
			overflow: hidden;
			}
			.profile_pic img{
			min-height: 100%;
		    flex: 0;
		    min-width: 100%;
			}
	</style>
</head>


   <ul class="nav nav-pills"> 
   	<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#"><img src="images/image5.jpg" style="width:20px; height: 20px"></a>
  </li></ul>
<ul class="nav nav-pills justify-content-center">
  
  <li class="nav-item">
    <a class="nav-link" href="home.php"><img src="images/image6.jpg" style="width:30px; height: 30px"></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="friend.php"><img src="images/friendsicon.jpg" style="width:20px; height:30px"></a>
  </li>
  <li class="nav-item">
    <a class="nav-link"><img src="images/notificationicon.jpg" style="width:20px; height: 30px"></a>
  </li>
</ul>