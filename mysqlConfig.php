<?php
	ini_set('display_errors', 1);
	$username="root";
	$password="";
	$host="localhost";
	$database="roomDelivery";
	$db = mysqli_connect("$host","$username","$password","$database");
   	if(!$db)
   	{
     	echo 'Please check your connection'.mysql_error();
   	}
?>