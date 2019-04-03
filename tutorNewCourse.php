<?php
session_start();
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
<?php
include ("tutorCheck.php");
if (isset($_POST['courseName']))
	{
		addCourseToDatabase();
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
 	<form name = 'Add Course' method = 'post' action = 'tutorNewCourse.php'>
 	Course Name <input type = 'text' name = 'courseName' /><br />
 	Credit Value <input type = 'text' name = 'creditValue' /><br />
  				<input type = 'submit' onclick = 'submit' value = 'Add Course' />
	</form>
	");
 }
 function addCourseToDatabase()
 {
	$cn = $_POST['courseName'];
	$ow = $_SESSION['userID'];
	$cv = $_POST['creditValue'];

	$conn = mysqli_connect('localhost','root','root','aceTraining');
	$sql = "INSERT INTO course (courseName, creditValue, courseOwner) VALUES ('$cn', '$cv', '$ow')";
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