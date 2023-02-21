<?php

function repl($m){
	return "<span class='text-red' >" . $m[0] . "</span>";
}

if( $_POST['action']=="friend_request"){

	$query = "select id from users where name = '" . mysqli_escape_string($con, $_POST['friend_id']) . "' ";
	$res  = mysqli_query( $con, $query );
	$row = mysqli_fetch_assoc( $res );
	$friend_id = $row['id'];

	$query = "select friend_id from friends where user_id = '" . $_SESSION['login_id']. "' and friend_id = '" . $friend_id . "' ";
	$res  = mysqli_query( $con, $query );
	$row = mysqli_fetch_assoc( $res );
	if( !$row ){

		$query = "insert into friends set 
		user_id = '" . $_SESSION['login_id'] . "',
		friend_id = '". $friend_id . "',
		status = 'Requested' ";
		$res  = mysqli_query( $con, $query );

		$query = "insert into friends set 
		user_id = '" . $friend_id . "',
		friend_id = '". $_SESSION['login_id'] . "',
		status = 'Received' ";
		$res  = mysqli_query( $con, $query );

	}

	echo json_encode(["status"=>"success"]);
	exit;
}
if( $_POST['action']=="friend_request_accept"){
	
		$query = "update  friends set
		status = 'Accepted'  
		where user_id = '". $_POST["friend_id"] . "'and friend_id='". $_SESSION['login_id'] . "'";
		$res  = mysqli_query( $con, $query );


		$query = "update friends set 
		status = 'Accepted'  
		where user_id = '". $_SESSION['login_id'] . "'and friend_id='". $_POST["friend_id"] . "'";
		$res  = mysqli_query( $con, $query );

		echo json_encode(["status"=>"success"]);
		exit;

	}
if( $_POST['action']=="friend_request_reject"){
	
		$query = "update  friends set
		status = 'Rejected'  
		where user_id = '". $_POST["friend_id"] . "'and friend_id='". $_SESSION['login_id'] . "'";
		$res  = mysqli_query( $con, $query );


		$query = "update friends set 
		status = 'Rejected'  
		where user_id = '". $_SESSION['login_id'] . "'and friend_id='". $_POST["friend_id"] . "'";
		$res  = mysqli_query( $con, $query );

		echo json_encode(["status"=>"success"]);
		exit;

}

if( $_GET['action']=="search_friends"){
	
	$query = "select id, username, name from users where name like '%". $_GET['keyword'] . "%' ";
	$res = mysqli_query( $con, $query );
	$friends = [];
	while( $row = mysqli_fetch_assoc( $res ) ){
		$friends[] = [
			"label"=> $row['name'],
			"value"=>$row['name']
		];
		//preg_replace_callback("/".$_GET['keyword']."/i", "repl", $row['name'])
	}
	//header("Content-Type: application/json");
	echo json_encode(["status"=>"success", "friends"=>$friends]);
	exit;
}
if( $_GET['action']=="get_friends_list"){
	
	$query = "select a.*, b.name from (
	select * from friends where user_id  = '" . $_SESSION['login_id'] . "' 
	) as a 
	left join users as b
	on ( a.friend_id = b.id )
	";
	$res = mysqli_query( $con, $query );
	$friends = [];
	while( $row = mysqli_fetch_assoc( $res ) ){
		$friends[] =$row;
	}
	//header("Content-Type: application/json");
	echo json_encode(["status"=>"success", "friends"=>$friends]);
	exit;
}

?>