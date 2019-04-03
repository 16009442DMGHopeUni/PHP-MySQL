<?php
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
<?php
include ("studentCheck.php");
if (isset($_POST['course']))
	{
		addEnrolmentToDatabase();
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
 	$conn = mysqli_connect('localhost','root','root','aceTraining');
 	$sql = "SELECT courseID, courseName FROM course";
 	echo("<p>SQL QUERY: <pre>" . $sql . "</pre></p>");
	if ($resource = mysqli_query($conn,$sql))
		{
			echo("<p style = 'color:green'>SUCCESS</p>");
		}
	else
		{
			echo ("<p style = 'color:red'>FAIL: ");
			echo (mysqli_error($conn) . "</p>");
		}
 	echo("
 	<form name = 'enrol' method = 'post' action = 'studentEnrolCourse.php'>");
 	while ($currentCourse = mysqli_fetch_array($resource))
 	{
 		echo("<input type= 'checkbox' name ='course[]' value='$currentCourse[courseID]' /> $currentCourse[courseName] <br />");
 	}
  	echo("<input type = 'submit' onclick = 'submit' value = 'Enrol onto course' />
	</form>
	");
}
function addEnrolmentToDatabase()
{
 	$course = $_POST['course'];
 	$userID = $_SESSION['userID'];
 	$today = date("Ymd");

	$conn = mysqli_connect('localhost','root','root','aceTraining');
	foreach ($course as $currentCourse)
		{
		$sql = "INSERT INTO studentTaking (courseID, userID, dateRegistered, authorised)
				VALUES ('$currentCourse', '$userID', '$today', 0)";
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
}
?>