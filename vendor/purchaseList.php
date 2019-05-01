<?php

	include('sessionvendor.php');
	include('dashboard.php');
  	echo "<div class=\"main-panel\" style=\"padding-top: 5%;\">";

	$query = "Select productCode, quantityToBuy from shopList ";
	$result = $db->query($query);


	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if(isset($_POST['add'])){

			if (empty($_POST["productID"])) {
				echo "id to bhar chutiye";
			}

			else if ( empty($_POST["Quantity"]) )
			{
				echo "quantity to bhar chutiye";
			}

			else {
				echo $_POST["Quantity"];
				echo $_POST["productID"];

				$query_4 = 'Select name from products where productCode = '.$_POST["productID"].';';
				$result_4 = $db->query($query_4);
				if(mysqli_num_rows($result_4) == 0 )
				{
					echo "Such an item does not exist. Sorry madafakka!!";
				}
				else if( mysqli_num_rows($result_4) == 1 )
				{
						$query_5 = "Select name FROM products WHERE productCode = '". $_POST["productID"]. "'; ";
						$result_5 = $db->query($query_5);
						if(  mysqli_num_rows($result_5)>0)
						{
							while($row_5 = mysqli_fetch_array($result_5)) {
							  	$productName = strval($row_5['name']) ;
							}
						}

					 if( $productName == 'Tea' || $productName == 'Coffee')
					 {
						 echo "chutiya hai key";
						 header("Refresh:0");
					 }

					 else {

						 $query_3 = "Insert into shopList (productCode , quantityToBuy)
						 values (" . $_POST["productID"] ." , ". $_POST["Quantity"] .") ";
						 if($db->query($query_3))
						 {
							 echo "Added succesfully!!";
							 header("Refresh:0");

						}
					 }
			 }
			}
		}

		else {
			echo key($_POST['clicked']);
			$query_2 =  "DELETE FROM shopList WHERE productCode = '" . key($_POST['clicked']) . "' ";
			if ($db->query($query_2))
			{
				echo "Deleted successfully!!";
				header("Refresh:0");
			}
		}
}

$i=0;
if(mysqli_num_rows($result) > 0 ){
	while( $row =mysqli_fetch_array($result))
	{
		$prodname="";
		$query_1 = "Select name FROM products WHERE productCode = '". $row['productCode']. "'; ";
    	$result_1 = $db->query($query_1);
    	if(  mysqli_num_rows($result_1)>0)
    	{
    		while($row_1 = mysqli_fetch_array($result_1)) {
				echo "<span>Product Name :" .  strval($row_1['name']) ."</span>";
				$prodname = strval($row_1['name']);
    		}
    	}

		// echo "sa";
		 echo " <span>Quantity to buy : </span>".
		 "<input type = 'text' value= ' ".$row['quantityToBuy']." '>";
		 echo  "<form method = 'POST' action = 'purchaseList.php'>";
     echo "<input type='submit'
		 name='clicked[" .$row['productCode']."]'
		 value='Submit'>
		   </form><br>";
		 $i = $i+1;
	}
}

echo "<div>";
echo "<form method = 'POST' action = 'purchaseList.php' > ";
echo "<input type ='text' placeholder ='Product ID' name = 'productID' >";
echo "<input type ='text' placeholder='Quantity' name = 'Quantity' >";
echo "<input type = 'submit' name = 'add' value = 'Add Item'> ";
echo "</form>";
echo "</div>";


echo "</div>";
?>
