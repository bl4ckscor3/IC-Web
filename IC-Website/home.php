<!DOCTYPE html>
<html lang="en">
	<?php $title = "Home";
	require('htmlHead.php')?>
	<body>
	    <?php require('header.php')?>
	    <div class="container">
	    	<div class="box">
	    		<div class="col-lg-12 text-center">
	    			<div id="slider" class="carousel slide">
	    				<ol class="carousel-indicators hidden-xs">
	    					<li data-target="#slider" data-slide-to="0" class="active">
	    					<?php 
	    						$i = 2;
								$files = scandir('res/slides');
								
	    						while($i < sizeof($files) - 1){
	    							if($files[$i] == "..")
	    							{
	    								$i++;
	    								continue;
	    							}?>
	    							
	    							<li data-target="#slider" data-slide-to="<?php echo $i - 1;?>">
	    					<?php 	$i++; 
	    						}?>
	    				</ol>
	    				<div class="carousel-inner">
	    					<?php 
	    						$i = 2;
								
	    						while($i < sizeof($files)){
	    							if($files[$i] == "..")
	    							{
	    								$i++;
	    								continue;
	    							}?>
	    							
	    							<div class="item<?php echo $i == 2 ? " active" : ""?>">
	    								<img class="img-responsive img-full" src="res/slides/<?php echo $files[$i];?>">
	    							</div>
	    					<?php 	$i++;
	    						}?>
	    				</div>
	    				<a class="left carousel-control" href="#slider" data-slide="prev">
	    					<span class="icon-prev"></span>
	    				</a>
	    				<a class="right carousel-control" href="#slider" data-slide="next">
	    					<span class="icon-next"></span>
	    				</a>
	    			</div>
	    		</div>
	    	</div>
	    </div>
	    <?php require('footer.php')?>
	    <script>
	    	$('.carousel').carousel({interval: 5000})
	    </script>
	</body>
</html>
