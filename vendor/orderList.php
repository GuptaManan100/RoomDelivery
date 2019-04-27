<?php

	include('sessionvendor.php');

	$query = "Select * from products ";
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
						 values (".$_POST["productID"]." , ". $_POST["Quantity"] .") ";
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
			if( isset($_POST['clicked'] ))
			{
					$query_2 =  "Update products
		      set quantity = '" .$_REQUEST["quantity"].
		      "' ,price = '".$_POST["price"].
		      "' , name = '".$_POST["name"].
		      "' WHERE productCode = '".key($_POST['clicked'])."' ";
		      echo $query_2;
					if ($db->query($query_2))
					{
						echo "Updated successfully!!";
						header("Refresh:0");
					}
				}

				else {
					$query_2 =  "Delete from products WHERE productCode = '".key($_POST['deleted'])."' ";
		      // echo $query_2;
					if ($db->query($query_2))
					{
						echo "Deleted successfully!!";
						header("Refresh:0");
					}

				}
		}
}



//
//
//
  $result = $db->query($query);

//
//
//







$i=0;
if(mysqli_num_rows($result) > 0 ){
  echo "<div>";
  while( $row =mysqli_fetch_array($result))
	{
    echo "<form method ='POST' action ='orderList.php'>";

    echo " <span>Product ID : </span>".$row['productCode'];

    echo " <span>Quantity in stock : </span>".
    "<input type = 'text' value= ' ".$row['quantity']."' name= 'quantity' id='quantity'>";

    echo " <span>Price of the item : </span>".
    "<input type = 'text' value= ' ".$row['price']."' name= 'price'>";

    echo " <span>Name of item : </span>".
    "<input type = 'text' value= ' ".$row['name']."' name = 'name'>";
     echo "<input type='submit'
		 name='clicked[" .$row['productCode']."]'
		 value='Update'>
		 <input type='submit'
		 name='deleted[" .$row['productCode']."]'
		 value='Delete'>
  	</form><br>";
		 $i = $i+1;
	}
	echo "</div>";
}

echo "<form action ='addOrder.php' method = 'GET' >
<input type='submit' name='addProduct' value='Add a Product'>
</form>";

?>
