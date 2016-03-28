<?php 
	session_start();
	
	if(!isset($_SESSION['username']))
	{
		header("Location: accessDenied.html");
	}

	require('api.php');
	
	$mysql = get_mysql();
	
	if(has_voted($_SESSION['username'], $_GET['id']))
	{
		header("Location: app.php?id=".$_GET['id']."&x=y");
	}
	else if($_GET['vote'] == "yes")
	{
		$current = get_score($_GET['id']) + 1;
		
		$mysql->query("update apps set score=".$current." where id=".$_GET['id']);
		finalize();
	}
	else if($_GET['vote'] == "no")
	{
		$current = get_score($_GET['id']) - 1;
		
		$mysql->query("update apps set score=".$current." where id=".$_GET['id']);
		finalize();
	}

	function finalize()
	{
		$mysql = get_mysql();
		$current = get_votes($_GET['id']) + 1;

		$mysql->query("update apps set votes=".$current." where id=".$_GET['id']);
		$mysql->query("insert into votedOn (username, id) values ('".$_SESSION['username']."', '".$_GET['id']."')");
		header("Location: app.php?id=".$_GET['id']);
	}
?>