<?php
include_once "functions.php";
?>
<script>
function validate_password_reset() {
	if((document.getElementById("password").value == "") && (document.getElementById("Confirm Password").value == "")) {
		document.getElementById("validation-message").innerHTML = "Please enter new password!"
		return false;
	}
	return true
}
</script>
 <!DOCTYPE html>
 <html>
 <head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title>payMe</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" type="text/css" media="screen" href="assets/main.css">
 <link rel="stylesheet" type="text/css" media="screen" href="assets/responsive.css">
 <script src="assets/main.js"></script>
 </head>
 <body>
     <header>
        <h1><span>Pay</span>Me</h1>
		</header>
		<div class='container'>
<form name="frmForgot" id="frmForgot" method="post" onSubmit="return validate_password_reset();">
<div class="header">
	<h2 style='padding-left:10%; padding-top:1%;'>Reset password</h2><br><br>
</div>
<div class='main'>
	<?php if(!empty($success_message)) { ?>
	<div class="success_message"><?php echo $success_message; ?></div>
	<?php } ?>

	<div id="validation-message">
		<?php if(!empty($error_message)) { ?>
	<?php echo $error_message; ?>
	<?php } ?>
	</div>

	<div class="input-group">
		<div><label for="Password">Password</label></div>
		<div><input type="password" name="password" id="member_password" class="input-field"> Or</div>
	</div>
	
	<div class="input-group">
		<div><label for="email">Confirm Password</label></div>
		<div><input type="password" name="confirm_password" id="confirm_password" class="input-field"></div>
	</div>
	
	<div class="input-group">
		<div><input type="submit" name="reset-password" id="reset-password" value="Submit" class="form-submit-button"></div>
	</div>	
	</div>
</form>
</div>
</body>
</html>
				