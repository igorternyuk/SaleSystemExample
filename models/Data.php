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
      $query = "SELECT * FROM product;";
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
      $query = "SELECT * FROM sale;";
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
      $query = "SELECT d.id, p.name, p.price, d.amount, d.sub_total FROM detail d,
       product p WHERE d.sale_id = $saleId AND p.id = d.product_id;";
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
      $query = "INSERT INTO sale VALUES(null, now(), $total);";
      $this->connection->connect();
      $this->connection->execute($query);
      $query = "SELECT max(id) FROM sale;";
      $res = $this->connection->execute($query);
      $this->connection->disconnect();
      $lastSaleId = 0;
      if($reg = $res->fetch_array()){
        $lastSaleId = $reg[0];
      }
      foreach ($productList as $product) {
        $this->connection->connect();
        $query = "INSERT INTO detail VALUES(null, '".$lastSaleId."',
         '".$product->getId()."',
         '".$product->getAmount()."',
         '".$product->getSubTotal()."');";
         $this->connection->execute($query);
         $this->connection->disconnect();
         $this->updateStock($product->getId(), $product->getAmount());
      }
      return count($productList);
    }

    public function updateStock($id, $stockToDiscount){
      $query = "SELECT stock FROM product WHERE id = $id;";
      $this->connection->connect();
      $res = $this->connection->execute($query);
      $currStock = 0;
      if($reg = $res->fetch_array()){
        $currStock = $reg[0];
      }
      $currStock -= $stockToDiscount;
      $query = "UPDATE product SET stock = $currStock WHERE id = $id;";
      $this->connection->execute($query);
      $this->connection->disconnect();
    }
  }

?>
