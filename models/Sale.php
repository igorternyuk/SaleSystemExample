<?php

class Sale
{
  private $id;
  private $fecha;
  private $total;

  public function __construct($fecha, $total, $id = 0) {
    $this->id = $id;
    $this->fecha = $fecha;
    $this->total = $total;
  }

  public function getId(){
    return $this->id;
  }

  public function getFecha(){
    return $this->fecha;
  }

  public function getTotal(){
    return $this->total;
  }
}

  ?>
