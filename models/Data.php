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

    public function createSale($productList, $total){
      $query = "insert into sale values(null, now(), $total);";
      $this->connection->execute($query);
      $query = "select max(id) from sale;";
      $res = $this->connection->execute($query);
      $lastSaleId = 0;
      if($reg = $res->fetch_array()){
        $lastSaleId = $reg[0];
      }
      foreach ($productList as $product) {
        /*
        id int auto_increment,
        sale_id int,
        product_id int,
        amount int,
        sub_total int,
        */
        $query = "insert into detail values(null, '".$lastSaleId."',
         '".$product->getId()."',
         '".$product->getAmount()."',
         '".$product->getSubTotal()."');";
         $this->connection->execute($query);
      }
    }
  }

?>
