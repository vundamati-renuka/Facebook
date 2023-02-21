<?php
require("config.php");
require("friends_actions.php");
$page_name ="friends";
require("header.php");
?>

<div class="mb-2">
	<input type="text" id="search_friend" >
	<input type="button" value="Send Friend Request" class="btn btn-outline-primary btn-sm" onclick="send_friend_request()" >
</div>

<script>
$( "#search_friend" ).autocomplete({
  source: [],
  search: function( event, ui ) {
  		$.ajax({
  			"method":"get",
  			"url": "?action=search_friends&keyword=" + $("#search_friend").val(),
  			//"processData"
  		}).done(function(msg){
  			var list = JSON.parse(msg);
			console.log( list['friends'] );
  			$( "#search_friend" ).autocomplete("option", "source", list['friends']);
  		});
  }
});
</script>

<table class="table table-bordered table-sm table-striped">
<tr>
    <td>Friend</td>
    <td>Status</td>    
</tr>
<tbody id="friends_list_div" ></tbody>
</table>
 <!-- addstate modal-->
  

<script>
	 var friends_list = [];
        function generate_friends(){
        	console.log(friends_list);
            var str = "";
            for(var i=0;i<friends_list.length;i++){
                str = str + `<tr>
                    <td>`+friends_list[i]['name']+`</td>
                    <td>`+friends_list[i]['status']+`</td>
                    <td>`;
                    if( friends_list[i]['status'] =='Received' ){
                    	str = str + `<input type="button" value="Accept" onclick="accept_friend(`+friends_list[i]["friend_id"]+`)" class="btn btn-primary" >
                    	<input type="button" value="Reject" onclick= "reject_friend(`+friends_list[i]["friend_id"]+`) " class="btn btn-danger">`;
                	}else if( friends_list[i]['status'] =='requested' ){
                		str = str + `Yet to accept!`;
                	}else{

                	}
                str = str + `</td></tr>`;
            }
            document.getElementById("friends_list_div").innerHTML = str;
        }
    
		function send_friend_request(){
            vpostdata = "action=friend_request";
			vpostdata += "&friend_id="+ $("#search_friend").val();
			
            var con = new XMLHttpRequest();
            con.open("POST", "?", true);
            con.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            con.onreadystatechange = function(){
                if( this.readyState == 4 ){
                    if( this.status == 200 ){
                        try{
                            resp = JSON.parse( this.responseText );
                            if( resp['status'] == "success" ){
                            	$("#search_friend").val("");
                                load_friends();
                            }else{
                                alert("Save error " + resp['error']);
                            }
                        }catch(e){
                            alert("Response parse failed! " + e);
                        }
                    }else{
                        alert("Something wrong: " + this.status );
                    }
                }
            }
            con.send(vpostdata);
        }
        
        function load_friends(){
            var con = new XMLHttpRequest();
            con.open("GET", "?action=get_friends_list", true);
            con.onreadystatechange = function(){
                if( this.readyState == 4 ){
                    if( this.status == 200 ){
                        
                        //this.responseText[0] == "["
                        try{
                            resp = JSON.parse( this.responseText );
                            if( resp['status'] == "success" ){
                                friends_list = resp['friends'];
                                generate_friends();
                            }else{
                                alert("There was an error at server: "+ resp['error']);
                            }
                        }catch(e){
                            alert("Failed to parse response data: \n" + e);
                        }
                    }else{
                        alert("Something wrong: " + this.status );
                    }
                }
            }
            con.send();
        }

        load_friends();

		function accept_friend(friend_id){

		vpostdata = "action=friend_request_accept";
		vpostdata =vpostdata+"&friend_id="+friend_id;
		var con = new XMLHttpRequest();
		con.open("POST", "?", true);
		con.setRequestHeader("content-type", "application/x-www-form-urlencoded");
		con.onreadystatechange = function(){
		    if( this.readyState == 4 ){
		        if( this.status == 200 ){
		            try{
		                resp = JSON.parse( this.responseText );
		                if( resp['status'] == "success" ){
		                	
		                    load_friends();
		                }else{
		                    alert("Save error " + resp['error']);
		                }
		            }catch(e){
		                alert("Response parse failed! " + e);
		            }
		        }else{
		            alert("Something wrong: " + this.status );
		        }
		    }
		}
		con.send(vpostdata);
		}
		function reject_friend(friend_id){

		vpostdata = "action=friend_request_reject";
		vpostdata =vpostdata+"&friend_id="+friend_id;
		var con = new XMLHttpRequest();
		con.open("POST", "?", true);
		con.setRequestHeader("content-type", "application/x-www-form-urlencoded");
		con.onreadystatechange = function(){
		    if( this.readyState == 4 ){
		        if( this.status == 200 ){
		            try{
		                resp = JSON.parse( this.responseText );
		                if( resp['status'] == "success" ){
		                	
		                    load_friends();
		                }else{
		                    alert("Save error " + resp['error']);
		                }
		            }catch(e){
		                alert("Response parse failed! " + e);
		            }
		        }else{
		            alert("Something wrong: " + this.status );
		        }
		    }
		}
		con.send(vpostdata);
		}

        
       


</script>