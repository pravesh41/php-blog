<?php require_once("include/db.php") ?>
<?php require_once("include/session.php") ?>
<?php require_once("include/function.php") ?>
<?php Confirm_Login() ?>
<?php
if(isset($_GET["id"])){
    $IdFromURL=$_GET["id"];
    $Connection;
$Query="DELETE FROM registration WHERE id='$IdFromURL' ";
$Execute=mysqli_query($Connection,$Query);
if($Execute){
	$_SESSION["SuccessMessage"]="Admin Deleted Successfully";
	Redirect_to("Admins.php");
	}else{
	$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
	Redirect_to("Admins.php");
		
	}
    
    
    
    
    
}

?>