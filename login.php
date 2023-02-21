<?php
require("config.php");

require("login_action.php");

require("header.php");

?>
<div class="row">
	<div class="col"></div>
	<div class="col" style="width:400px;" >
		<div class="card text-white bg-primary" style="width:400px;" >
			<div class="card-header" >
				Login
			</div>
			<div class="card-body bg-white" >
				<form method="post" >
				<table>
					<tr>
						<td>Username</td>
						<td><input type="text" class="form-control form-control-sm" id="username" ></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" class="form-control form-control-sm" id="password" ></td>
					</tr>
					<tr>
						<td></td>
						<td><img id="captcha_image" src="captcha.php" > <input type="button" value="r" onclick="refresh_captcha()"></td>
					</tr>
					<tr>
						<td>Code</td>
						<td><input type="text" class="form-control form-control-sm" id="code" ></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="button" class="btn btn-primary btn-sm" name="btn" value="Login" onclick="do_login()" ></td>
					</tr>
					<tr>
						<td><a href="password.php">Forgot Password</a></td>
					</tr>
				</table>
				<input type="hidden" name="action" value="login" >

				</form>
				<div id="error_msg" style="color:red;" ></div>
				<script>
					function do_login(){
						document.getElementById("error_msg").innerHTML = "Connecting...";
						var u = document.getElementById("username").value;
						var p = document.getElementById("password").value;
						var code = document.getElementById("code").value;
						var c = new XMLHttpRequest();
						c.open( "POST","?",true);
						c.setRequestHeader("content-type", "application/x-www-form-urlencoded");
						c.onreadystatechange = function(){
							refresh_captcha();
							if( this.readyState == 4 && this.status == 200 ){
								if( this.responseText != "" ){
									try{
										var resp = JSON.parse( this.responseText );
										if( "status" in resp ){
											if( resp['status'] == "success" ){
												document.location = "home?event=LoginSuccess";
											}else{
												document.getElementById("error_msg").innerHTML = resp['error'];
											}
										}else{
											document.getElementById("error_msg").innerHTML = "Incorrect response";
										}
									}catch(e){
										document.getElementById("error_msg").innerHTML = "Response JSON Parse Error";
									}
								}else{
									document.getElementById("error_msg").innerHTML = "Empty Response";
								}
							}else if( this.readyState == 4 ){
								document.getElementById("error_msg").innerHTML = "Server Error:" + this.status;
							}
						}
						c.send("action=login&username="+encodeURIComponent(u)+"&password="+encodeURIComponent(p)+"&code="+encodeURIComponent(code));
					}
					function refresh_captcha(){
						var dt = new Date();
						document.getElementById("captcha_image").src = "captcha.php?random="+dt.getTime();
					}
				</script>
			</div>
		</div>
	</div>
	<div class="col"></div>
</div>