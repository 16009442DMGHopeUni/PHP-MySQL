<?php
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
<?php
include("tutorCheck.php");
?>
	<h2>Authorise Students</h2>
	<p>This page allows you to authorise student(s) onto your course(s).</p>
	<?php
	if(!isset($_POST['studentID']))
	{
		if (!isset($_POST['courseID']))
		{
			getCourses(); 
		}
		else
		{
			getStudentTakingCourse();
		}
	}
	else
	{
		enrolStudent();
	}
	?>
</div>
 <?php
 	include("RightNav.php");
 	include("footer.php");
 function getCourses()
 {
 	$userID = $_SESSION['userID'];
 	$sql = "SELECT courseID, courseName FROM course WHERE courseOwner = $userID";
 	if ($resource = doSQL($sql))
 	{
 		showCourses($resource);
 	}
 }
 function showCourses($resource)
 {
 	echo("Select a course that you wish to enrol a student onto: <br><form name='showCourses' method='post' action='tutorAuthoriseStud.php'>
 		<select name='courseID' required autofocus>");
 	while($currentLine = mysqli_fetch_array($resource))
 	{
 		echo("<option value='$currentLine[courseID]'>$currentLine[courseName]</option>");
 	}
 	echo("</select>
 		<input type='submit' onclick='submit' />
 		</form>");
 }
 function getStudentTakingCourse()
 {
 	$courseID = $_POST['courseID'];
 	$sql = "SELECT userID FROM studentTaking WHERE courseID = $courseID AND authorised = 0";
 	if($resource = doSQL($sql))
 	{
 		getStudentDetails($resource);
 	}
 }
 function getStudentDetails($resource)
 {
 	$sql = "SELECT userID, userForename, userSurname FROM user WHERE ";
 	while ($currentLine = mysqli_fetch_array($resource))
 	{
 		$sql .= "userID = '$currentLine[userID]' OR ";
 	}
 	$sql = rtrim($sql, " OR ");
 	if ($resource = doSQL($sql))
 	{
 		showStudents($resource);
 	}
 }
 function showStudents($resource)
 {
 	$courseID = $_POST['courseID'];
 	echo("<form name='showStudents' method='post' action='tutorAuthoStud.php'>");
 	echo("<input type='hidden' name='courseID' value='$courseID' />");
 	while ($currentLine = mysqli_fetch_array($resource))
 	{
 		echo("<input type='checkbox' name='studentID[]' value='$currentLine[userID]' />");
 		echo($currentLine['userForename'] . ' ' . $currentLine['userSurname'] . '<br />');
 	}
 	echo("<br /><input type='submit' onclick='submit' />
 		</form>");
 }
 function enrolStudent()
 {
 	$courseID = $_POST['courseID'];
 	foreach ($_POST['studentID'] as $userID)
 	{
 		$sql = "UPDATE studentTaking SET authorised = 1 WHERE
 		userID = $userID AND courseID = $courseID";
 		doSQL($sql);
 	}
 }
 function doSQL($sql)
 {
 	echo("<p>SQL QUERY: <pre>" . $sql . "</pre></p>");
 	$conn = mysqli_connect("localhost", "root", "root", "aceTraining");
 	if ($resource = mysqli_query($conn, $sql))
 	{
 		echo("<p style='color:green'>SUCCESS</p>");
 		return $resource;
 	}
 	else
 	{
 		echo("<p style='color:red'>FAIL: </p>");
 		echo(mysqli_error($conn) . "</p>");
 		return false;
 	}
 }
 ?>