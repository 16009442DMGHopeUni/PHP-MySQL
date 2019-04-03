<?php
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
<html>
<body>
<style>
table, th, td {
    border: 1px solid black;
}
</style>

<?php

// Create connection
$conn = mysqli_connect("localhost", "root", "root", "aceTraining");
// Check connection
$sql = "SELECT * FROM user";
echo ("<p>SQL QUERY: <pre>" . $sql . "</pre></p>");
	if ($resource = mysqli_query($conn,$sql))
		{
			echo("<p style = 'color:green'>SUCCESS</p>");
			
		}
	else
		{
			echo ("<p style = 'color:red'>FAIL: ");
			echo (mysqli_error($conn) . "</p>");
		}

$sql = "SELECT userID, userForename, userSurname, userEmail FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th><th>Email</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["userID"]. "</td><td>" . $row["userForename"]. " " . $row["userSurname"]. "</td></tr><td>" . $row["userEmail"]. "</td></tr> ";
    }
    echo "</table>";
} else {
    echo "0 results";
}
?>
</div>
 <?php
 	include("RightNav.php");
 	include("footer.php");
 ?>
 </body>
 </html>