<?php require_once("include/db.php") ?>
<?php require_once("include/session.php") ?>
<?php require_once("include/function.php") ?>
<?php Confirm_Login() ?>
<?php
if(isset($_POST["Submit"])){
$Title=($_POST["Title"]);
$Category=($_POST["Category"]);
$Post=($_POST["Post"]);

date_default_timezone_set("Asia/Kolkata");
$CurrentTime=time();
//$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
$DateTime;
$Admin=$_SESSION["Username"];
$Images=$_FILES["Image"]["name"];
$Target="Upload/".basename($_FILES["Image"]["name"]);
if(empty($Title)){
	$_SESSION["ErrorMessage"]= "Title Can't be Empty";
	redirect_to("addnewpost.php");
	exit;
}
elseif (strlen($Title)<4) {
	$_SESSION["ErrorMessage"]= "Title must have atleast 4 character";
	redirect_to("addnewpost.php");
}
elseif(empty($Post)){
	$_SESSION["ErrorMessage"]= "Post Can't be Empty";
	redirect_to("addnewpost.php");
}
else{
	global $Connection;
	$Query="INSERT INTO admin_panel(datetime,title,category,author,image,post) VALUES('$DateTime','$Title','$Category','$Admin','$Images','$Post')";
	$Execute=mysqli_query($Connection,$Query);
	move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
	if ($Execute) {
		$_SESSION["SuccessMessage"]= "Post Added Successfully";
		redirect_to("addnewpost.php");
	}
	else{
		$_SESSION["ErrorMessage"]= "Post not Added";
		redirect_to("addnewpost.php");
	}
	
	
}
}
?>
	
<!DOCTYPE html>
<html>
<head>
	<title>Add New Post</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
	<link rel="stylesheet" type="text/css" href="admin.css">
	<style type="text/css">
		.fieldInfo{
			color:rgb(251,174,44);
			font-family: Bitter,Georgia,"Times New Roman",Times,serif;
			font-size:1.2em;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
			<div class="row">
				<!--side area-->
				<div class="col-md-2">
					<br><br>
					<ul id="sidemenu" class="nav nav-pills nav-stacked">
						<li ><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>
						 &nbsp;Dashboard</a></li>
						<li class="active"><a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>
						 &nbsp;Add new post</a></li>
						<li ><a href="category.php"><span class="glyphicon glyphicon-tags"></span>
						 &nbsp;Categories</a></li>
						<li><a href="admin.php"><span class="glyphicon glyphicon-user"></span>
						 &nbsp;Manage Admin</a></li>
						<li><a href="comments.php"><span class="glyphicon glyphicon-comment"></span>
						 &nbsp;Comments</a></li>
						<li><a href="#.php"><span class="glyphicon glyphicon-equalizer"></span> 
						&nbsp;Live Blog</a></li>
						<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> 
						&nbsp;Log Out</a></li>


					</ul>
				</div>
				<!--end side area-->

				<!--main area-->
				<div class="col-md-10">
					<h1>Add New Post</h1>
					<div><?php echo Message();
					echo SuccessMessage() ?></div>
					<div>
						<form action="addnewpost.php" method="post" enctype="multipart/form-data">
							<fieldset>
								<div class="form-group">
								<label for="title"><span class="fieldInfo">Title:</span></label>
								<input class="form-control" type="text" name="Title" id="title" placeholder="Title"></div>
								<div class="form-group">
								<label for="categoryselect"><span class="fieldInfo">Category:</span></label>
								<select class="form-control" type="text" name="Category" id="categoryselect">
									<?php
										global $ConnectingDB;
										$ViewQuery="SELECT * FROM category ORDER BY id desc";
										$Execute=mysqli_query($Connection,$ViewQuery);
										while($DataRows=mysqli_fetch_array($Execute)){
											$Id=$DataRows["id"];
											$CategoryName=$DataRows["name"];
										?>	
											<option><?php echo $CategoryName; ?></option>
											<?php } ?>
													
											</select>
										</div>
										<div class="form-group">
										<label for="imageselect"><span class="fieldInfo">Select Image:</span></label>
										<input type="File" class="form-control" name="Image" id="imageselect">
										</div>
										<div class="form-group">
										<label for="postarea"><span class="fieldInfo">Post:</span></label>
										<textarea class="form-control" name="Post" id="postarea"></textarea>
										<br>
								<input class="btn btn-primary btn-lg" type="Submit" name="Submit" value="Add new Post">
							</fieldset>
						</form>
					</div><br>


					




					</div>
				</div>
				<!--end main area-->
			</div><!--end of row-->
			
		</div><!--end of container-->

	<div id="footer">
		<hr><p>Theme by | Ram Pravesh Gond| &copy; 2017-2019 All Right Reserved</p>

	</div>
	

</body>
</html>