<?php
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
<?php
$conn = mysqli_connect("localhost","root","root","aceTraining"); 
$sql = ("
CREATE TABLE studentTaking (
courseID		INT NOT NULL,
userID			INT NOT NULL,
dateRegistered	DATE NOT NULL,
authorised		BOOLEAN,
FOREIGN KEY (courseID) REFERENCES course(courseID)
ON UPDATE CASCADE ON DELETE RESTRICT,
FOREIGN KEY (userID) REFERENCES user(userID)
ON UPDATE CASCADE ON DELETE RESTRICT
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