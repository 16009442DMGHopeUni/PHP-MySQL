<?php
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
<?php
if (!isset($_POST['courseID']))
   {
	if (!isset($_POST['resourceId']))
	  {  
	  showResources();
	  }
	else
	  {
	  showCourses();
	  }
	}
else
   {
	doResourceForCourse();
   }
?>
</div>
<?php

function showResources()
{
	$conn = mysqli_connect("localhost","root","root","aceTraining");
	$sql = "SELECT * from resource WHERE ownerId = '$_SESSION[userID]'"; 
	$result = mysqli_query($conn,$sql);  

	echo ("<form id='form1' name='form1' method='post' 
	       action='useResource.php'><select name='resourceId' >");

	while ($record = mysqli_fetch_array($result))
   	{  
   	echo ("<option value='$record[resourceId]'>" . $record['name'] . "</option>");
	}

	echo ("</select> 
	<input type='submit' name='button' id='button' value='Submit' />
	</form>");
}

function showCourses()
{
	$conn = mysqli_connect("localhost","root","root","aceTraining");
	$sql = "SELECT * FROM course";
	$result = mysqli_query($conn,$sql);
	$courses = "";

	while ($record = mysqli_fetch_array($result))
	   {
	   $courses .= "<br /><input type='checkbox' name='courseID[]' 
	                value='$record[courseID]'  />" . $record['courseName'];
	   }

	echo ("Please select the courses you wish to allow the resource to be used");
	echo ("<form name='form1' method='post' action='useResource.php' >"); 
	echo ("<input type='hidden' value='$_POST[resourceId]' name='resourceId' />");
	echo ($courses);
	echo ("<br /><input type='submit' name='button' id='button' value='Submit' />");   
	echo ("</form>");
}

function doResourceForCourse()
{
	$conn = mysqli_connect("localhost","root","root","aceTraining");
	$rId = $_POST['resourceId'];
	foreach ($_POST['courseID'] as $cId)
	   {
	   $sql = "INSERT INTO courseUsingResource (resourceId, courseID) VALUES ('$rId','$cId')";  
	   if (mysqli_query($conn,$sql))
	      {
	      echo ("You have shared the resource with course id " . $cId);
	      }
	   }
}

?>

<?php
	include("RightNav.php");
 	include("footer.php");
?>