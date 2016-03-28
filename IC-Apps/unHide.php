<?php 
	session_start();

	require('api.php');
	
	if(isset($_SESSION['username']) && is_admin($_SESSION['username']))
	{
		get_mysql()->query("update apps set hidden=".$_GET['action']." where id=".$_GET['id']);
		header("Location: applications.php?hide=t");
	}
	else
	{
		header("Location: accessDenied.html");
	}
?>