<?php
	include('sessionvendor.php');

	date_default_timezone_set('Asia/Kolkata');
		echo "<div align='center' class=\"main-panel\" style=\"padding-top: 5%;\"> ";

		$sysDate = date("Y-m-d") ." ". date("H:i:s");

				$thisDay = date("d");
				$thisMonth = date("m");

				$query = "Select * from orders where deliveryTime >= '". $sysDate ."'";
				$result = $db->query($query);
				if(mysqli_num_rows($result) > 0 ){
					echo "<div class='list-group'>";
					while( $row =mysqli_fetch_array($result))
					{
						echo "<div class='list-group-item'>";
						echo "<h4 style='margin-botton:1%;' >OrderID = ".$row['orderID'].
						"</h4><span >CustomerID = ". $row['customerID']."</span><br>";

							$query3 = "Select * from users where enrollnum ='".$row['customerID']."'";
							$result3 = $db->query($query3);
							if(mysqli_num_rows($result3) > 0 ){
								while( $row3 =mysqli_fetch_array($result3))
								{
										echo "<span>" . $row3['firstname'] ." ". $row3['lastname'] . "</span><br>";
								}
							}
							echo "Amount = ". $row['amount']."<br>";
								$query1 = "Select * from orderDetails where orderID =".$row['orderID'];
								$result1 = $db->query($query1);
								if(mysqli_num_rows($result1) > 0 ){
									while( $row1 =mysqli_fetch_array($result1))
									{
											$query2 = "Select * from products where productCode =".$row1['productCode'];
											$result2 = $db->query($query2);
											if(mysqli_num_rows($result2) > 0 ){
												while( $row2 =mysqli_fetch_array($result2))
												{
													echo "<span>". $row2['name'] ." : </span>";
												}
											}

											echo "<span>" . $row1['quantity'] . "</span><br>";
									}
								}

						echo "Delivery Time = ". $row['deliveryTime'];
						echo "</div>";
						echo "<br>";

					}
					echo "</div>";
				}

				else {
					echo "<h4 style='' class='jumbotron'>No orders available</h4>";
				}

		echo "</div>";

?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
	$(document).ready(function(){

		$("#dateStart").hide();
		$("#dateEnd").hide();

	  $('#period').click(function(){
	    $("#dateStart").show();
	    $("#dateEnd").show();
	  });

	  $('#monthly').click(function(){
	    $("#dateStart").hide();
	    $("#dateEnd").hide();
	  });

	  $('#daily').click(function(){
	    $("#dateStart").hide();
	    $("#dateEnd").hide();
	  });


	});
	</script>

	<script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js">
	</script>
	<title></title>
</head>
<body>
	<?php include('dashboard.php');?>
	<div class="main-panel" style="padding-top: 5%;">

	</div>
</body>
</html>
