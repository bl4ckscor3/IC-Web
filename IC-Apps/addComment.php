<?php 
	session_start();
	
	require("api.php");
	
	if(!isset($_SESSION['username']))
	{
		header("Location: accessDenied.html");
	}
	
	get_mysql()->query("insert into comments (appid, user, comment, timestamp) values (".$_POST['id'].", '".$_SESSION['username']."', '".$_POST['comment']."', '".time()."')");
?>