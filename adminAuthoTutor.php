<?php
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
<?php
include("adminCheck.php");
?>
	<h2>Authorise Tutors</h2>
	<p>This page allows you to authorise tutors(s).</p>
	<?php
	if(!isset($_POST['studentID']))
	{
		if (!isset($_POST['courseID']))
		{
			getUnauthorisedTutors(); 
		}
	}
	else
	{
		enrolTutors();
	}
	?>
</div>
 <?php
 	include("RightNav.php");
 	include("footer.php");

function getUnauthorisedTutors()
{
	$userID = $_SESSION['userID'];
	$sql = "SELECT * FROM user WHERE authorised = 0";
	if ($resource = doSQL($sql))
	{
		showTutors($resource);
	}
}

function getTutorDetails($resource)
{
	$sql = "SELECT userID, userForename, userSurname FROM user WHERE ";
 	while ($currentLine = mysqli_fetch_array($resource))
 	{
 		$sql .= "authorised = 0";
 	}
 	$sql = rtrim($sql, " OR ");
 	if ($resource = doSQL($sql))
 	{
 		showTutors($resource);
 	}
}
function showTutors($resource)
{
 	echo("<form name='showTutors' method='post' action='adminAuthoTutor.php'>");
 	echo("<input type='hidden' name='authorised' value='authorised' />");
 	while ($currentLine = mysqli_fetch_array($resource))
 	{
 		echo("<input type='checkbox' name='studentID[]' value='$currentLine[userID]' />");
 		echo($currentLine['userForename'] . ' ' . $currentLine['userSurname'] . '<br />');
 	}
 	echo("<br /><input type='submit' onclick='submit' />
 		</form>");
}
function enrolTutors()
{
 	foreach ($_POST['studentID'] as $userID)
 	{
 		$sql = "UPDATE user SET authorised = 1";
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