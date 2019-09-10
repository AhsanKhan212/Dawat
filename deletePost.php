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
	//delete from directory
	$get_file = mysqli_query($link,"SELECT * FROM posts WHERE id='$id'");
	$get_file_name = mysqli_fetch_assoc($get_file);
	$db_filename = $get_file_name['photos'];
	$db_username = $get_file_name['added_by'];
	if($db_username == $user) {
		$delete_file = unlink("./userdata/profile_pics/".$db_filename);
		//delete post
		$result = mysqli_query($link,"DELETE FROM post_likes WHERE post_id='$id'");
		$result = mysqli_query($link,"DELETE FROM posts WHERE id='$id'");
		header("location: profile.php?u=$user");
	}else {
		header('location: index.php');
	}
	
}else {
	header('location: index.php');
}

?>