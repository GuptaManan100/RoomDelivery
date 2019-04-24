<?php
   include('sessionuser.php');

   //post method sent from html
   if($_SERVER["REQUEST_METHOD"]=="POST")
   {
      $sql = "SELECT name,quantity,price FROM products;";
      $result = $db->query($sql);
      $items = array();
      $prices = array();
      $isprep=0;
      $amount=0;
      while($row = $result->fetch_assoc()) {
        $items[$row["name"]] = $row["quantity"];
        $prices[$row["name"]] = $row["price"];
      }
   		foreach( $_POST as $stuff => $val )
      {
        if($stuff!="Location" && $items[str_replace("_"," ",$stuff)]<$val)
          header("Location: ./placeorder.php/?Error=$stuff");
      }
      foreach( $_POST as $stuff => $val )
      {
        if($stuff=="Location")
        {
          continue;
        }
        else if($stuff=="Tea"||$stuff=="Coffee")
        {
          if($val>0)
            $isprep = 1;
        }
        else
        {
          $items[str_replace("_"," ",$stuff)]-=$val;
          $sql = "UPDATE products SET quantity = ".$items[str_replace("_"," ",$stuff)]." WHERE name = '".str_replace("_"," ",$stuff)."';";
          //echo $sql;
          $db->query($sql);
        }
        $amount+=$prices[str_replace("_"," ",$stuff)]*$val;
      }

      echo $isprep;
   }
   else
   {
      header("Location: ../users/");
   }
?>