<?php
session_start();
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
	<?php
	if (!isset($_POST['email']))
	{
		showLogin();
	}
	else
	{
		doLogin();
   	}

	
	?>
</div>
<?php
 	include("RightNav.php");
 	include("footer.php");
 	function showLogin()
 	{
 		echo("
	 		<form name = 'login' method = 'post' action = 'login.php' >
	 		Email: <input type = 'text' name = 'email'/> <br />
	 		Password: <input type = 'password' name = 'password'/> <br />
	 		<input type = 'submit' onclick = 'submit' value = 'Login'/>
	 		</form>
	 		");
 	}

function doLogin()
{
 	$em = $_POST['email'];
 	$pw = $_POST['password'];
 	$conn = mysqli_connect("localhost", "root", "root", "aceTraining");
 	$sql = "SELECT * FROM user WHERE (userEmail = '$em' AND userPassword = '$pw')";
 	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
 	$record = mysqli_fetch_array($result);

 	if ($record['userID'] == "")
 	{
 		echo("login failed...");
 	}
 	else
 	{
 		echo("<p style = 'color:green'>Successfully logged in. </p>");
 		if ($record['authorised'] == 0)
 		{
 			echo ("<p style = 'color:red'>You are not authorised, check back in the next 24 hours.</p>");	
 		}
 		else 
 		{
 			$_SESSION['userID'] = $record['userID'];
 			$_SESSION['userType'] = $record['userType'];
 			showLinkToUserPage();
 		}
	}
}

function checkLogin($resource)
{
 	if (mysqli_num_rows($resource) == 1)
 		{
 			$row = mysqli_fetch_array($resource);
 			$_SESSION['userType'] = $row['userType'];
 			$_SESSION['userID'] = $row['userID'];
 			echo ("<p style = 'color:green'>LOGIN SUCCESS</p>");
 		}
 		else
 		{
 			echo ("<p style = 'color:red'>LOGIN FAIL: ");
 		}
}

function showLinkToUserPage()
{
	if($_SESSION['userType'] == "tutor")
	{
		echo ("<a href='tutorHome.php'><br><br>Click here for tutor home page</a>");
	}
	else if($_SESSION['userType'] == "student")
	{
		echo ("<a href='studentHome.php'><br><br>Click here for student home page</a>");
	}
	else if($_SESSION['userType'] == "administrator")
	{
		echo ("<a href='administratorHome.php'><br><br>Click here for administrator home page</a>");
	}
	else
	{
		echo ("<a href='login.php'>Something went wrong... Retry Login</a>");
	}
}
?>