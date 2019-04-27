<?php
   include('sessionuser.php');
   include('dashboard.php');
   echo "<div class=\"main-panel\" style=\"padding-top: 5%;\"> <div align = \"center\">";

   //post method sent from html
   if($_SERVER["REQUEST_METHOD"]=="POST")
   {
   	  date_default_timezone_set('Asia/Kolkata');
      $sql = "SELECT name,quantity,price,productCode FROM products;";
      $result = $db->query($sql);
      $items = array();
      $prices = array();
      $codes = array();
      $isprep=0;
      $amount=0;
      while($row = $result->fetch_assoc()) {
        $items[$row["name"]] = $row["quantity"];
        $prices[$row["name"]] = $row["price"];
        $codes[$row["name"]] = $row["productCode"];
      }
   		foreach( $_POST as $stuff => $val )
      {
        if($stuff!="Location" && $items[str_replace("_"," ",$stuff)]<$val)
        {
          $_SESSION["error_order"] = str_replace("_"," ",$stuff);
          header("Location: ./placeorder.php");
          die();
        }
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
          $db->query($sql);
        }
        $amount+=$prices[str_replace("_"," ",$stuff)]*$val;
      }
      $timeorder = date("Y-m-d H:i:s");
      $isprep += 2;
      $deliverTime = date('Y-m-d H:i:s',strtotime("+$isprep minutes",strtotime($timeorder)));
      $sql = "INSERT INTO orders VALUES (null,'".$_SESSION['enrollnum']."','".$_SESSION['isStudent']."','".$_POST['Location']."',".$amount.",'".$timeorder."','".$deliverTime."');";
      $result = $db->query($sql);
      if($result)
      {
        $last_id = mysqli_insert_id($db);
        echo "<div id=\"print-content\">";
        echo "OrderID = $last_id<br>";
        echo "CustomerID = ".$_SESSION['enrollnum']."<br>";
        echo "Order Time = $timeorder<br>";
        foreach( $_POST as $stuff => $val )
        {
          if($stuff=="Location")
          {
            continue;
          }
          else if($val>0)
          {
            $sql = "INSERT INTO orderDetails VALUES (null,'".$last_id."','".$codes[str_replace("_"," ",$stuff)]."','".$val."');";
            echo str_replace("_"," ",$stuff)."   -   $val<br>";
            $db->query($sql);
          }
        }
        echo "Amount = Rs.$amount<br>";
        echo "Delivery Time = $deliverTime<br>";
        echo "</div>";
        echo "<input type=\"button\" onclick=\"printDiv('print-content')\" value=\"Print Order\" class = \"btn btn-primary\"/>";
      }
      else
      {
        header("Location: ./placeorder.php");
      }
   }
   else
   {
      header("Location: ../users/");
   }

  echo "</div>";
  echo "</div>";
?>

<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        w=window.open();
        w.document.write(printContents);
        w.print();
        w.close();
    }
</script>