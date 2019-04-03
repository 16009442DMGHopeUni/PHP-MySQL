<?php
	include("header.php");
	include("LeftNav.php");
	include("studentCheck.php")
?>

<div class="col c8">
<?php

	$conn = mysqli_connect("localhost","root","root","aceTraining");
	$sql = "SELECT * FROM resource";
	$result = mysqli_query($conn,$sql);

	echo ("<b>Click on the resource you want to download!</b> <br><br><br>");
	while ($record = mysqli_fetch_array($result))
	     {
	     	    		echo ("<li><a href='uploads/" . $record['filename'] . "' download >" . $record['name'] . "</a></li>" );
	     }
?>
</div>

<?php
	include("RightNav.php");
 	include("footer.php");
?>
