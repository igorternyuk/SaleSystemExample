<?php

class Product
{
  private $id;
  private $name;
  private $price;
  private $stock;

  public function __construct($name, $price, $stock, $id = null) {
    $this->id = $id;
    $this->name = $name;
    $this->price = $price;
    $this->stock = $stock;
  }

  public function getId(){
    return $this->id;
  }

  public function getName(){
    return $this->name;
  }

  public function getPrice(){
    return $this->price;
  }

  public function getStock(){
    return $this->stock;
  }
}


 ?>
