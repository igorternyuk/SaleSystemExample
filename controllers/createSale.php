<?php
  require_once "../models/Data.php";
  session_start();
  if(isset($_SESSION["carrito"]) && isset($_SESSION["total"])){
      $carrito = $_SESSION["carrito"];
      $total = $_SESSION["total"];
      $data = new Data();
      $data->createSale($carrito, $total);

      unset($_SESSION["carrito"]);
      unset($_SESSION["total"]);
  }
  header("location: ../views/index.php");

  ?>
