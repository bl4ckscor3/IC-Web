<?php
	session_start();
	
	require("api.php");
	
	if(isset($_SESSION['username']) && is_admin($_SESSION['username']))
	{
		require("api.php");
		
		get_mysql()->query("update apps set state='".$mysql->real_escape_string($_GET['action'])."' where id='".$mysql->real_escape_string($_GET['id'])."'");
		header("Location: applications.php");
	}
	else
	{
		header("Location: accessDenied.html");
	}
?>