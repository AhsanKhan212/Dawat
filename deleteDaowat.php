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

if (isset($_REQUEST['did'])) {
	$id = $_REQUEST['did'];
	//delete from directory
	$get_file = mysqli_query($link,"SELECT * FROM daowat WHERE id='$id'");
	$get_file_name = mysqli_fetch_assoc($get_file);
	$db_filename = $get_file_name['photos'];
	$db_user_name = $get_file_name['added_by'];
	if($db_user_name == $user) {
		$delete_file = unlink("http://www.daowat.com/userdata/daowat_pics/".$db_filename);
		//delete post
		$result1 = mysqli_query($link,"DELETE FROM dwt_likes WHERE dwt_id='$id'");
		$result = mysqli_query($link,"DELETE FROM daowat WHERE id='$id'");
		header("location: daowat.php?u=$user");
	}else {
		header("location: daowat.php?u=$user");
	}
}else {
	header('location: index.php');
}

?>