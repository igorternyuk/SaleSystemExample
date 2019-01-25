<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SaleSystem</title>
  </head>
  <body>
    <h1>Product list</h1>
    <table border="1">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
        <th>AddSale</th>
      </tr>

      <?php
        require_once "../models/Data.php";
        require_once "../models/Product.php";
        session_start();
        $data = new Data();
        $productList = $data->getProducts();
        foreach ($productList as $p) {
          echo "<tr>";
          echo "<td>".$p->getId()."</td>";
          echo "<td>".$p->getName()."</td>";
          echo "<td>\$".$p->getPrice()."</td>";
          echo "<td>".$p->getStock()."</td>";
          echo "<td>";
            echo "<form action='../controllers/addToCart.php' method='post'>";
              echo "<input type='hidden' name='txtId' value='".$p->getId()."'>";
              echo "<input type='hidden' name='txtName' value='".$p->getName()."'>";
              echo "<input type='hidden' name='txtPrice' value='".$p->getPrice()."'>";
              echo "<input type='hidden' name='txtStock' value='".$p->getStock()."'>";
              echo "<input type='number' placeholder='amount' name='amount' required='required'>";
              echo "<input type='submit' name='btnAdd' value='Add'>";
            echo "</form>";
          echo "</td>";
          echo "</tr>";
        }
      ?>
    </table>
    <a href='sales.php'>View sales</a>
    <?php
      if(isset($_GET["message"])){
        $message = $_GET["message"];
        if($message == "1"){
          echo "<br><b>Amount should be a positive number</b></br>";
        } else if($message == "2"){
          echo "<br><b>Selected product has no stock</b></br>";
        }
      }
    ?>

    <?php
        if(isset($_SESSION["carrito"])){
          $carrito = $_SESSION["carrito"];
          echo "<h1>Shopping cart: </h1>";
          echo "<table border='1'>";
          echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Price</th>";
            echo "<th>Amount</th>";
            echo "<th>SubTotal</th>";
          echo "</tr>";

          $total = 0;
          $index = 0;
          foreach ($carrito as $product) {
            echo "<tr>";
              echo "<td>".$product->getId()."</td>";
              echo "<td>".$product->getName()."</td>";
              echo "<td>".$product->getPrice()."</td>";
              echo "<td>".$product->getAmount()."</td>";
              echo "<td>\$".$product->getSubTotal()."</td>";
              echo "<td>";
                echo "<a href='../controllers/removeFromCart.php?in=$index'>Remove</a>";
              echo "</td>";
              $total += $product->getSubTotal();
            echo "</tr>";
            $index++;
          }
          $_SESSION["total"] = $total;
          echo "<tr>";
          echo "<td colspan='4'>Total: </td>";
          echo "<td colspan='2'><b>\$$total<b></td>";
          echo "<tr>";

          echo "<tr>";
            echo "<td colspan='6'>";
              echo "<form action='../controllers/createSale.php' method='post'>";
                echo "<input type='submit' value='Buy'>";
              echo "</form>";
            echo "</td>";
          echo "</tr>";
          echo "</table>";
        } else {
          echo "<h1>Your shopping cart is empty</h1>";
        }
     ?>
  </body>
</html>
