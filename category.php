<?php require_once("include/db.php") ?>
<?php require_once("include/session.php") ?>
<?php require_once("include/function.php") ?>
<?php Confirm_Login() ?>
<?php
if(isset($_POST["Submit"])){
$Category=($_POST["Category"]);
date_default_timezone_set("Asia/Kolkata");
$CurrentTime=time();
//$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
$DateTime;
$Admin=$_SESSION["Username"];
if(empty($Category)){
	$_SESSION["ErrorMessage"]= "All Fields must be filled out";
	redirect_to("category.php");
	exit;
}
elseif (strlen($Category)>25) {
	$_SESSION["ErrorMessage"]= "Too Long Category Name";
	redirect_to("category.php");
}
else{
	global $Select;
	$Query="INSERT INTO category(datetime,name,creator) VALUES('$DateTime','$Category','$Admin')";
	$Execute=mysqli_query($Connection,$Query);
	if ($Execute) {
		$_SESSION["SuccessMessage"]= "Category Added Successfully";
		redirect_to("category.php");
	}
	else{
		$_SESSION["ErrorMessage"]= "Not Added to Database";
		redirect_to("category.php");
	}
	
	
}
}
?>
	
<!DOCTYPE html>
<html>
<head>
	<title>Category</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
	<link rel="stylesheet" type="text/css" href="admin.css">
	<style type="text/css">
		.fieldInfo{
			font-size: 2em;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
			<div class="row">
				<!--side area-->
				<div class="col-md-2">
					
					<ul id="sidemenu" class="nav nav-pills nav-stacked">
						<li ><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>
						 &nbsp;Dashboard</a></li>
						<li><a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>
						 &nbsp;Add new post</a></li>
						<li class="active"><a href="category.php"><span class="glyphicon glyphicon-tags"></span>
						 &nbsp;Categories</a></li>
						<li><a href="#.php"><span class="glyphicon glyphicon-user"></span>
						 &nbsp;Manage Admin</a></li>
						<li><a href="#.php"><span class="glyphicon glyphicon-comment"></span>
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
					<h1>Manage Categories</h1>
					<div><?php echo Message();
					echo SuccessMessage() ?></div>
					<div>
						<form action="category.php" method="post">
							<fieldset>
								<div class="form-group">
								<label for="categoryname"><span class="fieldInfo">Name:</span></label>
								<input class="form-control" type="text" name="Category" id="categoryname" placeholder="Name"></div>
								<input class="btn btn-primary btn-lg" type="Submit" name="Submit" value="Add new Category">
							</fieldset>
						</form>
					</div><br>


					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tr>
								<th>Sr No.</th>
								<th>Date & Time</th>
								<th>Category Name</th>
								<th>Creator Name</th>
								<th>Action</th>
						
								
							</tr>
							<?php
								global $Select;
								$ViewQuery="SELECT * FROM category ORDER BY id desc";
								$Execute=mysqli_query($Connection,$ViewQuery);
								$SrNo=0;
								while($DataRows=mysqli_fetch_array($Execute)){
									$Id=$DataRows["id"];
									$DateTime=$DataRows["datetime"];
									$CategoryName=$DataRows["name"];
									$CreatorName=$DataRows["creator"];
									$SrNo++;


									?>
									<tr>
										<td><?php echo $SrNo; ?></td>
										<td><?php echo $DateTime; ?></td>
										<td><?php echo $CategoryName; ?></td>
										<td><?php echo $CreatorName; ?></td>
										<td><a href="DeleteCategory.php?id=<?php echo $Id;?>">
	<span class="btn btn-danger">Delete</span>
	</a></td></td>
									</tr>
									<?php } ?>
								</table>




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