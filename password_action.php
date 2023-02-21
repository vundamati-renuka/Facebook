<?php
require "config.php";
if($_POST['action']=='search'){
	$query2="select id,username,dob from users where 
	username='".mysqli_escape_string( $con, $_POST['username']) ."' 
	and dob='".mysqli_escape_string( $con, $_POST['date'])."' ";
	//echo $query2;exit;
	$res2=mysqli_query($con,$query2);
	if(mysqli_error($con)){
		echo "Error Query".mysqli_error($con);
	}
	$_SESSION['username']=$_POST['username'];
	$row3=mysqli_fetch_assoc($res2);
	if($row3){
		$_SESSION['forgot_step2_record']=$row3;
		header("Location: password.php?show=step2");
		exit;
	}else{
		$_SESSION['forgot_error'] = "User record not found!";
		header('Location: password.php?event=error');
		exit;
	}
}

//print_r( $_POST );exit;

if($_POST['action']=='resetpw'){
	if($_POST["password1"]==$_POST["password2"]){
		$query4="update users set password='".md5($_POST['password1'].'something')."' where username='".$_SESSION['username']."'";
		//echo $query4;exit;
		$res3=mysqli_query($con,$query4);
		if( mysqli_error($con) ){
			$_SESSION['forgot_step2_error'] = "Database error: " . mysqli_error($con);
			header("Location: ?show=step2&event=error");
			exit;
		}
		unset($_SESSION['forgot_step2_error']);
		unset($_SESSION['forgot_error']);
		unset($_SESSION['forgot_step2_record']);
		header('Location: ?show=thankyou');
		exit;
	}else{
		$_SESSION['forgot_step2_error'] = "Passwords does not match!";
		header("Location: ?show=step2&event=error");
		exit;
	}

	exit;
}
?>
		
