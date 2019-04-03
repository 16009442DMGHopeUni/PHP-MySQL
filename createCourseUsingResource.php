<?php
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
<?php
$conn = mysqli_connect("localhost","root","root","aceTraining"); 


$sql = ("
CREATE TABLE courseUsingResource (
resourceID	INT NOT NULL, 
courseID	INT NOT NULL,
FOREIGN KEY (resourceID) REFERENCES resource(resourceID),
FOREIGN KEY (courseID) REFERENCES course(courseID)
)");



echo ("<p>SQL QUERY: <pre>" . $sql . "</pre></p>");
if (mysqli_query($conn, $sql))
	{
		echo ("<p style='color:green'>SUCCESS</p>");
	}
else
	{
		echo ("<p style= 'color:red'>FAIL: ");
		echo(mysqli_error($conn) . "</p>");
	}
?>
</div>
 <?php
 	include("RightNav.php");
 	include("footer.php");
 ?>