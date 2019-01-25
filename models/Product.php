<?php

class Product
{
  private $id;
  private $name;
  private $price;
  private $stock;
  private $amount;

  public function __construct($name, $price, $stock, $id = 0) {
    $this->id = $id;
    $this->name = $name;
    $this->price = $price;
    $this->stock = $stock;
    $this->amount = 0;
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

  public function setAmount($amount){
    $this->amount = $amount;
  }

  public function getAmount(){
    return $this->amount;
  }

  public function getSubTotal(){
    return $this->amount * $this->price;
  }
}
 ?>
