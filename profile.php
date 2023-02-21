<?php
require("config.php");
$page_name = "profile";

require("header.php");
?>









<table border=1 cellpadding="5"><tbody id="upload_list_div" >
</tbody></table>
<div><input type="button" value="Upload" onclick="start_upload()" ></div>
<div>&nbsp;</div>
<div id="list_div" ></div>

<script>
load_images();
	var upload_list = [];
	






function start_upload(){
	f = upload_list[ upload_image_index ]['file'];
	d = upload_list[ upload_image_index ]['des'];

	if( f.name.match(/\.(jpg|jpeg|png|gif)$/i) ==null ){
	 	alert("please select image file");return false;
	}

	var formdata = new FormData();
	formdata.append("action", "upload2");
	formdata.append("album_id", <?=$_GET['album_id'] ?> );
	formdata.append("image", f);
	formdata.append("description", d  );
	
	$.ajax({
		method:"POST",
		url: "action.php",
		processData: false,
		contentType: false,
		data: formdata,
		xhr: function() {
	        var xhr = $.ajaxSettings.xhr();
	        xhr.upload.onprogress = function(e) {
	        	if(e.lengthComputable){
		            var progress = Math.ceil((e.loaded/ e.total) * 100);
		            console.log(e.loaded+" "+e.total);
					document.getElementById("image_"+upload_image_index).style.width = progress+"%";
					document.getElementById("image_percentage_"+upload_image_index).innerHTML= progress+"%";
				}
	        };
	        return xhr;
    	},
	}).progress(function(){
		$("#status_"+upload_image_index).html( "Uploading...");
	}).done(function(msg){
		$("#status_"+upload_image_index).html( "Done");
		check_next_image();
		load_images();
	});
}
function load_images(){
	$.ajax({
		method:"POST",
		url: "profileaction.php",
		data: {
			"action":"load_images",
			"album_id": <?=$_GET['album_id'] ?>
		},
		//processData: false,
		//contentType: false,
	}).done(function(msg){
		try{
			resp = JSON.parse( msg );
			if( resp['status'] == "success" ){
				images_list = resp['images'];
				generate_images();
			}else{

			}
		}catch(e){
			alert("REsonse parse failed");
		}
	});	
}


load_images();
	delete_img_id=0;
    function delete_image(i){
    	delete_img_id=i;
        formdata = "?action=delete_image";
        formdata += "&id="+ encodeURIComponent( i );
        var request = $.ajax({
        url: "profileaction.php"+formdata,
        method: "GET", 
        
        success:function( responseText ) {
            try{
                resp = JSON.parse( responseText );
                if( resp['status'] == "success" ){
                    alert("Data deleted successfully!");
                    images_list.splice(delete_img_id,1);
                    load_images();
                }else{
                    alert("delete error " + resp['error']);
                }
            }catch(e){
                alert("Response parse failed! " + e);
            }
        },
        error:function( jqXHR, textStatus ) {
            alert("Something wrong: " + textStatus );
        }
    });
    }
</script>
<style>
	.album_image { position: relative; width:200px; height: 150px; float:left; margin: 5px; border-radius: 5px; box-shadow: 2px 2px 5px #333; }
	.album_image img{ width:100%; height: 100%; vertical-align: middle; border-radius: 5px; }
	.album_image input{ position: absolute; right:0px; display:none }
	.album_image:hover{ box-shadow: 2px 2px 5px red; }
	.album_image:hover input{ display:block }
	.main{width:300px;border: 1px solid black;margin-left: 10px;border-radius:5px;}
	
	
	.sub{ width:1%; height: 20px; background-color: blue;}
	</style>







</div>
</body>
</html>