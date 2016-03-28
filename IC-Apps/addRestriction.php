<?php 
	session_start();
	
	require('api.php');
	
	if(isset($_SESSION['username']) && is_admin($_SESSION['username']))
	{
		$mysql = get_mysql();
		
		if($mysql == false)
		{
			echo "restrictions.php?msg=Could not connect to database&type=danger";
		}
	
		if(is_restricted($_POST['username']))
		{
			echo "restrictions.php?msg=This user is already restricted.&type=primary";
		}
		else
		{
			$mysql->query("insert into restrictions (username) values ('".$_POST['username']."')");
			echo "restrictions.php?msg=User is now getting restricted.&type=success";
		}
	}
	else
	{
		header("Location: accessDenied.html");
	}
?>