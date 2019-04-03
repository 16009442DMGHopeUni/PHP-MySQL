<?php
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
<?php
if (isset($_POST['forename']))
	{
		addUserToDatabase();
	}
else
	{
		showForm();
	}
?>
</div>
<?php
 	include("RightNav.php");
 	include("footer.php");

function showForm()
{
 	echo("
 	<form name = 'register' method = 'post' action = 'register.php'>
 	Forename <input type = 'text' name = 'forename' /> <br/>
 	Surname <input type = 'text' name = 'surname' /> <br/>
 	Email Address <input type = 'text' name = 'email' /> <br/>
  	Password <input type = 'text' name = 'password' /> <br/>
  	Confirm Password <input type = 'text' name = 'cpassword' /> <br/>
  	Tutor / Student <select name = 'type' />
  		<option value = 'tutor'>Tutor</option>
  		<option value = 'student'>Student</option>
  		</select>
  		<input type = 'submit' onclick = 'submit' />
</form>
");
}

function testDuplicateEmail()
{	
	if (isset($_POST['email']))
	{
		$em = $_POST['email'];
		$sql = mysqli_query("SELECT userEmail FROM user WHERE userEmail = '$em'");
		$conn = mysqli_connect('localhost','root','root','aceTraining');

		if (mysqli_num_rows($sql) > 0) 
		{
			echo ("Email address already in use!");
		}
		else
		{
			addUserToDatabase();
		}

	}
}

function addUserToDatabase()
{
 	$fn = $_POST['forename'];
	$sn = $_POST['surname'];
	$em = $_POST['email'];
	$pw = $_POST['password'];
	$ut = $_POST['type'];

	$conn = mysqli_connect('localhost','root','root','aceTraining');
	if ($ut == 'student')
	{
		$sql = ("INSERT INTO user (userforename, usersurname, useremail, userpassword, userType, authorised)
				VALUES ('$fn', '$sn', '$em', '$pw', '$ut', 1)");
	}
		else
	{
		$sql = ("INSERT INTO user (userforename, usersurname, useremail, userpassword, userType, authorised) 
				VALUES ('$fn', '$sn', '$em', '$pw', '$ut', 0)");
	}

	echo("<p>SQL QUERY: <pre>" . $sql . "</pre></p>");
	if (mysqli_query($conn,$sql))
		{
			echo("<p style = 'color:green'>SUCCESS</p>");
		}
	else
		{
			echo ("<p style = 'color:red'>FAIL: ");
			echo (mysqli_error($conn) . "</p>");
		}
}
?>