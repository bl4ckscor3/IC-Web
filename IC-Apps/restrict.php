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
			
			td
			{
				text-align: center;
				vertical-align: middle;
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
		
		<title>IC - Restrict</title>
		
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
			  		<div class="btn-group">
			  			<button class="btn btn-danger" onclick="location.href='logout.php'"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout</button>
			  			<button class="btn btn-warning" onclick="location.href='applications.php?hide=t'"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Apps</button>
			  			<button type="button" class="btn btn-info" onclick="location.href='adminPanel.php'"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Admin panel</button>
			  		</div>
					<form id="restrict">
						<h2>Restrict a user from applying</h2>
						<img src="res/hrline.png">
						<br><br>
						<label for="user" class="pull-left">Name:</label>
						<input class="form-control" type="text" id="username" autofocus>
						<br>
						<button type="submit" class="btn btn-info btn-block"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Restrict</button>
					</form>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script>
			$(document).ready(function(){
				$("#restrict").submit(function(e){
					e.preventDefault();
					
					$.post("addRestriction.php", {username: $("#username").val()}, function(data){
						location.href = data;
					});
				});
			});
		</script>
	</body>
</html>