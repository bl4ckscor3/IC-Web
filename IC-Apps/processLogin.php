<?php
	session_start();
	require("api.php");
	
	if(isset($_SESSION['username']))
	{
		header("Location: applications.php?hide=t");
	}
	
	$mysql = get_mysql();
	
	if($mysql == false)
	{
		echo "Could not connect to database.";
	}
	
	if(isset($_SESSION['username']))
	{
		echo true;
	}
	else
	{
		$username = $_POST['username'];
		$password = hash("sha256", $_POST['password']);
		
		if($mysql->query("select count(*) from users where username='".$mysql->real_escape_string($username)."' and password='".$mysql->real_escape_string($password)."'")->fetch_assoc()["count(*)"] > 0)
		{	
			$_SESSION['username'] = $_POST['username'];
			echo true;
		}
		else
		{
			echo "Invalid login credentials.";
		}
	}
?>