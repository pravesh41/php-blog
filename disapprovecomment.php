<?php require_once("include/db.php") ?>
<?php require_once("include/session.php") ?>
<?php require_once("include/function.php") ?>
<?php
if(isset($_GET['id'])){
    $IdFromURL=$_GET['id'];
    $Connection;
    $Admin="Ram";
$Query="UPDATE comments SET status='OFF' WHERE id='$IdFromURL' ";
$Execute=mysqli_query($Connection,$Query);
if($Execute){
	$_SESSION["SuccessMessage"]="Comment Dis-Approved Successfully";
	Redirect_to("comments.php");
	}else{
	$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
	Redirect_to("comments.php");
		
	}
    
    
    
    
    
}

?>