<?php
require("config.php");

$page_name = "home";
//require("home_actions.php");

require("header.php");
require("menuheader.php");
?>

<style>
	.cover_pic {
			background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("images/3.jpg");
			height:300px;
			width:70%;
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
			position: absolute;
			top:45%;
			}
			.profile_pic img{
			min-height: 100%;
		    flex: 0;
		    min-width: 100%;
			}
	</style>
</head>
<div class="container">
<center><div class="cover_pic"></div></center>
	<div class="row">
			<div class="col-5"></div>
			<div class="col-3">

			<div class="profile_pic">
				<img src="images/4.jpg" class="rounded-circle">
			</div>        

			</div>
			<div class="col-5"></div>
  	</div>

  	<div class="username"><p></p></div>
</div>


	