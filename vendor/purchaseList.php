<?php 
	
	include('sessionvendor.php');

	$query = "Select productCode, quantityToBuy from shopList ";
	$result = $db->query($query);

	echo "<div>";

if(mysqli_num_rows($result) > 0 ){
	while( $row =mysqli_fetch_array($result))
	{

		$query_1 = "Select name FROM products WHERE productCode = '". $row['productCode']. "'; ";
    	$result_1 = $db->query($query_1);
    	if(  mysqli_num_rows($result_1)>0)
    	{
    		while($row_1 = mysqli_fetch_array($result_1)) {
				echo "<span>Product Name :" .  strval($row_1['name']) ."</span>";

    		}
    
    	}
    		

		// echo "sa";
		 echo " <span>Quantity to buy : </span>".
		 "<input type = 'text' value= ' ".$row['quantityToBuy']." '>".
		  " <button type='button'>Click Me!</button> <br>";


	}
	echo "</div>";

}

?>

