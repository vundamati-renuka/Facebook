<?php

session_start();

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

$con = mysqli_connect("localhost", "root", "", "facebook" );
if( mysqli_connect_error() ){
    echo "There was an error: " . mysqli_connect_error();
    exit;
}

if( $_GET['action'] == "logout"){
	session_destroy();
	header("Location: login?event=Logout");
	exit;
}

if( preg_match("/(login)/", $_SERVER['REQUEST_URI'] ) ){
	if( $_SESSION['login_status'] == "yes" ){
		header("Location: home?event=Welcome");
		exit;
	}
}else if( preg_match("/(login|password|captc|registration)/", $_SERVER['REQUEST_URI'] ) ){

}else{
	if( $_SESSION['login_status'] != "yes" ){
		header("Location: login.php?event=SessionExpired");
		exit;
	}else{
		$res = mysqli_query($con, "select * from users where id = " . $_SESSION['login_id']);
		$login_user = mysqli_fetch_assoc($res);
		if( !$login_user ){
			session_destroy();
			header("Location: login.php?event=SessionExpired");
			exit;
		}
	}
}

?>