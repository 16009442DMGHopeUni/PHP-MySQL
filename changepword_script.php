<?php

session_start();
	include("header.php");
	include("LeftNav.php");


if (!(isset($_SESSION['userID']) || $_SESSION['userID'] == ''))
{
    header("location:login.php");
}

$dbcon = mysqli_connect('localhost', 'root', 'root', 'aceTraining') or die(mysqli_error($dbcon));

$password1 = mysqli_real_escape_string($dbcon, $_POST['newPassword']);
$password2 = mysqli_real_escape_string($dbcon, $_POST['confirmPassword']);
$userID = mysqli_real_escape_string($dbcon, $_SESSION['userID']);

if ($password1 <> $password2)
{
    echo ("your passwords do not match");
}
else if (mysqli_query($dbcon, "UPDATE user SET userPassword='$password1' WHERE userID='$userID'"))
{
    echo ("You have successfully changed your password.");
}
else
{
    mysqli_error($dbcon);
}
mysqli_close($dbcon);
?>

<?php
	include("RightNav.php");
 	include("footer.php");
?>