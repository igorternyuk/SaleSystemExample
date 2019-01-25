<?php
require_once "../models/Product.php";

$id = $_POST["txtId"];
$name = $_POST["txtName"];
$price = $_POST["txtPrice"];
$stock = $_POST["txtStock"];
$amount = $_POST["amount"];

$product = new Product($name, $price, $stock, $id);
$product->setAmount($amount);

/*echo "<br>id = ".$product->getId();
echo "<br>name = ".$product->getName();
echo "<br>price = ".$product->getPrice();
echo "<br>stock = ".$product->getStock();
echo "<br>amount = ".$product->amount;
echo "<br>SubTotal = ".$product->subTotal;*/

session_start();

$carrito = array();
if(isset($_SESSION["carrito"])){
  $carrito = $_SESSION["carrito"];
}

array_push($carrito, $product);
$_SESSION["carrito"] = $carrito;

header("location: ../views/index.php");
?>
