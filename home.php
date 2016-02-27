<!DOCTYPE html>
<html lang="en">
	<?php $title = "Home";
	require('htmlHead.php')?>
	<body>
	    <?php require('header.php')?>
	    <div class="container">
	        <div class="row">
	            <div class="box">
	                <div class="col-lg-12 text-center">
	                    <div id="carousel-example-generic" class="carousel slide">
	                        <!-- Indicators -->
	                        <ol class="carousel-indicators hidden-xs">
	                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
	                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
	                        </ol>
	                        <div class="carousel-inner">
	                            <div class="item active">
	                                <img class="img-responsive img-full" src="img/slide-1.jpg" alt="">
	                            </div>
	                            <div class="item">
	                                <img class="img-responsive img-full" src="img/slide-2.jpg" alt="">
	                            </div>
	                            <div class="item">
	                                <img class="img-responsive img-full" src="img/slide-3.jpg" alt="">
	                            </div>
	                        </div>
	                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
	                            <span class="icon-prev"></span>
	                        </a>
	                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
	                            <span class="icon-next"></span>
	                        </a>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <?php require('footer.php')?>
	    <script>
	    $('.carousel').carousel({
	        interval: 5000 //changes the speed
	    })
	    </script>
	</body>
</html>