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
 //showmore for profile home post
 $profilehmlastid = $_REQUEST['profilehmlastid'];
 if (isset($profilehmlastid)) {
 	$profilehmlastid = $_REQUEST['profilehmlastid'];
 }else {
 	header("location: index.php");
 }
 if ($profilehmlastid >= 1) {
 			//getting username
		 $result = mysqli_query($link,"SELECT * FROM posts WHERE id ='$profilehmlastid'") or die(mysqli_error());
		 $name = mysqli_fetch_assoc($result);
		 $profilehm_uname = $name['user_posted_to'];
		//timeline query table
		$getposts = mysqli_query($link,"SELECT * FROM posts WHERE user_posted_to ='$profilehm_uname' AND note='0' AND report='0' AND id < $profilehmlastid ORDER BY id DESC LIMIT 12") or die(mysqli_error());
		if (mysqli_num_rows($getposts)) {
			while ($row = mysqli_fetch_assoc($getposts)) {
			include ( "./inc/newsfeed.inc.php" );
			$profilehmlastvalue = $row['id'];
		}
			if(mysqli_num_rows($getposts) >= '1' ) {
			echo '<li class="profilehmmore" id="'.$profilehmlastvalue.'" >Show More</li>';
			}
		}else {
			echo '<li class="nomorepost">Opps! Nothing more found.</li>';
	}
 }
?>