<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      require_once "../models/Data.php";
      $saleID = $_GET["id"];
      $saleTotal = $_GET["total"];
      $data = new Data();
      $details = $data->getDetails($saleID);
      echo "<h1>Details of sale ID: $saleID</h1>";
      echo "<table border='1'>";
        echo "<tr>";
          echo "<th>ID</th>";
          echo "<th>Product</th>";
          echo "<th>Amount</th>";
          echo "<th>Subtotal</th>";
        echo "</tr>";
        foreach ($details as $det) {
          echo "<tr>";
            echo "<td>".$det->getId()."</td>";
            echo "<td>".$det->getName()."</td>";
            echo "<td>".$det->getAmount()." x \$".$det->getPrice()."</td>";
            echo "<td>\$".$det->getSubTotal()."</td>";
          echo "</tr>";
        }
        echo "<tr>";
          echo "<th colspan='3'>Total</th>";
          echo "<th>\$".$saleTotal."</th>";
        echo "</tr>";
      echo "</table>";
    ?>
    <a href='sales.php'>Go back to the sales</a>
    <br>
    <a href='index.php'>Main page</a>
  </body>
</html>
