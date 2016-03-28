<?php 
	session_start();
	require('api.php');
	
	if(isset($_SESSION['username']) && is_admin($_SESSION['username']))
	{
		get_mysql()->query("delete from users where username='".$_GET['username']."'");
		header("Location: users.php");
	}
	else
	{
		header("Location: accessDenied.html");
	}
?>