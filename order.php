<?php
session_start();
include "config.php";
$user_id=$_SESSION["user_id"];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>order Page</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php include "header.php"; ?>
    <div class="order_container">
        <div class="order_first_box">
            <h1>Order Details</h1>
          <hr><br>
          <div>
          <table>
            <thead>
              <th>Product Image</th>
              <th>Product Name</th>
              <th>Price</th>
              <th >Quantity</th>
              <th>Amount</th>
            </thead>

            <?php
          $select_cart_products=mysqli_query($conn,"SELECT c.*, p.productName, p.price, p.image, p.stock FROM cart c JOIN products p ON c.productId= p.productId WHERE c.user_id= '$user_id'");
          $grand_total=0;
          if(mysqli_num_rows($select_cart_products)>0){
            while($fetch_cart_products=mysqli_fetch_assoc($select_cart_products)){
           ?>

           <tr>
                <td>
                    <img src="img/productimage/<?php echo $fetch_cart_products['image']?>" alt="laptop" class="cart_image">
                </td>
                <td><?php echo $fetch_cart_products['productName'] ?></td>
                <td>Rs <?php echo number_format($fetch_cart_products['price'] )?>/-</td>
                <td><?php echo number_format($fetch_cart_products['quantity'] )?></td>
                <td>Rs <?php echo $subtotal=number_format($fetch_cart_products['price'] * $fetch_cart_products['quantity']) ?>/-</td>
           </tr>
           <?php
                $grand_total=$grand_total+($fetch_cart_products['price'] * $fetch_cart_products['quantity']);
            }
         }
            ?>
          </table>
          </div>
          <?php
            if($grand_total>0){ ?>
            <form action="orderprocess.php" method="POST">
             <h3 class='cont_shopping_btn'>Grand total:<span>Rs <?php echo $grand_total ?>/-</span></h3><br>
             <button name="order" class='place_order_btn'>Place Order(Cash On Delivery)</button>
             </form>
          <?php  }
          ?>           
        </div>
    </div>
</body>
</html>