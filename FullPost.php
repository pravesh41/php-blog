<?php require_once("Include/db.php"); ?>
<?php require_once("Include/session.php"); ?>
<?php require_once("Include/function.php"); ?>

<?php
if(isset($_POST["Submit"])){
$Name=($_POST["Name"]);
$Email=($_POST["Email"]);
$Comment=($_POST["Comment"]);

date_default_timezone_set("Asia/Kolkata");
$CurrentTime=time();
//$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
$DateTime;
$Admin="Ram Pravesh";
$PostId=$_GET["id"];
if(empty($Name) || empty($Email)||empty($Comment)){
	$_SESSION["ErrorMessage"]= "All Field are Required";
	exit;
}
elseif (strlen($Comment)>200) {
	$_SESSION["ErrorMessage"]= "Maximum 200 Character are allowed";
	
}
else{
	global $Connection;
	$PostIdFromURL=$_GET['id'];
	$Query="INSERT INTO comments(datetime,name,email,comment,approveby,status,admin_panel_id)
	VALUES ('$DateTime','$Name','$Email','$Comment','Pending','OFF','$PostIdFromURL')";
	$Execute=mysqli_query($Connection,$Query);
	if ($Execute) {
		$_SESSION["SuccessMessage"]= "Comment Added Successfully";
		redirect_to("FullPost.php?id={$PostId}");
	}
	else{
		$_SESSION["ErrorMessage"]= "Something Went Wrong";
		redirect_to("FullPost.php?id={$PostId}");
	}
	
	
}
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Full Post</title>
	   <link rel="stylesheet" href="css/bootstrap.min.css">
                <script src="js/jquery-3.2.1.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/publicstyles.css">
               <style>
		

nav ul li{
    float:;
}
.fieldInfo{
			color:rgb(251,174,44);
			font-family: Bitter,Georgia,"Times New Roman",Times,serif;
			font-size:1.2em;
		}
.CommentBlock{
background-color:#F6F7F9;
}
.Comment-info{
	color: #365899;
	font-family: sans-serif;
	font-size: 1.1em;
	font-weight: bold;
	padding-top: 10px;
        
	
}
.comment{
    margin-top:-2px;
    padding-bottom: 10px;
    font-size: 1.1em
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
		<form action="blog.php" class="navbar-form navbar-right">
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
	<div><?php echo Message();
					echo SuccessMessage() ?></div>
					<div>
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
         	$PostIdFromURL=$_GET["id"];
          $ViewQuery="SELECT * FROM admin_panel WHERE id='$PostIdFromURL' ORDER BY id desc LIMIT 0,3";}
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
		
		echo $Post;  ?></p>
	</div>
        </div>
		<?php } ?>
		<br><br>
		<br><br>

<span class="fieldInfo">Comments</span>
<?php
$Connection;
$PostIdForComments=$_GET["id"];
$ExtractingCommentsQuery="SELECT * FROM comments
WHERE admin_panel_id='$PostIdForComments' AND status='ON'";
$Execute=mysqli_query($Connection,$ExtractingCommentsQuery);
while($DataRows=mysqli_fetch_array($Execute)){
	$CommentDate=$DataRows["datetime"];
	$CommenterName=$DataRows["name"];
	$Comments=$DataRows["comment"];


?>
<div class="CommentBlock">
	<img style="margin-left: 10px; margin-top: 10px;" class="pull-left" src="images/user.png" width=70px; height=70px;>
	<p style="margin-left: 90px;" class="Comment-info"><?php echo $CommenterName; ?></p>
	<p style="margin-left: 90px;"class="description"><?php echo $CommentDate; ?></p>
	<p style="margin-left: 90px;" class="Comment"><?php echo nl2br($Comments); ?></p>
	
</div>

	<hr>
<?php } ?>
		
		
		<br>
		<span class="fieldInfo">Share your thoughts about this post</span>

		<div>
						<form action="FullPost.php?id=<?php echo $PostId; ?>" method="post" enctype="multipart/form-data">
							<fieldset>
								<div class="form-group">
								<label for="name"><span class="fieldInfo">Name:</span></label>
								<input class="form-control" type="text" name="Name" id="name" placeholder="Name"></div>
								<div class="form-group">
								<label for="email"><span class="fieldInfo">Email:</span></label>
								<input class="form-control" type="email" name="Email" id="email" placeholder="Email"></div>
										<div class="form-group">
										<label for="comment"><span class="fieldInfo">Comment:</span></label>
										<textarea class="form-control" name="Comment" id="comment"></textarea>
										<br>
								<input class="btn btn-primary btn-lg" type="Submit" name="Submit" value="Comment">
							</fieldset>
						</form>
					</div>
	



</body>
</html>