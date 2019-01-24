<?php

$index = $_GET["in"];

session_start();
if(isset($_SESSION["carrito"])){
  $carrito = $_SESSION["carrito"];
  unset($carrito[$index]);
  $_SESSION["carrito"] = $carrito;
}
header("location: ../views/index.php");
?>
