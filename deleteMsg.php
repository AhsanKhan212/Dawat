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

if (isset($_REQUEST['msgid'])) {
	$id = $_REQUEST['msgid'];
	$id = mysqli_real_escape_string($link,$id);

	//getting u name
	$u_name_query = mysqli_query($link,"SELECT * FROM pvt_messages WHERE id='$id'");
	$getuname = mysqli_fetch_assoc($u_name_query);
	$user_to = $getuname['user_to'];
	$user_from = $getuname['user_from'];
	//deleting msg
	if(($user_to == $user) || ($user_from == $user)) {
	$result = mysqli_query($link,"DELETE FROM pvt_messages WHERE id='$id'");
	} else {
	
	}
	
	if ( $user_to == $user) {
		header("location: messages.php?u=$user_from");
	}else {
		header("location: messages.php?u=$user_to");
	}
}else {
	header('location: index.php');
}

?>