<?php
require_once "../models/Data.php";

$id = $_POST["txtId"];
$name = $_POST["txtName"];
$price = $_POST["txtPrice"];
$stock = $_POST["txtStock"];
$amount = $_POST["amount"];

if($amount <= 0){
  header("location: ../views/index.php?message=1");
} else {
  $product = new Product($name, $price, $stock, $id);
  $product->setAmount($amount);

  $data = new Data();

  session_start();
  $carrito = array();
  if(isset($_SESSION["carrito"])){
    $carrito = $_SESSION["carrito"];
  }

  $totalAmount = 0;
  foreach ($carrito as $p) {
    if($p->getId() == $id){
        $totalAmount += $p->getAmount();
    }
  }
  $totalAmount += $amount;
  echo "<br>totalAmount = $totalAmount</br>";
  echo "<br>stock = $stock</br>";
  if($product->getStock() >= $totalAmount){
    array_push($carrito, $product);
    $_SESSION["carrito"] = $carrito;
  } else {
      header("location: ../views/index.php?message=2");
  }
  header("location: ../views/index.php");
}
?>
