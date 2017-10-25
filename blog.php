<?php require_once("Include/db.php"); ?>
<?php require_once("Include/session.php"); ?>
<?php require_once("Include/function.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>
	   <link rel="stylesheet" href="css/bootstrap.min.css">
                <script src="js/jquery-3.2.1.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/publicstyles.css">
               <style>
		

nav ul li{
    float:;
}

	       </style> 
	</head>
	<body>
<div style="height: 10px; background: #27aae1;"></div>
<nav class="navbar navbar-inverse" role="navigation">
	<div class="container">
		<div class="navbar-header">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
		data-target="#collapse">
		<span class="sr-only">Toggle Navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="Blog.php">
	   <img style="margin-top: -12px;" src="images/kala.jpg" width=200;height=30;>
	</a>
		</div>
		<div class="collapse navbar-collapse" id="collapse">
		<ul class="nav navbar-nav">
			<li><a href="#">Home</a></li>
			<li class="active"><a href="Blog.php">Blog</a></li>
			<li><a href="#">About Us</a></li>
			<li><a href="#">Services</a></li>
			<li><a href="#">Contact Us</a></li>
			<li><a href="#">Feature</a></li>
		</ul>
		<form action="Blog.php" class="navbar-form navbar-right">
		<div class="form-group">
		<input type="text" class="form-control" placeholder="Search" name="Search" >
		</div>
	         <button class="btn btn-default" name="SearchButton">Go</button>
			
		</form>
		</div>
		
	</div>
</nav>
<div class="Line" style="height: 10px; background: #27aae1;"></div>
<div class="container"> <!--Container-->
	<div class="blog-header">
	<h1>The Complete Responsive CMS Blog  </h1>
	<p class="lead">The Complete blog using PHP by Ram Pravesh</p>
	</div>
	<div class="row"> <!--Row-->
		<div class="col-sm-8"> <!--Main Blog Area-->
		<?php
		global $Connection;
		if(isset($_GET["SearchButton"])){
			$Search=$_GET["Search"];
			
		$ViewQuery="SELECT * FROM admin_panel 
		WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%'
		OR category LIKE '%$Search%' OR post LIKE '%$Search%' ORDER BY id desc";
		}
         else{
          $ViewQuery="SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,3";}
		$Execute=mysqli_query($Connection,$ViewQuery);
		while($DataRows=mysqli_fetch_array($Execute)){
			$PostId=$DataRows["id"];
			$DateTime=$DataRows["datetime"];
			$Title=$DataRows["title"];
			$Category=$DataRows["category"];
			$Admin=$DataRows["author"];
			$Image=$DataRows["image"];
			$Post=$DataRows["post"];
		
		?>
		<div class="blogpost thumbnail">
			<img class="img-responsive img-rounded" src="Upload/<?php echo $Image;  ?>" >
		<div class="caption">
			<h1 id="heading"> <?php echo htmlentities($Title); ?></h1>
		<p class="description">Category:<?php echo htmlentities($Category); ?> Published on
		<?php echo htmlentities($DateTime);?></p>
		<p class="post"><?php 
		if (strlen($Post)>150) {$Post=substr($Post,0,150).'...';}
		
		echo $Post;  ?></p>
	</div>
        <a href="FullPost.php?id=<?php echo $PostId; ?>"><span class="btn btn-info">
			Read More &rsaquo;&rsaquo;
		</span></a>
        </div>
		<?php } ?>
	



</body>
</html>