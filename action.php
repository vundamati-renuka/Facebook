<?php
include("config.php");
if( $_POST['action'] == "register" ){
		$errors = [];
        if( !preg_match("/^[A-Za-z\ ]{5,50}$/", trim($_POST['name']) ) ){
            $errors[] = "Name incorrect";
        }
        if( !preg_match("/^(male|female)$/", $_POST['gender'] ) ){
            $errors[] = "Gender incorrect";
        }
       if( !preg_match("/^[A-Za-z\ ]{5,50}$/", $_POST['state'] ) ){
            $errors[] = "State incorrect";
        }
        
         if( !preg_match("/^[A-Za-z\ ]{5,50}$/", $_POST['city'] ) ){
            $errors[] = "City incorrect";
        }
        if( !preg_match("/^[0-9\,]{3,8}$/", $_POST['pincode'] ) ){
            $errors[] = "Pincode incorrect";
        }
        if( !preg_match("/^[A-Za-z\ ]{5,50}$/", $_POST['email'] ) ){
            $errors[] = "Email incorrect";
        }
        if( !preg_match("/^[0-9\,]{3,8}$/", $_POST['mobile'] ) ){
            $errors[] = "Mobile incorrect";
        }
        if( !preg_match("/^[A-Za-z\ ]{5,50}$/", $_POST['username'] ) ){
            $errors[] = "Username incorrect";
        }
        if( !preg_match("/^[A-Za-z\ ]{5,50}$/", $_POST['password'] ) ){
            $errors[] = "Password incorrect";
        }
        $res = mysqli_query( $con, "select * from users where 
        username= '" . mysqli_escape_string($con, trim($_POST['username'])) . "' " );
        $row = mysqli_fetch_assoc($res);
        if( $row ){
        	$errors[] = "Username aleady exists!";
        }

        if( sizeof($errors) == 0 ){
        	$_SESSION['reg'] = $_POST;
        	$_SESSION['reg_errors'] = $errors;
        	header("Location: registrationform.php?event=error");
        	exit;
        }

    $query = "insert into users set 
    name = '" . mysqli_escape_string( $con, ucwords(trim($_POST['name'])) ) . "',
    gender = '" . mysqli_escape_string( $con, $_POST['gender'] ) . "',
    dob = '" . mysqli_escape_string( $con, $_POST['dob'] ) . "',
    state = '" . mysqli_escape_string( $con, $_POST['state_dropdown'] ) . "',
	city = '" . mysqli_escape_string( $con, $_POST['city_dropdown'] ) . "',
    pincode = '" . mysqli_escape_string( $con, $_POST['pincode'] ) . "',
    email = '" . mysqli_escape_string( $con, strtolower(trim($_POST['email'])) ) . "',
    mobile = '" . mysqli_escape_string( $con, $_POST['mobile'] ) . "',
    username = '" . mysqli_escape_string( $con, $_POST['username'] ) . "',
    password = '" . mysqli_escape_string( $con, md5($_POST['password']."something") ) . "'";
   
    unset($_SESSION['reg']);
    unset($_SESSION['reg_errors']);
   mysqli_query( $con, $query );
   header("Location: login.php?event=success");
   exit;
}

 
if ($_GET['action']=='check_username')
{
    $query = "select count(*) as cnt from users where username='".$_GET['username' ]."'";
    $res = mysqli_query($con, $query);
    $row=mysqli_fetch_assoc($res);
    $count=$row['cnt'];
    if( mysqli_error( $con ) )
    {
        echo json_encode([
            "status"=>"fail",
            "error"=>mysqli_error( $con )
        ],JSON_PRETTY_PRINT);
        exit;
    }
    if($count>0){
        echo json_encode([
            "status"=>"error",
        ],JSON_PRETTY_PRINT);
        exit;
    }
    echo json_encode([
        "status"=>"success",
    ],JSON_PRETTY_PRINT);
    exit;
}   


if ($_GET['action']=='check_email')
{
    $query = "select count(*) as cnt from users where email='".$_GET['email' ]."'";
    $res = mysqli_query($con, $query);
    $row=mysqli_fetch_assoc($res);
    $count=$row['cnt'];
    if( mysqli_error( $con ) )
    {
        echo json_encode([
            "status"=>"fail",
            "error"=>mysqli_error( $con )
        ],JSON_PRETTY_PRINT);
        exit;
    }
    if($count>0){
        echo json_encode([
            "status"=>"error",
        ],JSON_PRETTY_PRINT);
        exit;
    }
    echo json_encode([
        "status"=>"success",
    ],JSON_PRETTY_PRINT);
    exit;
}
// if( $_POST['action'] == "add_album" ){
// 	$res = mysqli_query($con, "insert into albums set name = '" . $_POST['album_name'] . "'");
// 	if(mysqli_error($con)){
// 		echo "Error inserting";
// 		exit;
// 	}
// 	header("Location: index.php?event=success");
// 	exit;
// }

			

?>