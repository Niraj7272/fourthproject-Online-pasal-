<?php
include 'config.php';
session_start();
$user_id=$_SESSION["user_id"];

$select_user=mysqli_query($conn,"Select * from `signup` WHERE user_id='$user_id'");
mysqli_num_rows($select_user);
$fetch_user=mysqli_fetch_assoc($select_user);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My_order Page</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php
      include "header.php";
    ?>
    <div class="main-content">
    <h3 class="my_order_heading">My Orders</h3>
    <div class="tabular-wrapper">

        <?php
          $i = 1;
          $rows = mysqli_query($conn, "SELECT o.*,p.* FROM products p JOIN orders o ON p.productId=o.productId WHERE o.user_id=$user_id ORDER BY order_date DESC");
          if(mysqli_num_rows($rows)>0){

           echo' <table>
                <thead>
                    <tr>
                        <th>SI No</th>
                        <th>Invoice No</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Order Date</th>
                    </tr>
                </thead>';
                ?>
                <?php foreach($rows as $row) : ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row["invoice_no"] ?></td>
            <td><?php echo $row["productName"]; ?></td>
            <td><?php echo $row["order_quantity"]; ?></td>
            <td><?php echo $row["price"]; ?></td>
            <td><img src="img/productimage/<?php echo $row['image']; ?>" width="100" height="100" title=""></td>
            <td><?php echo $row["order_date"] ?></td>
        </tr>
          <?php 
          endforeach; 
        }
          else{
            echo"<div class='empty_text'>No Products Available</div>";
          }
          ?>
            </table>
        </div>
    </div>
</body>
</html>