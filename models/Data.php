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

    public function getSales(){
      $sales = array();
      $query = "select * from sale;";
      $resultSet = $this->connection->execute($query);
      if($resultSet->num_rows > 0){
        while($reg = $resultSet->fetch_array()){
          $sale = new Sale($reg['fecha'], $reg['total'], $reg['id']);
           array_push($sales, $sale);
        }
      }
      return $sales;
    }

    public function getDetails($saleId){
      $query = "select d.id, p.name, p.price, d.amount, d.sub_total from detail d,
       product p where d.sale_id = $saleId and p.id = d.product_id;";
      $res = $this->connection->execute($query);
      $details = array();
      if($res->num_rows > 0){
        while($reg = $res->fetch_array()){
          $detail = new Detail($reg['id'], $reg['name'], $reg['price'],
                                $reg['amount'], $reg['sub_total']);
          array_push($details, $detail);
        }
      }

      return $details;
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
        $query = "insert into detail values(null, '".$lastSaleId."',
         '".$product->getId()."',
         '".$product->getAmount()."',
         '".$product->getSubTotal()."');";
         $this->connection->execute($query);
         $this->updateStock($product->getId(), $product->getAmount());
      }
    }

    public function updateStock($id, $stockToDiscount){
      $query = "select stock from product where id = $id;";
      $res = $this->connection->execute($query);
      $currStock = 0;
      if($reg = $res->fetch_array()){
        $currStock = $reg[0];
      }
      $currStock -= $stockToDiscount;
      $query = "update product set stock = $currStock where id = $id;";
      $this->connection->execute($query);
    }
  }

?>
