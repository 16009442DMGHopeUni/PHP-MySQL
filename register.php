<?php
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
<?php
if (isset($_POST['forename']))
	{
		if (!empty($_POST['forename'] && $_POST['surname'] && $_POST['email'] && $_POST['password'] && $_POST['cpassword'] && $_POST['type']))
			{
				addUserToDatabase();
			}
		else
			{
				showForm();
				echo("<br><br><br><p style = 'color:red'>Fill in all of the registration page!</p>");
			}
	}
else
	{
		showForm();
		echo("<script type = 'text/javascript'> validateForm(); </script>");
	}
?>
</div>
<?php
 	include("RightNav.php");
 	include("footer.php");
?>
<script type="text/javascript">
	
function validateForm()
{

	var firstName=document.forms["theForm"]["forename"].value;
	var secondName=document.forms["theForm"]["surname"].value;
	var x=document.forms["theForm"]["email"].value;
	var password=document.forms["theForm"]["password"].value;
	var cpassword=document.forms["theForm"]["cpassword"].value;
	
	var numberExpression = /^[0-9]+$/;
	var letterExpression = /^[a-zA-Z]+$/;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");

	if (firstName=="")
		{
		alert("First name must be filled out");
		return false;
		}

	else if (!firstName.match(letterExpression))
		{
		alert("Letters Only Please");
		return false;
		}

	else if (firstName.length <= 2)
	{
		alert("First name must more than 2 characters long");
		return false;
	}

	else if (secondName=="")
		{
		alert("Second name must be filled out");
		return false;
		}

	else if (!secondName.match(letterExpression))
			{
			alert("Letters Only Please");
			return false;
			}

	else if (secondName.length <= 2)
		{
			alert("Surname name must more than 2 characters long");
			return false;
		}
	else if ((atpos<1) || (dotpos<atpos+2) || (dotpos+2>=x.length))
		{
			alert ("Not a valid e-mail address");
			return false;
		}

	else if (password == "")
		{
			alert("Please Enter a Password");
			return false;
		}

	else if (cpassword !== password)
		{
			alert("Passwords do not match");
			return false;
		}
		else
		{
			return true;
		}
}
</script>


<?php
function showForm()
{
 	echo("
<form name='theForm' method='post' action='register.php' onsubmit='return validateForm()''>
<input type='text' name='forename' placeholder='First Name'><br>
<input type='text' name='surname' placeholder='Surname'><br/>
<input type='text' name='email' placeholder='Email'><br>
<input type='password' name='password' placeholder='password'><br>
<input type='password' name='cpassword' placeholder='confirm password'>


<br>
<select name='type'>
<option value='student'>student</option>
<option value='tutor'>tutor</option>
</select>
<input type = 'submit' value = 'Submit Form'>
</form>
");
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
