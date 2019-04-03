<?php
if(session_status() === PHP_SESSION_NONE)
	{
		session_start();
	}
if (!isset($_SESSION['userType']) or $_SESSION['userType'] != "student")  
	{
		echo("<p style='color:red'>you are not authorised to view this page</p>");
		die();
	}
else
	{
		echo("<p style='color:green'>Valid User Confirmed</p>");
	}
?>