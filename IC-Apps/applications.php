<?php
	session_start();
	require("api.php");
	
	if(!isset($_SESSION['username']))
	{
		header("Location: accessDenied.html");
	}
	
	if(!isset($_GET['hide']))
	{
		$_GET['hide'] = "t";
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
		
		<title>IC - Apps</title>
		
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
			  			<button class="btn btn-warning" onclick="location.href='restrictions.php'"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Restrictions</button>
			  			<?php if(is_admin($_SESSION['username'])){?>
			  				<button id="registration" class="btn btn-info" onclick="location.href='adminPanel.php'"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Admin panel</button>
			  			<?php }?>
			  		</div>
			  		<hr>
			  		<h3>Click on the timestamp, name or age to see the complete application.</h3>
			  		<h4>Timestamps are day.month.year hour:minute:second</h4>
			  		<hr>
			  		<div class="container">
			  			<button class="btnd btn-primary btn-sm" onclick="location.href='applications.php?hide=<?php echo hide(true, $_GET['hide']);?>'"><?php echo hide(false, $_GET['hide']);?> hidden apps</button>
			  			<br><br>
			  			<table class="table table-bordered table-hover table-condensed">
			  				<tr>
			  					<th>View</th>
			  					<th>State</th>
			  					<th>Timestamp</th>
			  					<th>Name</th>
			  					<th>Age</th>
			  					<?php if(is_admin($_SESSION['username'])){?>
									<th>Hide</th>
			  					<?php }?>
			  				</tr>
			  				<?php 
			  					$apps = get_mysql()->query("select * from apps");
			  					
			  					while($app = $apps->fetch_assoc()){?>
			  					<?php if($app['hidden'] == 0 || ($_GET['hide'] == "f" && $app['hidden'] == 1)){?>
				  						<tr>
				  							<td><button class="btnd btn-success btn-xm" onclick="location.href='app.php?id=<?php echo $app['id']?>&sort=down'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button></td>
				  							<?php 
				  								$state = get_state($app['id'])['state'];
				  								
				  								if($state == "Accepted")
				  								{
				  									echo "<td class=\"success\">Accepted</td>";
				  								}
				  								else if($state == "Denied")
				  								{
			 										echo "<td class=\"danger\">Denied</td>";
			 									}
			 									else if($state == "Pending")
			 									{
			 										echo "<td class=\"info\">Pending...</td>";
			 									}
				  							?>
				  							<td><?php echo date("d.m.Y h:i:sa", $app['timestamp'])?></td>
				  							<td><?php echo $app['username']?></td>
				  							<td><?php echo $app['age']?></td>
											<?php if(is_admin($_SESSION['username'])){?>					  							
				  								<td><button class="btnd btn-xs btn-<?php echo !($_GET['hide'] == "f" && $app['hidden']) ? "danger\" onclick=\"location.href='unHide.php?action=1&id=".$app['id']."'" : "success disabled\"";?>"><?php echo $app['hidden'] ? "Hidden" : "Hide"?></button></td>
				  							<?php }?>
				  						</tr>
				  					<?php }?>
			  				<?php }?>
			  			</table>
			  		</div>
				</div>
			</div>
		</div>
	</body>
</html>
