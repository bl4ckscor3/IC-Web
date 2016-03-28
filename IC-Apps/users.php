<?php
	session_start();
	require("api.php");
	
	if(!isset($_SESSION['username']) || !is_admin($_SESSION['username']))
	{
		header("Location: accessDenied.html");
	}
?>
<html>
	<head>
		<style type="text/css">
			html, body
			{
				height: 100%;
				margin: 0;
				padding: 0;
			}
			
			#page-background
			{
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
			}
			
			#content
			{
				position: relative;
				z-index: 1;
				padding: 10px;
			}
			
			.btnd
			{
				  display: inline-block;
				  padding: 6px 12px;
				  margin-bottom: 0;
				  font-size: 14px;
				  font-weight: normal;
				  line-height: 1.42857143;
				  text-align: center;
				  white-space: nowrap;
				  vertical-align: middle;
				  -ms-touch-action: manipulation;
				      touch-action: manipulation;
				  cursor: pointer;
				  -webkit-user-select: none;
				     -moz-user-select: none;
				      -ms-user-select: none;
				          user-select: none;
				  background-image: none;
				  border: 1px solid transparent;
				  border-radius: 4px;
			}
		</style>
		
		<title>IC - User Management</title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="icon" type="image/png" href="http://breakinbad.net/favicon.png">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.css">
		<link rel="stylesheet" href="css/jumbotron-narrow.css">
	</head>
	
	<body>
		<div id="page-background"><img src="res/background.png" width="100%" height="100%" alt="background"></div>
	
		<div id="content">
			<div class="container">
				<div class="jumbotron">
			  		<button class="btn btn-default" onclick="location.href='adminPanel.php'"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Go back</button>
			  		<button class="btn btn-danger" onclick="location.href='logout.php'"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout</button>
			  		<hr>
			  		<div class="container">
			  			<table class="table table-bordered table-hover table-condensed">
			  				<tr>
			  					<th>User</th>
			  					<th>Admin</th>
			  					<th>Remove user</th>
			  				</tr>
			  				<?php 
			  					$users = get_mysql()->query("select * from users");
			  					
			  					while($user = $users->fetch_assoc()){
			  						$username = $user['username'];
			  						$admin = is_admin($username);?>
			  						<tr>
				  						<td><?php echo $username;?></td>
				  						<td><button class="btnd btn-<?php echo $admin ? "primary" : "info";?> btn-xs" onclick="location.href='unSetAdmin.php?action=<?php echo $admin ? 0 : 1;?>&username=<?php echo $username;?>'"><?php echo $admin ? "Remove admin" : "Make admin";?></button></td>
				  						<td><button class="btnd btn-danger btn-xs" onclick="location.href='removeUser.php?username=<?php echo $username;?>'">Remove</button></td>
				  					</tr>
			  				<?php }?>
			  			</table>
			  		</div>
				</div>
			</div>
		</div>
	</body>
</html>
