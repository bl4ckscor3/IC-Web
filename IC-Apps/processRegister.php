<?php
	require("api.php");
	
	$mysql = get_mysql();
	
	if($mysql == false)
	{
		echo "Could not connect to database.";
		return;
	}
	
	$username = $_POST['username'];
	$password = hash("sha256", $_POST['password']);
	$mysql->query("insert into users (username, password, admin) values ('".$mysql->real_escape_string($username)."', '".$mysql->real_escape_string($password)."', 0)");	echo true;
?>