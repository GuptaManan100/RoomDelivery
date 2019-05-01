<?php
	include('sessionvendor.php');

	date_default_timezone_set('Asia/Kolkata');
		echo "<div align='center' class='main-panel' style='padding-top: 5%;'>";
		$sysDate = date("Y-m-d") ." ". date("H:i:s");

		if ($_SERVER["REQUEST_METHOD"] != "POST") {

		echo "<form action ='index.php' method='POST'>
			<input type='radio' name='order' value='daily' id='daily'> Daily
			<input type='radio' checked='checked' name='order' value='monthly' id='monthly'> Monthly
			<input type='radio' name='order' value='period' id='period'> Period
			<input type = 'submit' name = 'type' value ='Submit'>
			<input  type='text' name='date1' id='dateStart' alt='date' class='IP_calendar' title='Y-m-d'>
			<input  type='text' name='date2' id='dateEnd' alt='date' class='IP_calendar' title='Y-m-d'>
		</form>";
	}

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		  	$total=0;

					echo "<form action ='index.php' method='POST'>
						<input type='radio' name='order'";
						if ($_POST['order']=='daily') echo " checked='checked'";
						echo "value='daily' id='daily'> Daily
						<input type='radio' name='order'";
						if ($_POST['order']=='monthly') echo " checked='checked'";
						echo " value='monthly' id='monthly'> Monthly
						<input type='radio' name='order'";
						echo " value='period' id='period'> Period
						<input type = 'submit' name = 'type' value ='Submit'>
						<input  type='text' name='date1' id='dateStart' alt='date' class='IP_calendar' title='Y-m-d'>
						<input  type='text' name='date2' id='dateEnd' alt='date' class='IP_calendar' title='Y-m-d'>
					</form>";

					echo "<h4 class='jumbotron' id='totalAmount'> Total Sale in the Period = Rs.". $total ." </h4>";

			if(isset($_POST['type'])){

				$thisDay = date("d");
				$thisMonth = date("m");

				if($_POST['order'] == 'daily')
				{
					$delivery1 = mktime(0,0,0,$thisMonth,$thisDay,2019);
					$delivery2 = mktime(23,59,59,$thisMonth,$thisDay,2019);
					$deliveryStart = date("Y-m-d", $delivery1) ." ". date("H:i:s",$delivery1);
					$deliveryEnd = date("Y-m-d", $delivery2) ." ". date("H:i:s",$delivery2);
				}

				else if($_POST['order'] == 'monthly')
				{
					$delivery1 = mktime(0,0,0,$thisMonth,1,2019);
					$delivery2 = mktime(23,59,59,$thisMonth,31,2019);
					$deliveryStart = date("Y-m-d", $delivery1) ." ". date("H:i:s",$delivery1);
					$deliveryEnd = date("Y-m-d", $delivery2) ." ". date("H:i:s",$delivery2);
				}

				else if($_POST['order'] == 'period')
				{
					// echo $_POST['date1'];
					// $date=date_create($_POST['date1']);
					// echo date_format($date,"Y/m/d H:i:s");

					$startDate = $_POST['date1'];
					$endDate = $_POST['date2'] ;
					$delivery11 =date_create($startDate);
					$delivery12 =date_create($endDate);
					// echo $delivery12;

 					$deliveryStart = date_format($delivery11,"Y-m-d"). " 00:00:00";
 					$deliveryEnd = date_format($delivery12,"Y-m-d"). " 23:59:59";
					// echo "<br>".$delivery1;
					// $deliveryStart = date("Y-m-d", $_POST['date1']) ;
					// $deliveryEnd = date("Y-m-d", $_POST['date1']) ;
					// echo "!!!!".$deliveryStart;
					// echo "@@".$deliveryEnd;


				}

				$query = "Select * from orders where deliveryTime >= '". $deliveryStart ."' AND deliveryTime<= '"
				.$deliveryEnd."';";
				$result = $db->query($query);
				// echo $query;
				echo "<div class='list-group'>";
				if(mysqli_num_rows($result) > 0 ){
					while( $row =mysqli_fetch_array($result))
					{
						echo "<div class='list-group-item border border-danger' style='border:4px outline black;'>";
							echo "<h4 style='margin-botton:1%;' >OrderID = ".$row['orderID'].
							"</h4><span >CustomerID = ". $row['customerID']."</span><br>";

							$query3 = "Select * from users where enrollnum ='".$row['customerID']."'";
							$result3 = $db->query($query3);
							if(mysqli_num_rows($result3) > 0 ){
								while( $row3 =mysqli_fetch_array($result3))
								{
										echo "<span >" . $row3['firstname'] ." ". $row3['lastname'] . "</span><br>";
								}
							}
							//dsasd


							$total += $row['amount'];
							echo "<span >Amount = ". $row['amount']."</span><br>";

								//Asia
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
													echo "<span >". $row2['name'] ." : </span>";
												}
											}

											echo "<span >" . $row1['quantity'] . "</span><br>";

									}
								}
								//dsasd


						echo "<span>Delivery Time = ". $row['deliveryTime'];
						echo "</span></div>";
						echo "<br>";

					}

					//echo "<h4 class='jumbotron'> Total Sale in the Period = Rs.". $total ." </h4>";

						  /*$('#period').click(function(){
						    $("#dateStart").show();
						    $("#dateEnd").show();
						  });*/


					//echo "<script> $('#totalAmount').html('Sale in the Period = Rs');</script>";
					echo "<script> document.getElementById('totalAmount').innerHTML='Sale in the Period = Rs.$total';</script>";

				}

				else {
					echo "No orders available";
				}
			}}
			echo "</div>";

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
