<?php
error_reporting(0);
session_start();
include "config.php";

$details_id = $_GET['details'];

if (isset($_GET['details'])) {
    $details_id = $_GET['details'];
    $query = mysqli_query($conn, "select * from `products` where productId=$details_id");
    if (mysqli_num_rows($query) > 0) {
        $fetch_data = mysqli_fetch_assoc($query);
    }
}

$user_id=$_SESSION["user_id"];
  if(isset($_POST['add_to_cart'])){
    $products_quantity=1;


    //select cart data based on condition
    $select_cart=mysqli_query($conn,"select * from `cart` where productId='$details_id'");
    if(mysqli_num_rows($select_cart)>0){
        // echo"<div class='empty_text'>products already added to cart</div>";
        echo "<script type='text/javascript'>alert('products already added to cart')</script>";
    }else{
        //insert cart data in cart table
    $insert_products=mysqli_query($conn, "insert into `cart` (productId,user_id,quantity)values
    ('$details_id','$user_id','$products_quantity')");
    echo "<script type='text/javascript'>alert('product added to cart successfully')</script>";
    }
}
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail page</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php include "header.php" ;?>
    
    <form method="post" action="">
    <div class="detail_container">
        <div class="detail_first_box">
             <img src="img/productimage/<?php echo $fetch_data['image']; ?>" height="400px" width="400px" class="detail_image">
        </div>
        <div class="detail_second_box">
           <h1><?php echo $fetch_data['productName']?></h1>
           <hr><br>
           <h3>Price: Rs <?php echo $fetch_data['price']?></h3><br>
           <?php 
           if($fetch_data['category']=='clothing'){?>
            <h3>Size: <?php echo $fetch_data['size']?></h3><br>
          <?php }
           ?>
           <?php 
           if($fetch_data['productType']=='old'){?>
            <h3>Used: <?php echo $fetch_data['used']?></h3><br>
          <?php }
           ?>
           
           <p><?php echo $fetch_data['description']?></p><br><br>

           <?php 
                    if(isset($_SESSION['user_id'])){ 
                    if($fetch_data['stock']<=4){ ?>
                            <h2 style="color:red; font-size:23px;">Out Of Stock</h2>
                       <?php }else{ ?>
                        <button type="submit" class="detail_add-to-cart-btn" name="add_to_cart">Add To Cart</button>
                       <?php }
                        ?>
                    <?php
                    } else{ ?>
                        <button onclick="alert('Login To Continue')" type="submit" class="detail_add-to-cart-btn">Add To Cart</button>
                
                   <?php }
                    ?>
             <a href="products.php" class="detail_back">Back</a>
             

        </div>
    </div>
    </form>
    <?php
     include 'foot.php';
    ?>
   
</body>
</html>