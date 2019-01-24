<?php
  require_once "Connection.php";
  require_once "Product.php";

  class Data
  {
    private $connection;
    public function __construct()
    {
      $this->connection = new Connection("localhost", "sales", "igor", "1319");
    }

    public function getProducts(){
      $products = array();
      $query = "select * from product;";
      $resultSet = $this->connection->execute($query);
      if($resultSet->num_rows > 0){
        while($reg = $resultSet->fetch_array()){
          $product = new Product($reg['name'], $reg['price'], $reg['stock'],
           $reg['id']);
           array_push($products, $product);
        }
      }
      return $products;
    }
  }

?>
