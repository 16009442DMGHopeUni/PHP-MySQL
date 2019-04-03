<?php
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
<?php
$conn = mysqli_connect("localhost","root","root","aceTraining"); 
$sql = ("
CREATE TABLE course (
courseID	INT NOT NULL AUTO_INCREMENT,
courseName	VARCHAR(50) NOT NULL,
creditValue VARCHAR(50) NOT NULL,
courseOwner	INT NOT NULL,
PRIMARY KEY (courseID),
FOREIGN KEY (courseOwner) REFERENCES user(userID)
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