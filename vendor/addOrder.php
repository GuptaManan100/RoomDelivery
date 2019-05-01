<?php

include('sessionvendor.php');
include('dashboard.php');
echo "<div class=\"main-panel\" style=\"padding-top: 5%;\"> <div align = \"center\">";


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

              if($db->query($query))
              {
                echo "<script> alert('Item Added successfully')</script>";

              }
            }
  }
}

  echo "<form class=\"form-horizontal \" action ='addOrder.php' method='POST'>";
  echo "<div class=\"col-sm\">";
  echo "<input type ='text' placeholder ='Name' name = 'name' >";
  echo "</div>";
  echo "<br>";

  echo "<div class=\"col-sm\">";
  echo "<input type ='text' placeholder ='Product ID' name = 'productID' >";
  echo "</div>";
  echo "<br>";

  echo "<div class=\"col-sm\">";
  echo "<input type ='text' placeholder='Quantity' name = 'quantity' >";
  echo "</div>";
  echo "<br>";

  echo "<div class=\"col-sm\">";
  echo "<input type ='text' placeholder='Price' name = 'price' >";
  echo "</div>";
  echo "<br>";

  echo "<div class=\"col-sm\">";
  echo "<input type = 'submit' style = 'background:#FF9500;color:white;' class='btn btn btn-warning' name = 'add' value = 'Add Item To Stock'> ";
  echo "</div>";
  echo "<br>";

  echo "</form>";
  echo "<h3>";
  echo "<a style = 'color:#FF9500;size;' href='orderList.php'>See All Products</a>";
  echo "</h3>";
echo "</div>";

 ?>
