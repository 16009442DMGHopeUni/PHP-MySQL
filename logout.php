<?php
	include("header.php");
	session_start();
	session_destroy();
	include("LeftNav.php");
?>
<div class="col c8">
	<?php
	echo ("You have successfully logged out.");
	?>
</div>
 <?php
 	include("RightNav.php");
 	include("footer.php");
 ?>