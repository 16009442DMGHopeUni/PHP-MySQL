<?php
session_start();
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
<?php
	showForm();
?>
</div>
<?php
 	include("RightNav.php");
 	include("footer.php");


function showForm()
{

 	echo("
	<form name='frmChange' role='form' class='form-signin' method='POST' action='changepword_script.php'>

	<label for='InputPassword2'>New Password</label>
	<input type='password' id='InputPassword2' placeholder='New Password' name='newPassword'><br>
	<label for='InputPassword3'>Confirm New Password</label>
	<input type='password' id='InputPassword3' placeholder='Confirm Password' name='confirmPassword'><br>  
	<button type='submit' value='send'>Change it</button>

	</form>
	");
}
?>