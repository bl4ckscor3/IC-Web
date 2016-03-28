<?php
	session_start();
	require("api.php");
	
	if(!isset($_SESSION['username']))
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
		
		<title>IC - Restrictions</title>
		
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
			  		<?php if(isset($_GET['type'])){
			  			echo "<span class=\"label label-".$_GET['type']."\">".$_GET['msg']."</span><br><br>";
			  		}?>
			  		<div class="btn-group">
			  			<button class="btn btn-danger" onclick="location.href='logout.php'"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout</button>
			  			<button class="btn btn-warning" onclick="location.href='applications.php?hide=t'"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Apps</button>
			  			<?php if(is_admin($_SESSION['username'])){?>
				  			<button id="registration" class="btn btn-info" onclick="location.href='adminPanel.php'"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Admin panel</button>
			  			<?php }?>
			  		</div>
			  		<h2>Restrictions</h2>
			  		<hr>
			  		<div class="container">
			  			<table class="table table-bordered table-hover table-condensed">
			  				<tr>
			  					<th>Name</th>
			  					<?php if(is_admin($_SESSION['username'])){?>
			  						<th>Remove</th>
			  					<?php }?>
			  				</tr>
			  				<?php 
			  					$apps = get_mysql()->query("select * from restrictions");

			  					while($app = $apps->fetch_assoc()){?>
			  						<tr>
			  							<?php echo "<td>".$app['username']."</td>";?>
			  							<?php if(is_admin($_SESSION['username'])){?>
				  							<?php echo "<td><button class=\"btnd btn-danger btn-xs\" onclick=\"location.href='removeRestriction.php?username=".$app['username']."'\">Remove</button></td>"?>
				  						<?php }?>
			  						</tr>
			  				<?php }?>
			  			</table>
			  		</div>
				</div>
			</div>
		</div>
	</body>
</html>
