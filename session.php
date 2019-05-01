<?php
	include('mysqlConfig.php');
	session_start();
	/*$checkUser = $_SESSION['login_user'];
	$sqlCheck = "select webmail from users where username = '$checkUser';";
	$result = $db->query($sqlCheck);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$login_session = $row['webmail'];*/

	if(!isset($_SESSION['login_user'])){
    	header("Location: /roomDelivery/login/");
    	die();
   	}
?>