<?php 
	session_start();
	
	require('api.php');
	
	if(isset($_SESSION['username']) && is_admin($_SESSION['username']))
	{
		get_mysql()->query("delete from restrictions where username='".$_GET['username']."'");
		header("Location: restrictions.php");
	}
	else
	{
		header("Location: accessDenied.html");
	}
?>