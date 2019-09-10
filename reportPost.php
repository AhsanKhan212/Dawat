<?php include ( "./inc/connect.inc.php"); ?>
<?php  
$link = mysqli_connect("localhost", "root", "","daowat_db");


ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header('location: signin.php');
}
else {
	$user = $_SESSION['user_login'];
}

if (isset($_REQUEST['pid'])) {
	$id = $_REQUEST['pid'];

	//reporting post
	$result = mysqli_query($link,"UPDATE posts SET report='1' WHERE id='$id'");
	header("location: newsfeed.php");
}else {
	header('location: index.php');
}

?>