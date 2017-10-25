<?php require_once("include/db.php") ?>
<?php require_once("include/session.php") ?>
<?php require_once("include/function.php") ?>
<?php Confirm_Login() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Comments</title>
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
						<li ><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>
						 &nbsp;Dashboard</a></li>
						<li><a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>
						 &nbsp;Add new post</a></li>
						<li><a href="category.php"><span class="glyphicon glyphicon-tags"></span>
						 &nbsp;Categories</a></li>
						<li><a href="#.php"><span class="glyphicon glyphicon-user"></span>
						 &nbsp;Manage Admin</a></li>
						<li class="active" ><a href="comments.php"><span class="glyphicon glyphicon-comment"></span>
						 &nbsp;Comments</a></li>
						<li><a href="#.php"><span class="glyphicon glyphicon-equalizer"></span> 
						&nbsp;Live Blog</a></li>
						<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> 
						&nbsp;Log Out</a></li>


					</ul>
				</div>
				<!--end side area-->

				<!--main area-->
				<div class="col-sm-10">
					<div><?php echo Message();
					echo SuccessMessage(); ?></div>
					<h1>Un Approved Comments</h1>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tr>
							<th>Sr.No</th>
							<th>Name</th>
							<th>Date</th>
							<th>Comment</th>
							<th>Approve</th>
							<th>Delete</th>
							<th>Details</th>
							</tr>
							<?php
$Connection;
$Query="SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
$Execute=mysqli_query($Connection,$Query);
$SrNo=0;
while($DataRows=mysqli_fetch_array($Execute)){
	$CommentId=$DataRows['id'];
	$DateTimeofComment=$DataRows['datetime'];
	$PersonName=$DataRows['name'];
	$PersonComment=$DataRows['comment'];
	$CommentedPostId=$DataRows['admin_panel_id'];
	$SrNo++;

if(strlen($PersonName) >10) { $PersonName = substr($PersonName, 0, 10).'..';}
if(strlen($DateTimeofComment) >15) { $DateTimeofComment = substr($DateTimeofComment, 0, 15).'..';}
if(strlen($PersonComment) >18) { $PersonComment = substr($PersonComment, 0, 18).'..';}

	


?>
<tr>
	<td><?php echo htmlentities($SrNo); ?></td>
	<td style="color: #5e5eff;"><?php echo htmlentities($PersonName); ?></td>
	<td><?php echo htmlentities($DateTimeofComment); ?></td>
	<td><?php echo htmlentities($PersonComment); ?></td>
	<td><a href="approvecomment.php?id=<?php echo $CommentId; ?>">
	<span class="btn btn-success">Approve</span></a></td>
	<td><a href="DeleteComments.php?id=<?php echo $CommentId;?>">
	<span class="btn btn-danger">Delete</span></a></td>
	<td><a href="FullPost.php?id=<?php echo $CommentedPostId; ?>" target="_blank">
	<span class="btn btn-primary">Live Preview</span></a></td>
</tr>
<?php } ?>			
			
			
		</table>
	</div>
	    <h1>Approved Comments</h1>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
	<tr>
	<th>No.</th>
	<th>Name</th>
	<th>Date & Time</th>
	<th>Comment</th>
	<th>Approved By</th>
	<th>Revert Approval </th>
	<th>Delete Comment</th>
	<th>Details</th>
	</tr>
<?php
$Connection;
$Query="SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
$Execute=mysqli_query($Connection,$Query);
$SrNo=0;
while($DataRows=mysqli_fetch_array($Execute)){
	$CommentId=$DataRows['id'];
	$DateTimeofComment=$DataRows['datetime'];
	$PersonName=$DataRows['name'];
	$PersonComment=$DataRows['comment'];
	$ApprovedBy=$DataRows['approveby'];
	$CommentedPostId=$DataRows['admin_panel_id'];
	$SrNo++;
if(strlen($PersonName) >10) { $PersonName = substr($PersonName, 0, 10).'..';}
if(strlen($DateTimeofComment) >15) { $DateTimeofComment = substr($DateTimeofComment, 0, 15).'..';}
if(strlen($PersonComment) >18) { $PersonComment = substr($PersonComment, 0, 18).'..';}


?>
<tr>
	<td><?php echo htmlentities($SrNo); ?></td>
	<td style="color: #5e5eff;"><?php echo htmlentities($PersonName); ?></td>
	<td><?php echo htmlentities($DateTimeofComment); ?></td>
	<td><?php echo htmlentities($PersonComment); ?></td>
	<td><?php echo htmlentities($ApprovedBy); ?></td>
	<td><a href="disapprovecomment.php?id=<?php echo $CommentId;?>">
	<span class="btn btn-warning">Dis-Approve</span></a></td>
	<td><a href="DeleteComments.php?id=<?php echo $CommentId;?>">
	<span class="btn btn-danger">Delete</span></a></td>
	<td><a href="FullPost.php?id=<?php echo $CommentedPostId; ?>"target="_blank">
	<span class="btn btn-primary">Live Preview</span></a></td>
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