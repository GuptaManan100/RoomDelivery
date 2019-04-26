<?php
	include('../session.php');
	/*$checkUser = $_SESSION['login_user'];
	$sqlCheck = "select webmail from users where username = '$checkUser';";
	$result = $db->query($sqlCheck);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$login_session = $row['webmail'];*/

	if($_SESSION['login_user']!='vendor'){
    	header("Location: /roomDelivery/users/");
    	die();
   	}
?>