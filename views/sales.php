<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require_once "../models/Data.php";
    $data = new Data();
    $sales = $data->getSales();
    echo "<h1>List of sales:</h1>";
    echo "<table border='1'>";
    echo "<tr>";
      echo "<th>ID</th>";
      echo "<th>Date</th>";
      echo "<th>Total</th>";
      echo "<th>Show details</th>";
    echo "</tr>";
    foreach ($sales as $s) {
      echo "<tr>";
        echo "<td>".$s->getID()."</td>";
        echo "<td>".$s->getFecha()."</td>";
        echo "<td>\$".$s->getTotal()."</td>";
        echo "<td><a href='detail.php?id=".$s->getID()."&total=".$s->getTotal()."'>Show details</a></td>";
      echo "</tr>";
    }
    echo "</table>";
    echo "<a href='index.php'>Go back</a>";
    ?>
  </body>
</html>
