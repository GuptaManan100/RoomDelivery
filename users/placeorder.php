<?php
  include('sessionuser.php');
  $sql = "Select name,quantity FROM products;";
  $result = $db->query($sql);
  $items = array();
  if(isset($_GET['Error']))
  {
    echo "<h2>Quantity ordered of ".$_GET['Error']," is more than available!</h2>";
  }
  echo "<h2 id = \"error\"></h2>";
  echo "<form action=\"/roomDelivery/users/completeorder.php\" method=\"POST\" onsubmit=\"return validate()\">";
  while($row = $result->fetch_assoc()) {
    echo "<label>".$row["name"]."  </label>";
    echo "<input type=\"number\" min=\"0\" max=\"".$row["quantity"]."\"name=\"" .$row["name"]. "\" value=\"0\" class=\"quantity\"/> <br>";
    $items[$row["name"]] = $row["quantity"];
    //echo "Name=" . $row["name"] . ", Value=" . $row["quantity"];
    //echo "<br>";
  }
  echo "<label>Delivery Location:  </label>";
  echo "<input type=\"text\" name=\"Location\" value=\"".$_SESSION['preferedLocation'] ."\"><br>";
  echo "<input type=\"submit\" value=\"Place Order\">";
  echo "</form>";

?>

<script>
      function validate() {
        document.getElementById("error").innerHTML = ""
        var elements = document.getElementsByClassName("quantity")
        var isempty = 1;
        for (var i = 0; i < elements.length; i++) {
          if(elements[i].value > 0) {
            isempty = 0;
          }
        }
        if(isempty===1)
        {
          document.getElementById("error").innerHTML = "Order atleast 1 item"
          return false
        }
        else
          return true
      }
</script>

