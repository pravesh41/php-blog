<?php require_once("include/db.php") ?>
<?php require_once("include/session.php") ?>
<?php require_once("include/function.php") ?>

<?php
if(isset($_GET['id'])){
    $IdFromURL=$_GET['id'];
    $Connection;
    $Admin=$_SESSION["Username"];
$Query="UPDATE comments SET status='ON' AND approveby='$Admin' WHERE id='$IdFromURL' ";
$Execute=mysqli_query($Connection,$Query);
if($Execute){
	$_SESSION["SuccessMessage"]="Comment Approved Successfully";
	Redirect_to("comments.php");
	}else{
	$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
	Redirect_to("comments.php");
		
	}
    
    
    
    
    
}

?>