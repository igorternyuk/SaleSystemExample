<?php
  require_once "../models/Data.php";
  $data = new Data();
  $productList = $data->getProducts();
  foreach ($productList as $p) {
    echo "<br>";
    echo $p->getId().") ".$p->getName().' $'.$p->getPrice()." ".$p->getStock();
    echo "</br>";
  }
?>
