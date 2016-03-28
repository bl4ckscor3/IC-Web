<?php 
	session_start();
	
	require('api.php');
	
	if(isset($_SESSION['username']) && is_admin($_SESSION['username']))
	{
		get_mysql()->query("update users set admin=".$_GET['action']." where username='".$_GET['username']."'");
		header("Location: users.php");
	}
	else
	{
		header("Location: accessDenied.html");
	}
?>