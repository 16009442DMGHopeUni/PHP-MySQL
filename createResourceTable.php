<?php
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
<?php
$conn = mysqli_connect("localhost","root","root","aceTraining"); 
$sql = ("
CREATE TABLE resource (
resourceId	INT	AUTO_INCREMENT,
name		VARCHAR(50),	
dateFrom	DATE,
dateUntil	DATE,
ownerId		INT,
filename	VARCHAR(100),
FOREIGN KEY (ownerId) REFERENCES user(userID)
ON UPDATE CASCADE ON DELETE RESTRICT,
PRIMARY KEY(resourceId)
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