<?php
require("config.php");

require("password_action.php");

if( $_GET['show']=="step2" && !$_SESSION['forgot_step2_record']){
	header("Location: password.php");
	exit;
}

require("header.php");
if($_GET['show']=='thankyou'){
?>

<div class="alert alert-success" > 
	<h3>Password changed successfully!</h3>
	<p><a href="login.php" class="btn btn-link" >Click here to Login</a></p>
</div>

<?php
}else if($_GET['show']=='step2'){
?>
<div class="row">
	<div class="col"></div>
	<div class="col" style="width:400px;" >
		<div class="card text-white bg-primary" style="width:400px;" >
			<div class="card-header" >
				Create Password for <?=$_SESSION['forgot_step2_record']['username'] ?>
			</div>
			<div class="card-body bg-white" >


				<?php if( $_GET['event']=='error' ){ ?>
					<div class="alert alert-danger" ><?=htmlspecialchars($_SESSION['forgot_step2_error']) ?></div>
				<?php } ?>


				<form method="post" >
				<table>
					<tr>
						<td>Enter New Password*</td>
						<td><input type="password" class="form-control form-control-sm" name="password1"></td>
					</tr>
					<tr>
						<td>Re Enter Password*</td>
						<td><input type="password" class="form-control form-control-sm" name="password2"></td>
					</tr>
					<tr>
						<td></td>
						<td><input class="btn btn-primary" type="submit" name="submit" value="Submit">
							<input type="hidden" name="action" value="resetpw">
						</td>
					</tr>
					
				</table>

				</form>
				
				
			</div>
		</div>
	</div>
	<div class="col"></div>
</div>
<?php
}
else{
?>
<div class="row">
	<div class="col"></div>
	<div class="col" style="width:400px;" >
		<div class="card text-white bg-primary" style="width:400px;" >
			<div class="card-header" >
				Forgot Password
			</div>
			<div class="card-body bg-white" >

				<?php if( $_GET['event']=='error' ){ ?>
					<div class="alert alert-danger" ><?=htmlspecialchars($_SESSION['forgot_error']) ?></div>
				<?php } ?>

				<form method="post" >
				<table>
					<tr>
						<td>Username</td>
						<td><input type="text" class="form-control form-control-sm" name="username" value="<?=$_SESSION['username'] ?>"></td>
					</tr>
					<tr>
						<td>DOB</td>
						<td><input type="date" class="form-control form-control-sm" name="date"></td>
					</tr>
					
					<tr>
						<td></td>
						<td>
							<input class="btn btn-primary" type="submit" name="submit" value="Search">
							<input type="hidden" name="action" value="search">
						</td>
					</tr>
					
				</table>
				

				</form>
				
				
			</div>
		</div>
	</div>
	<div class="col"></div>
</div>
<?php
	}
?>