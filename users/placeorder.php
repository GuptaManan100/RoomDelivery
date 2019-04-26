<?php
  include('sessionuser.php');
  include('dashboard.php');
  echo "<div class=\"main-panel\" style=\"padding-top: 5%;\"> <div align = \"center\">";
  $sql = "Select name,quantity FROM products;";
  $result = $db->query($sql);
  $items = array();
  if(isset($_GET['Error']))
  {
    echo "<h2>Quantity ordered of ".$_GET['Error']," is more than available!</h2>";
  }
  echo "<h2 id = \"error\"></h2>";
  echo "<form class=\"form-horizontal \" action=\"/roomDelivery/users/completeorder.php\" method=\"POST\" onsubmit=\"return validate()\">";
  while($row = $result->fetch_assoc()) {
    echo "<div class=\"form-group\">";
    echo "<label  class=\"col-sm-4 col-sm-4 control-label\">".$row["name"]."  </label>";
    echo "<div class=\"col-sm-4\">";
    echo "<input  class=\"form-control quantity\" type=\"number\" min=\"0\" max=\"".$row["quantity"]."\"name=\"" .$row["name"]. "\" value=\"0\"/>";
    echo "</div>";
    echo "</div>";
    $items[$row["name"]] = $row["quantity"];
    //echo "Name=" . $row["name"] . ", Value=" . $row["quantity"];
    //echo "<br>";
  }
  echo "<div class=\"form-group\">";
  echo "<label class=\"col-sm-4 col-sm-4 control-label\">Delivery Location:</label>";
  echo "<div class=\"col-sm-4\">";
  echo "<input class=\"form-control\" type=\"text\" name=\"Location\" value=\"".$_SESSION['preferedLocation'] ."\"><br>";
  echo "</div>";
  echo "</div>";

  echo "<input type=\"submit\" value=\"Place Order\" class=\"btn btn-primary\">";
  echo "</form>";
  echo "</div>";
  echo "</div>";

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

