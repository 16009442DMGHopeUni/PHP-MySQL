<?php
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
<?php
	include("tutorCheck.php");
?>
<?php
if (!isset($_POST['name']))
   {
   showResourceForm();
   }
else
   {
   doResource();
   }
?>
</div>
<?php
function showResourceForm()
{
	echo ("
 	<form name='form1' method='post' action='tutorUploadRes.php' enctype='multipart/form-data' />
 	<table>
 	<tr><td>Name of Resource</td><td><input type='text' name='name' /></td></tr>
 	<tr><td>Available From</td><td><input type='date' name='from' /></td></tr>
	<tr><td>Available Until</td><td><input type='date' name='until' /></td></tr>
	<tr><td>Choose Resource</td><td><input type='file' name='file' id='file'> </td></tr> 
	</table>
	<input type='submit' onclick='submit' value='Upload Resource' />
	</form>   ");

}
function doResource()
{
	if ($_FILES["file"]["error"] > 0)
     {
     echo "Error: " . $_FILES["file"]["error"] . "<br />";
     }
   else
     {
	  move_uploaded_file($_FILES["file"]["tmp_name"],
      "uploads/" . $_FILES["file"]["name"]);
      echo "Uploaded To: " . "uploads/" . $_FILES["file"]["name"];
     }

    $conn = mysqli_connect ("localhost","root","root","aceTraining");
	$name = $_POST['name'];
	$from = $_POST['from'];
	$until = $_POST['until'];
	$file = $_FILES["file"]["name"];
	$ow = $_SESSION['userID'];
	
	$sql = "INSERT INTO RESOURCE (name, dateFrom, dateUntil, ownerId, filename ) VALUES ('$name', '$from', '$until', '$ow', '$file')";

	mysqli_query ($conn,$sql) or die (mysqli_error($conn));
}
?>
<?php
	include("RightNav.php");
 	include("footer.php");
?>