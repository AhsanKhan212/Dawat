<?php 
$link = mysqli_connect("localhost", "root", "","daowat_db");

 include ( "inc/connect.inc.php");
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header('location: signin.php');
}
else {
	$user = $_SESSION['user_login'];
}
 //showmore for profile home post
 $daowathmlastid = $_REQUEST['daowathmlastid'];
 if (isset($daowathmlastid)) {
 	$daowathmlastid = $_REQUEST['daowathmlastid'];
 }else {
 	header("location: index.php");
 }
 if ($daowathmlastid >= 1) {
 			//getting username
		 $result = mysqli_query($link,"SELECT * FROM posts WHERE id ='$daowathmlastid'") or die(mysqli_error());
		 $name = mysqli_fetch_assoc($result);
		 $username = $name['added_by'];
		//timeline query table
		$getposts = mysqli_query($link,"SELECT * FROM daowat WHERE added_by ='$username' AND daowat_give !='0' AND id < $daowathmlastid ORDER BY id DESC LIMIT 7") or die(mysqli_error());
		if (mysqli_num_rows($getposts)) {
			while ($row = mysqli_fetch_assoc($getposts)) {
			include ( "./inc/newsfeed.inc.php" );
			$daowathmlastvalue = $row['id'];
		}
			echo '<br><li class="getmore" id="'.$daowathmlastvalue.'" >Show More</li>';
		}else {
			echo '<li class="nomorepost">Opps! Nothing more found.</li>';
	}
 }
?>