<?php
	session_start();
	require("api.php");
	
	if(!isset($_SESSION['username']))
	{
		header("Location: accessDenied.html");
	}
	
	$app = get_app($_GET['id']);
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
			
			h5
			{
				word-wrap: break-word;
			}
			
			.container .text-up
			{
				padding-top: 10px;
			}
			
			.btnd
			{
				display: inline-block;
				padding: 6px 12px;
				margin-bottom: 0;
				font-size: 30px;
				font-weight: normal;
				line-height: 1.42857143;
				text-align: center;
				white-space: nowrap;
				vertical-align: middle;
				-ms-touch-action: manipulation;
				touch-action: manipulation;
				cursor: pointer;
				-webkit-user-select: none;
				moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
				background-image: none;
				border: 1px solid transparent;
				border-radius: 4px;
			}
			
			.btn-grey
			{ 
  				color: #000000; 
  				background-color: #dedede; 
  				border-color: #dedede; 
			} 
 
			.btn-grey:hover, .btn-grey:focus, .btn-grey:active, .btn-grey.active, .open .dropdown-toggle.btn-grey
			{ 
				color: #000000; 
				background-color: #dedede; 
				border-color: #dedede; 
			} 
 
			.btn-grey:active, .btn-grey.active, .open .dropdown-toggle.btn-grey
			{ 
				background-image: none; 
			} 
			 
			.btn-grey.disabled, .btn-grey[disabled], fieldset[disabled] .btn-grey, .btn-grey.disabled:hover, .btn-grey[disabled]:hover, fieldset[disabled] .btn-grey:hover, .btn-grey.disabled:focus, .btn-grey[disabled]:focus, fieldset[disabled] .btn-grey:focus, .btn-grey.disabled:active, .btn-grey[disabled]:active, fieldset[disabled] .btn-grey:active, .btn-grey.disabled.active, .btn-grey[disabled].active, fieldset[disabled] .btn-grey.active
			{ 
				background-color: #dedede; 
				border-color: #dedede; 
			} 
			 
			.btn-grey .badge
			{ 
				color: #dedede; 
				background-color: #000000; 
			}
			
			#sort
			{
				float: right;
			}
		</style>
		
		<title>IC - Application <?php if(isset($_GET['id'])){echo "#".$_GET['id'];}?></title>

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
				<div style="padding-bottom: 5px;" class="jumbotron">
			  		<?php if(!isset($_GET['id'])){?>
			  			<h2>Application ID not set. Please go to <a href="applications.php">the applications list</a> and choose one from there.</h2>
			  		<?php }else{?>
			  			<?php if($app['hidden'] == 1 && is_admin($_SESSION['username'])){?>
				  			<div class="btn-group">
				  				<button class="btn btn-default" onclick="location.href='applications.php'"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Go back</button>
				  				<button class="btn btn-warning" onclick="location.href='unHide.php?action=0&id=<?php echo $app['id']?>'"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Unhide</button>
				  			</div>
							<br><br>
			  			<?php }else{?>
			  				<button class="btn btn-default" onclick="location.href='applications.php'"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Go back</button>
			  			<?php }?>
			  			<?php if(is_admin($_SESSION['username'])){?>
				  			<div class="btn-group">
								<button id="accept" type="submit" class="btn btn-success <?php outline_accepted($_GET['id']);?>" onclick="location.href='update.php?action=Accepted&id=<?php echo $app['id']?>'"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Accept</button>
								<button id="deny" type="submit" class="btn btn-danger <?php outline_denied($_GET['id']);?>" onclick="location.href='update.php?action=Denied&id=<?php echo $app['id']?>'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Deny</button>
								<button id="pending" type="submit" class="btn btn-primary <?php outline_pending($_GET['id']);?>" onclick="location.href='update.php?action=Pending&id=<?php echo $app['id']?>'"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Pending</button>
				  			</div>
				  		<?php }?>
			  			<h2>Application from <?php echo $app['username']?> aged <?php echo $app['age']?></h2>
			  			<hr>
						<label>Tell us about your time on the server, have you enjoyed it? What have you accomplished on the server? Friendships made?</label>
						<br>
						<h5><?php echo $app['servertime']?></h5>
						<br><br>
						<label>What experience do you have from other servers?</label>
						<br>
						<h5><?php echo $app['experience']?></h5>
						<br><br>
						<label>Why do you think you would be a good addition to the staff team?</label>
						<br>
						<h5><?php echo $app['why']?></h5>
						<?php if($app['additionalInfo']){?>
							<br><br>
							<label>Is there anything else you'd like to tell us (perhaps about you)?</label>
							<br>
							<h5><?php echo $app['additionalInfo']?></h5>
						<?php }?>
						<hr>
						<div style="background-color: #dedede !important" class="jumbotron text-up">
							<h3 style="text-decoration: underline;">Vote here:</h3>
							<hr>
							<button style="color: #1cb800;" class="btnd btn-grey pull-left" onclick="location.href='vote.php?vote=yes&id=<?php echo $app['id']?>'"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></button>
							<b style="font-size: 25px"><?php echo format_score($app['id']);?> (<?php echo get_mysql()->query("select votes from apps where id=".$app['id'])->fetch_Assoc()['votes']?>)</b>
							<button style="color: #b80000;" class="btnd btn-grey pull-right" onclick="location.href='vote.php?vote=no&id=<?php echo $app['id']?>'"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></button>
							<?php if(isset($_GET['x'])){echo "<br><br><br><span class=\"label label-info\">You already voted on this application.</span>";}?>
						</div>
						<div style="background-color: #dedede !important; padding-bottom: 5px;" class="jumbotron text-up">
							<h3 style="text-decoration: underline;">Comments:</h3>
							<button class="btnd btn-primary btn-xs pull-right" id="sort" onclick="location.href='app.php?id=<?php echo $app['id']?>&sort=<?php echo $_GET['sort'] == "up" ? "down" : "up"?>'"><span class="glyphicon glyphicon-arrow-<?php echo $_GET['sort']?>" aria-hidden="true"></span></button>
							<br>
							<hr>
							<?php 
								$comments = get_mysql()->query("select * from comments where appid=".$app['id']." order by timestamp ".($_GET['sort'] == "up" ? "asc" : "desc"));
								
								while($comment = $comments->fetch_assoc()){	?>
									<div style="background-color: #c0c0c0 !important; padding: 15px;" class="jumbotron text-up">
										<div class="pull-left">
											<img src="res/<?php echo $comment['user']?>.png" width=32px height=32px>
											<label><?php echo $comment['user']?>:</label>
										</div>
										<label class="pull-right"><?php echo date("d.m.Y h:i:sa", $comment['timestamp']);?></label>
										<br><br>
										<?php echo $comment['comment'];?>
									</div>
								<?php }?>
							<br>
							<form id="addComment">
								<label class="pull-left">Add your own:</label>
								<textarea style="resize:vertical" class="form-control" rows="3" id="commentInput"></textarea>
								<br>
								<button type="submit" class="btnd btn-success btn-lg"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Comment</button>
								<div id="buttonInfo"></div>
							</form>
						</div>
					<?php }?>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script>
			$(document).ready(function(){
				$("#addComment").submit(function(e){
					e.preventDefault();
					
					$.post("addComment.php", {id: <?php echo $app['id'];?>, comment: $("#commentInput").val()}, function(data){
						location.href = "app.php?id=<?php echo $app['id'];?>&sort=<?php echo $_GET['sort'] == "up" ? "down" : "up"?>";
					});
				});
			});
		</script>
	</body>
</html>