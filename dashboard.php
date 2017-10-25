<?php require_once("include/db.php") ?>
<?php require_once("include/session.php") ?>
<?php require_once("include/function.php") ?>
<?php Confirm_Login() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
	<link rel="stylesheet" type="text/css" href="css/adminstyles.css">



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
	<div class="container-fluid">
			<div class="row">
				<!--side area-->
				<div class="col-sm-2">
		<br><br><br>
					<ul id="sidemenu" class="nav nav-pills nav-stacked">
						<li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>
						 &nbsp;Dashboard</a></li>
						<li><a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>
						 &nbsp;Add new post</a></li>
						<li><a href="category.php"><span class="glyphicon glyphicon-tags"></span>
						 &nbsp;Categories</a></li>
						<li><a href="#.php"><span class="glyphicon glyphicon-user"></span>
						 &nbsp;Manage Admin</a></li>
						<li><a href="Logout.php"><span class="glyphicon glyphicon-comment"></span>
						 &nbsp;Comments
						 <?php
$Connection;
$QueryUnApproved="SELECT COUNT(*) FROM comments WHERE status='OFF'";
$ExecuteUnApproved=mysqli_query($Connection,$QueryUnApproved);
$RowsUnApproved=mysqli_fetch_array($ExecuteUnApproved);
$TotalUnApproved=array_shift($RowsUnApproved);
if($TotalUnApproved>0){
?>
<span class="label pull-right label-warning">
<?php echo $TotalUnApproved;?>
</span>
		
<?php } ?>

						</a></li>
						<li><a href="#.php"><span class="glyphicon glyphicon-equalizer"></span> 
						&nbsp;Live Blog</a></li>
						<li><a href="#.php"><span class="glyphicon glyphicon-log-out"></span> 
						&nbsp;Log Out</a></li>


					</ul>
				</div>
				<!--end side area-->

				<!--main area-->
				<div class="col-sm-10">
					<div><?php echo Message();
					echo SuccessMessage(); ?></div>
					<h1>Admin Dashboard</h1>
					<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<th>No.</th>
							<th>Post Title</th>
							<th>Date & Time</th>
							<th>Author</th>
							<th>Category</th>
							<th>Images</th>
							<th>Comment</th>
							<th>Action</th>
							<th>Details</th>
						</tr>
						<?php
$Connection;
$ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc;";
$Execute=mysqli_query($Connection,$ViewQuery);
$SrNo=0;
while($DataRows=mysqli_fetch_array($Execute)){
	$Id=$DataRows["id"];
	$DateTime=$DataRows["datetime"];
	$Title=$DataRows["title"];
	$Category=$DataRows["category"];
	$Admin=$DataRows["author"];
	$Image=$DataRows["image"];
	$Post=$DataRows["post"];
	$SrNo++;
	?>
	<tr>
		
	<td><?php echo $SrNo; ?></td>
	<td style="color: #5e5eff;"><?php
	if(strlen($Title)>19){$Title=substr($Title,0,19).'..';}
	echo $Title;
	?></td>
	<td><?php
	if(strlen($DateTime)>12){$DateTime=substr($DateTime,0,12);}
	echo $DateTime;
	?></td>
	<td><?php
	if(strlen($Admin)>9){$Admin=substr($Admin,0,9);}
	echo $Admin; ?></td>
	<td><?php
	if(strlen($Category)>10){$Category=substr($Category,0,10);}
	echo $Category;
	?></td>
	<td><img src="Upload/<?php echo $Image; ?>" width="170px"; height="50px"></td>
	
		<td>
			<?php
$Connection;
$QueryApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='ON'";
$ExecuteApproved=mysqli_query($Connection,$QueryApproved);
$RowsApproved=mysqli_fetch_array($ExecuteApproved);
$TotalApproved=array_shift($RowsApproved);
if($TotalApproved>0){
?>
<span class="label pull-right label-success">
<?php echo $TotalApproved;?>
</span>
		
<?php } ?>

<?php
$Connection;
$QueryUnApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='OFF'";
$ExecuteUnApproved=mysqli_query($Connection,$QueryUnApproved);
$RowsUnApproved=mysqli_fetch_array($ExecuteUnApproved);
$TotalUnApproved=array_shift($RowsUnApproved);
if($TotalUnApproved>0){
?>
<span class="label  label-danger">
<?php echo $TotalUnApproved;?>
</span>
		
<?php } ?>
		</td>
		<td>
			<a href="editpost.php?edit=<?php echo $Id ?>">
				<span class="btn btn-warning">Edit</span>
			</a>
			<a href="deletepost.php?delete=<?php echo $Id ?>">
				<span class="btn btn-danger">Delete</span>
			</a>
		</td>
		<td><a href="FullPost.php?id=<?php echo $Id ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
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