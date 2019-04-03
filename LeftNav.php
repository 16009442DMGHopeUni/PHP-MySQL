<?php
if(session_status() === PHP_SESSION_NONE)
{
	session_start();
}
?>
<div class="row">
	<div class="col c2 alignleft">
		<ul class="menu">
		<li><a href="register.php">Register</a></li> 	
		<?php logInOut(); 
			selectMenu(); ?>
	</div>
<?php
function logInOut()
{
	if(!isset($_SESSION['userType']))
	{
		echo ("<li><a href='login.php'>Login</a></li>");
	}
	else
	{
		echo ("<li><a href='logout.php'>Logout</a></li>");
	}
}
function tutorMenu()
{
	echo("
	<li><a href='tutorAuthoStud.php'>Authorise Student</a></li>
	<li><a href='tutorAddStud.php'>Add Student</a></li>
	<li><a href='tutorShowUsers.php'>Show Users</a></li>
	<li><a href='tutorNewCourse.php'>Add New Course</a></li>
	<li><a href='tutorUploadRes.php'>Upload A Resource</a></li>
	<li><a href='useResource.php'>View Resources</a></li>
	<li><a href='userChangePassword.php'>Change Password</a></li>
	
	");
}
function studentMenu()
{
	echo("
	<li><a href='studentEnrolCourse.php'>Enrol on Course</a></li>
	<li><a href='showResource.php'>Show Resources</a></li>
	<li><a href='userChangePassword.php'>Change Password</a></li>
	<li><a href='displayQuiz.php'>Start Quiz</a></li>
	");	
}
function adminMenu()
{
	echo("
	<li><a href='tutorShowUsers.php'>Show Users</a></li>
	<li><a href='tutorNewCourse.php'>Add New Course</a></li>
	<li><a href='tutorUploadRes.php'>Upload A Resource</a></li>
	<li><a href='adminAuthoTutor.php'>Authorise Tutor</a></li>
	<li><a href='tutorAddStud.php'>Add Student</a></li>
	<li><a href='userChangePassword.php'>Change Password</a></li>	
	");
}

function selectMenu()
{
	if (isset($_SESSION['userType']))
	{
		if($_SESSION['userType'] == "tutor")
		{
			tutorMenu();
		}
		if($_SESSION['userType'] == "student")
		{
			studentMenu();
		}
		if($_SESSION['userType'] == "administrator")
		{
			adminMenu();
		}
	}
}
?>