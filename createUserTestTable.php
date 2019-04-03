<?php
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
<?php
$conn = mysqli_connect("localhost","root","root","aceTraining"); 
$sql = ("
CREATE TABLE userTest (
userID       INT NOT NULL AUTO_INCREMENT,
userForename VARCHAR(50) NOT NULL,
userSurname  VARCHAR(50) NOT NULL,
userEmail    VARCHAR(50) NOT NULL UNIQUE,
userPassword VARCHAR(50) NOT NULL,
userType 	 VARCHAR(15) NOT NULL,
authorised   BOOLEAN NOT NULL,
PRIMARY KEY (userID)
)
");
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