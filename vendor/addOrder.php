<?php

include('sessionvendor.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["productID"])) {
    echo "<script> alert('Product ID must be filled')</script>";
  }

  else if ( empty($_POST["name"]) )
  {
    echo "<script> alert('Name must be filled')</script>";
  }

  else if ( empty($_POST["quantity"]) )
  {
    echo "<script> alert('Quantity must be filled')</script>";
  }

  else if ( empty($_POST["price"]) )
  {
    echo "<script> alert('Price must be filled')</script>";
  }

  else {
          echo $_POST["productID"];

          $query_4 = 'Select name from products where productCode = '.$_POST["productID"].';';
          $result_4 = $db->query($query_4);
          if(mysqli_num_rows($result_4) > 0 )
          {
            echo "<script> alert('A product with the same id already exists.')</script>";
          }
          else {
              $query = "Insert into products values (
                '".$_POST['productID']."',
                '".$_POST['name']."',
                '".$_POST['quantity']."',
                '".$_POST['price']."'
              ); ";

              echo $query;

              if($db->query($query))
              {
                echo "<script> alert('Item Added successfully')</script>";

              }
            }
  }
}

  echo "<form action ='addOrder.php' method='POST'>";
  echo "<input type ='text' placeholder ='Name' name = 'name' >";
  echo "<input type ='text' placeholder ='Product ID' name = 'productID' >";
  echo "<input type ='text' placeholder='Quantity' name = 'quantity' >";
  echo "<input type ='text' placeholder='Price' name = 'price' >";
  echo "<input type = 'submit' name = 'add' value = 'Add Item To Stock'> ";
  echo "</form>";
  echo "<a href='orderList.php'>See All Products</a>"
 ?>
