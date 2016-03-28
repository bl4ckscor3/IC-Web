<?php 
	session_start();
	
	require('api.php');
	
	if(isset($_SESSION['username']) && is_admin($_SESSION['username']))
	{
		get_mysql()->query("update register set state=".$_GET['hide']."");
		header("Location: adminPanel.php");
	}
	else
	{
		header("Location: accessDenied.html");
	}
?>