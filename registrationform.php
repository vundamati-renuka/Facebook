<?php
 include("action.php");
 $states=[];
 $res1=mysqli_query($con,"select id,state from states order by state");
	while($state = mysqli_fetch_assoc($res1)){
		$states[$state['id']]=$state;
	}
$cities=[];
$res2=mysqli_query($con,"select id,state_id,city from cities order by city");
	while($city= mysqli_fetch_assoc($res2)){
		$cities[$city['id']]=$city;
	}



require("header.php");

	if( $_GET['event'] == "success" ){



	}else{

	?>

	<form name="form1" method="post" onsubmit="return validate_form()">
	<table >
			<tr>
				<td>
				<h3>Registration Form</h3>
				</td>
			</tr><br>
			<tr>
				<td>Name :</td>
				<td><input type="text" name="name" placeholder="Enter the name" class="form-control form-control-sm" id="name" required></td>
			</tr>
			<tr>
				<td>Gender :</td>
				<td>
					<label><input type="radio" name="gender" value="male"  id="gender_male">  Male </label>
				<label><input type="radio" name="gender" value="female"  id="gender_female">  Female </label>
				</td>
			</tr>
			
			<tr>
				<td>Date Of Birth:</td>
				<td><input type="date" name="dob" id="dob" required class="form-control form-control-sm"></td>
			</tr>

			<tr>
				<td>State:</td>
				<td>
				<select class="form-select" id="state_dropdown" onchange="state_selected(this.value)" name="state_dropdown" class="form-control form-control-sm"></select>
				</td>
			</tr>
			<tr>
			<td>City:</td>
			<td><select class="form-select" id="city_dropdown" class="form-control form-control-sm" name="city_dropdown" required></select>
			</td>
			</tr>
			<tr>
			<td>Pincode:</td>
			<td><input type="text" id="pincode" placeholder="Enter the pincode" class="form-control form-control-sm" name="pincode" required></td>
			</tr>
			<tr>
			<td><label>Email:</label><span id="user_email"></span></td>
			<td><input type="text" id="email" class="form-control form-control-sm" placeholder="Enter the email" name="email" onchange="email_check()" required></td>
			</tr>
			<tr>
			<td>Mobile:</td>
			<td><input type="number" id="mobile" placeholder="Enter the mobilenumber" class="form-control form-control-sm" name="mobile" required></td>
			</tr>
			<tr>
				
				 <td><label>username:</td>
				<td><input type="text" id="username" class="form-control form-control-sm" placeholder="Enter the username" name="username" onchange="username_check()" required></td>
				
				<td></label><span id="user_msg"></span></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" id="password" placeholder="Enter the password" class="form-control form-control-sm" name="password" required></td>
			</tr>
			<tr>
				<td>Confirm Password:</td>
				<td><input type="password" id="confirm_password" placeholder="Enter the password" name="password" class="form-control form-control-sm" required></td>
			</tr>
			<tr>
				<td>Profile Pic:</td>
				<td><input type="file" name="file" >
				<input type="submit" value="Upload" name="action" onclick="start_upload()"></td>
			</tr>

			<tr align="center">
				<td><input type="submit" name="btn" value="register" class="btn btn-primary"></td>
			</tr>
	</table>
	 <input type="hidden" name="action" value="register" >
</form>

<script>
	
		

			var states_list= <?=json_encode($states)?>;
			var cities_list= <?=json_encode($cities)?>;
			function generate_state_list(){
			var t = "";
			for(var state_id in states_list){
			t = t + "<option value='" + state_id + "' >" + states_list[state_id]['state'] + "</option>";
			}
			document.getElementById("state_dropdown").innerHTML = t;
			}
			function state_selected(state_id){
			var t = "";
			for(var city_id in cities_list ){
			if( cities_list[ city_id ]['state_id'] == state_id ){
			t = t + "<option value='" + city_id + "' >" + cities_list[city_id]['city'] + "</option>";
			}
			}
			document.getElementById("city_dropdown").innerHTML = t;
			}
			generate_state_list();

     
			var t= "";
			function username_check(){
			document.getElementById("user_msg").innerHTML = "Validting...";
			document.getElementById("user_msg").style.color ="black";
			var t = document.getElementById("username").value;
			var con = new XMLHttpRequest();
			con.open("GET", "registerationform.php?action=check_username&username=" + t, true);
			con.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				try{
				resp = JSON.parse( this.responseText );
				if( resp['status'] == "success" ){
					document.getElementById("user_msg").innerHTML="Available";
					document.getElementById("user_msg").style.color ="blue";

			}else{
				document.getElementById("user_msg").innerHTML="User Exists";
				document.getElementById("user_msg").style.color ="red";
				document.getElementById("username").value="";
			}
			}catch(e){
				alert("Response parse failed! " + e);
				document.getElementById("user_msg").innerHTML = "Error validating...";
				document.getElementById("user_msg").style.color ="red";
			}
			}
			}    
			con.send();                    
			} 


			var m= "";
			function email_check(){
			document.getElementById("user_email").innerHTML = "Validting...";
			document.getElementById("user_email").style.color ="black";
			var m = document.getElementById("email").value;
			var con = new XMLHttpRequest();
			con.open("GET", "registrationform.php?action=check_email&email=" + m, true);
			con.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				try{
					resp = JSON.parse( this.responseText );
					if( resp['status'] == "success" ){
					document.getElementById("user_email").innerHTML="Available";
					document.getElementById("user_email").style.color ="blue";

			}else{
					document.getElementById("user_email").innerHTML="Email Exists";
					document.getElementById("user_email").style.color ="red";
					document.getElementById("email").value="";
			}
			}catch(e){
					alert("Response parse failed! " + e);
					document.getElementById("user_email").innerHTML = "Error validating...";
					document.getElementById("user_email").style.color ="red";
			}
			}
			}    
			con.send();                    
			} 
            
			function validate_form(){

			var frm = document.form1;
			if( frm.name.value.match(/^[a-z\ ]+$/i) == null ){
			alert("need name");return false;
			}
			if( frm.gender.value.match(/^(male|female)$/i) == null ){
			alert("need gender");return false;
			}

		}


		    function upload_file(){
			f = document.getElementById("file").files[0];
			console.log( f );

			var formdata = new FormData();
			formdata.append("action", "upload2");
			formdata.append("file", f, f.name);
			console.log( formdata );

			var con = new XMLHttpRequest();
			con.open("POST", "action.php", true);
			con.setRequestHeader("Content-Type", "multipart/form-data");
			con.onreadystatechange = function(){

			}
			con.send(formdata);

		}




</script>

<?php } ?>