<?php
  require_once "Connection.php";
  require_once "Product.php";
  require_once "Sale.php";
  require_once "Detail.php";

  class Data
  {
    private $connection;
    public function __construct()
    {
      $this->connection = new Connection("127.0.0.1", "sales", "igor", "1319");
    }

    public function getProducts(){
      $products = array();
      $query = "SELECT * FROM getProducts;";
      $this->connection->connect();
      $resultSet = $this->connection->execute($query);
      if($resultSet->num_rows > 0){
        while($reg = $resultSet->fetch_array()){
          $product = new Product($reg['name'], $reg['price'], $reg['stock'],
           $reg['id']);
           array_push($products, $product);
        }
      }
      $this->connection->disconnect();
      return $products;
    }

    public function getSales(){
      $sales = array();
      $query = "SELECT * FROM getSales;";
      $this->connection->connect();
      $resultSet = $this->connection->execute($query);
      if($resultSet->num_rows > 0){
        while($reg = $resultSet->fetch_array()){
          $sale = new Sale($reg['fecha'], $reg['total'], $reg['id']);
           array_push($sales, $sale);
        }
      }
      $this->connection->disconnect();
      return $sales;
    }

    public function getDetails($saleId){
      $query = "CALL getDetails($saleId);";
      $this->connection->connect();
      $res = $this->connection->execute($query);
      $details = array();
      if($res->num_rows > 0){
        while($reg = $res->fetch_array()){
          $detail = new Detail($reg['id'], $reg['name'], $reg['price'],
                                $reg['amount'], $reg['sub_total']);
          array_push($details, $detail);
        }
      }
      $this->connection->disconnect();
      return $details;
    }

    public function createSale($productList, $total){
      $query = "CALL createSale($total);";
      $this->connection->connect();
      $this->connection->execute($query);
      $this->connection->disconnect();
      foreach ($productList as $product) {
        $this->connection->connect();
        $p = $product->getId();
        $a = $product->getAmount();
        $s = $product->getSubTotal();
        $query = "CALL createDetail($p, $a, $s);";
        $this->connection->execute($query);
        $this->connection->disconnect();
        $this->updateStock($product->getId(), $product->getAmount());
      }
      return count($productList);
    }

    public function updateStock($id, $stockToDiscount){
      $query = "CALL updateStock($id, $stockToDiscount)";
      $this->connection->connect();
      $this->connection->execute($query);
      $this->connection->disconnect();
    }
  }

?>
