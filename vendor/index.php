<?php
	include('sessionvendor.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php include('dashboard.php');?>
	<div class="main-panel" style="padding-top: 5%;">
		You are the vendor
		<br>
		<h2><a href = "logout.php">Sign Out</a></h2>
		<a href= "purchaseList.php">Purchase List</a>
		<a href= "orderList.php">Orders</a>
	</div>
</body>
</html>
