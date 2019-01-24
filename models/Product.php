<?php

class Product
{
  private $id;
  private $name;
  private $price;
  private $stock;
  public $amount;
  public $subTotal;

  public function __construct($name, $price, $stock, $id = 0) {
    $this->id = $id;
    $this->name = $name;
    $this->price = $price;
    $this->stock = $stock;
    $this->amount = 0;
    $this->subTotal = 0;
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
