<?php

require("config.php");

if( $_POST['action'] == "add_album" ){
	$res = mysqli_query($con, "insert into albums set name = '" . $_POST['album_name'] . "'");
	if(mysqli_error($con)){
		echo "Error inserting";
		exit;
	}
	header("Location: index.php?event=success");
	exit;
}


if( $_POST['action'] == "load_images" ){
	$res = mysqli_query($con, "select * from album_files where album_id = " . $_POST['album_id'] );
	if(mysqli_error($con)){
		echo json_encode([
		"status"=> "error",
		"error"=>mysqli_error($con)
	]);
	exit;		
	}
	$images = [];
	while( $row = mysqli_fetch_assoc($res) ){
		$images[] = $row;
	}

	echo json_encode([
		"status"=> "success",
		"images"=> $images
	]);
	exit;
}
if( $_POST['action'] == "upload2" ){
	sleep(1);
	//print_r( $_FILES );exit;

	if( !preg_match("/\.(jpg|jpeg|png|gif)$/i", $_FILES['image']['name']) ){
		echo json_encode([
				"status"=> "error",
				"error"=> "Image file required"
		]);
		exit;
	}

	$folder = "albums/" . $_POST['album_id'];
	//file_exists()
	if( !is_dir($folder) ){
		mkdir($folder); 
	}
	$dest_filename = $folder . "/" . $_FILES['image']['name'];

	//echo $dest_filename;exit;

	try{
		if( move_uploaded_file($_FILES['image']['tmp_name'], $dest_filename ) ){
			$ers = mysqli_query($con, "insert into album_files set album_id = '" . $_POST['album_id'] . "',
			file_name = '" . mysqli_escape_string($con,$_FILES['image']['name']) . "',
			description= '" . $_POST['description'] . "'");
				if(mysqli_error($con)){
					echo json_encode([
					"status"=> "error",
					"error"=> mysql_error($con)
					]);	
				exit;
				}
			echo json_encode([
				"status"=> "success",
			]);
		}else{
			echo json_encode([
				"status"=> "error",
				"error"=> "File upload failed"
			]);
		}
	}catch(Exception $ex){
		echo json_encode([
				"status"=> "error",
				"error"=> "File upload failed" . $ex->getMessage()
			]);
	}
	exit;
}

if( $_GET['action'] == "delete_image" ){
        $query = "delete from album_files where id = " .$_GET['id'] ;
        mysqli_query( $con, $query );
            if( mysqli_error( $con ) ){
                echo json_encode([
                "status"=>"fail",
                "error"=>mysqli_error( $con )
            ],JSON_PRETTY_PRINT);
                exit;
        }

        echo json_encode([
            "status"=>"success",
        ],JSON_PRETTY_PRINT);
        exit;
}


?>