<?php 
	session_start();
	
	if(isset($_SESSION['username']))
	{
		echo "<script>window.location = \"applications.php?hide=t\";</script>";
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
		</style>

		<title>IC - Login</title>
		
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
					<h2>You can login to your account right here:</h2>
					<hr>
					<form id="form">
						<div class="form-group">
							<label class="pull-left" for="username">Username:</label>
							<br>
							<input class="form-control" type="text" id="username" placeholder="Username" autofocus>
						</div>
						<div class="form-group">
							<label class="pull-left" for="age">Password:</label>
							<br>
							<input class="form-control" type="password" id="password" placeholder="Password">
						</div>
						<br>
						<div class="form-group">
							<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Login</button>
							<br><br>
							<div id="buttonInfo"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script>
			$(document).ready(function(){
				$("#form").submit(function(e){
					e.preventDefault();
					
					var username = $("#username").val();
					var password = $("#password").val();

					$.post("processLogin.php", {username: username, password: password}, function(data){
						if(data == true || data == false)
						{
							location.href = "applications.php";
						}
						else
						{
							document.getElementById("buttonInfo").innerHTML = "<span class=\"label label-danger\">" + data + "</span>";
						}
					});
				});
			});
		</script>
	</body>
</html>