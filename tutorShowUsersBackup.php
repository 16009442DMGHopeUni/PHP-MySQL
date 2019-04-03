<?php
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
<?php
$conn = mysqli_connect("localhost", "root", "root", "aceTraining");
$sql = "SELECT * FROM user";
echo ("<p>SQL QUERY: <pre>" . $sql . "</pre></p>");
	if ($resource = mysqli_query($conn,$sql))
		{
			echo("<p style = 'color:green'>SUCCESS</p>");
			display($resource);
		}
	else
		{
			echo ("<p style = 'color:red'>FAIL: ");
			echo (mysqli_error($conn) . "</p>");
		}

function display($resource)
{
	while ($currentLine = mysqli_fetch_array($resource))
	{
		echo ($currentLine['userID'] . "<br />");
		echo ($currentLine['userForename'] . "<br />");
		echo ($currentLine['userSurname'] . "<br />");
		echo ($currentLine['userEmail'] . "<br />");
	}
}
?>
</div>
 <?php
 	include("RightNav.php");
 	include("footer.php");
 ?>