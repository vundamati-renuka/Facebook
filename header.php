<html>
<head>
    <title>Facebook</title>
   
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
       <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <style>
    #result{color: red}	
    .status_login_pic{
    	border:1px solid black; 
    	border-radius:50%; 
    	width:40px; 
    	height:40px; 
    	display:inline-block; 
    	margin-right:20px; 
    	overflow: hidden;
    }
    .status_login_pic img{
    	width: 40px;
    	min-height: 100%;
    	min-width: 100%;	
    	height: 40px;
    }
    </style>
    
</head>
<body>
	<div class="container-fluid" >
		<div class="row">
			<div class="col-8">
				<h1 style="text-align: center;color: blue">FACEBOOK</h1>
			</div>
			<div class="col-4">
				<?php if( $_SESSION['login_status'] == "yes"){
					echo "<div class='status_login_pic' ><img src='images/3.jpg' alt=''>  </div>";
					echo ucwords($login_user['name']) . " ";
					echo "<a href='?action=logout' class='btn btn-dark btn-sm'>Logout</a>";
				}else{
					echo "<a href='registrationform.php' class='btn btn-default btn-sm'>Register</a>";
				}
				?>
			</div>
		</div>

		