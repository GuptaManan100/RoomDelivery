<?php
	include('session.php');

	if($_SESSION['login_user']=='vendor')
	{
		header("Location: ./vendor/");
	}
	else
	{
		header("Location: ./users/");
	}
?>