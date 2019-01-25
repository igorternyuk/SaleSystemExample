<?php

class Detail {
    private $id;
    private $name;
    private $price;
    private $amount;
    private $subTotal;

    public function __construct($id, $name, $price, $amount, $subTotal){
      $this->id = $id;
      $this->name = $name;
      $this->price = $price;
      $this->amount = $amount;
      $this->subTotal = $subTotal;
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

    public function getAmount(){
      return $this->amount;
    }

    public function getSubTotal(){
      return $this->subTotal;
    }
}

 ?>
