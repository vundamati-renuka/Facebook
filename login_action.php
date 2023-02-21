<?php

if( $_POST['action'] == "login" ){

	if( $_POST['code']== $_SESSION['login_code'] ){
		unset($_SESSION['login_code']);

		if( $_POST['username'] && $_POST['password'] ){

			$res = mysqli_query( $con, "select * from users where 
			username = '" . mysqli_escape_string($con, $_POST['username']). "' ");
			if( mysqli_error($con) ){
				echo json_encode([
					"status"=>"fail",
					"error"=>"Server error: " . mysqli_error($con)
				]);
				exit;
			}
			$user = mysqli_fetch_assoc($res);
			if( !$user ){
				echo json_encode([
					"status"=>"fail",
					"error"=>"Username not found"
				]);
				exit;
			}else{
				if( $user['password'] == md5($_POST['password']."something") ){
					$_SESSION['login_status'] = "yes";
					$_SESSION['login_id'] = $user['id'];
					echo json_encode([
						"status"=>"success",
					]);
					exit;
				}else{
					echo json_encode([
						"status"=>"fail",
						"error"=>"Password incorrect"
					]);
					exit;
				}
			}

		}else{
			echo json_encode([
				"status"=>"fail",
				"error"=>"Need credentials"
			]);
			exit;
		}
	}else{
		echo json_encode([
				"status"=>"fail",
				"error"=>"Incorrect security code"
		]);
		exit;
	}
	
	header("Location: menu.php?event=success");
	exit;
}

?>