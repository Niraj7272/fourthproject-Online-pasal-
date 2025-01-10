<?php 
session_start();
include 'config.php';
$user_id=$_SESSION["user_id"];

//update query
if(isset($_POST['update_cart_quantity'])){

    $update_value=$_POST['update_quantity'];
    // echo $update_value;
    $update_id=$_POST['update_quantity_id'];
    // echo $update_id;

    $update_quantity_query=mysqli_query($conn,"update `cart` set quantity=$update_value WHERE cart_id=$update_id");
    if($update_quantity_query){
        header('location:mycart.php');
    }

    
}

//removing selected item
if(isset($_GET['remove'])){
    $remove_id=$_GET['remove'];
    mysqli_query($conn,"Delete from `cart` where cart_id=$remove_id");
    header('location:mycart.php');
}
//deleating all products at once
if(isset($_GET['delete_all'])){
    mysqli_query($conn,"Delete from `cart`");
    header('location:mycart.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart page</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<body>
    <?php include 'header.php'; ?>
    <div class="cart_wrapper">
        <div class="cart_container">
                 <h2 class="cart_heading">My Cart</h2>
        <div class="shopping_cart">
            <table>
                <?php
$select_cart_products=mysqli_query($conn,"SELECT c.cart_id, c.user_id,c.quantity, p.productName, p.price, p.image, p.stock, p.productType FROM cart c JOIN products p ON c.productId= p.productId WHERE c.user_id= '$user_id'");
$i=1;
$grand_total=0;
if(mysqli_num_rows($select_cart_products)>0){
 echo "<thead >
 <th>Sl No</th>
 <th>Product Name</th>
 <th>Product Image</th>
 <th>Product Price</th>
 <th>Product Quantity</th>
 <th>Total Price</th>
 <th>Action</th>
</thead>
<tbody>";
while($fetch_cart_products=mysqli_fetch_assoc($select_cart_products)){
    $fetched_stock= $fetch_cart_products['stock'];
    if($fetch_cart_products['productType'] == 'new'){
        $stock=$fetched_stock-4;
    }else{
        $stock=1;
    }

    ?>
<tr>
                        <td><?php echo $i++?></td>
                        <td><?php echo $fetch_cart_products['productName'] ?></td>
                        <td>
                            <img src="img/productimage/<?php echo $fetch_cart_products['image']?>" alt="laptop" class="cart_image">
                        </td>
                         <td>Rs <?php echo number_format($fetch_cart_products['price'] )?>/-</td> 
                        <td>
                            <form action="" method="post">
                                <input type="hidden" value="<?php echo $fetch_cart_products['cart_id'] ?>" name="update_quantity_id">
                            <div class="quantity_box">
                                <input type="number" min="1" max="<?php echo $stock?>" value="<?php echo $fetch_cart_products['quantity']?>" name="update_quantity" class="cart_input_quantity">
                                <input type="submit" class="update_quantity" value="update" name="update_cart_quantity">
                            </div>
                            </form>
                        </td>
                        <td>Rs <?php echo $subtotal=number_format($fetch_cart_products['price'] * $fetch_cart_products['quantity']) ?>/-</td>

                        <td>
                            <a href="mycart.php?remove=<?php echo $fetch_cart_products['cart_id'] ?>" onclick="return confirm('Are you sure you want to delete this item')" class="product-remove_btn">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
    <?php
    $grand_total=$grand_total+($fetch_cart_products['price'] * $fetch_cart_products['quantity']);
}
}else{
    echo"<div class='empty_text'>Cart Is Empty</div>";
}
?>
                    
                </tbody>
            </table>
                <!-- bottom area -->
            <?php
if($grand_total>0){
    echo "
    <div class='table_bottom'>
        <a href='products.php' class='cont_shopping_btn'>Continue Shopping</a>
        <h3 class='cont_shopping_btn'>Grand total:<span>Rs $grand_total/-</span></h3>
        <a href='order.php' class='cont_shopping_btn'>Proceed to cheakout</a>
    </div>";


?>           
            <a href="mycart.php?delete_all" class="delete_all_btn"  onclick="return confirm('Are you sure you want to delete all items')">
                <i class="fas fa-trash delete_icon"></i>Delete All
            </a>
            <?php
}else{
    echo"";
}
?>
        </div>
        </div>
    </div>

    
</body>
</html>