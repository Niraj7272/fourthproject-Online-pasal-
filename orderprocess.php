<?php
session_start();
include "config.php";
$user_id = $_SESSION["user_id"];

$invoice_no = uniqid('', true);

// Fetch cart products outside the loop
$select_cart_products1 = mysqli_query($conn, "SELECT c.*, p.productName, p.price, p.image, p.stock FROM cart c JOIN products p ON c.productId= p.productId WHERE c.user_id= '$user_id'");

if (isset($_POST['order'])) {

    // Fetch cart products only once
    while ($fetch_cart_products1 = mysqli_fetch_assoc($select_cart_products1)) {
        $productId = $fetch_cart_products1['productId'];
        $quantity = $fetch_cart_products1['quantity'];

        // Insert the order into the 'orders' table
        $sql = 'INSERT INTO orders (productId, user_id, order_quantity, invoice_no) 
                VALUES ("' . $productId . '", "' . $user_id . '", "' . $quantity . '",
                "' . $invoice_no . '")';
        $resultInsert = mysqli_query($conn, $sql);

        // Update the product quantity in the 'products' table
        $sqlUpdate = "UPDATE products SET stock = stock - $quantity WHERE productId = $productId";
        $resultUpdate = mysqli_query($conn, $sqlUpdate);

        if (!$resultInsert || !$resultUpdate) {
            echo 'Error placing order.';
            exit();
        }
    }

    // Delete the items from the cart after placing the order
    $sql1 = "DELETE FROM cart WHERE user_id = $user_id";
    mysqli_query($conn, $sql1);

    header("Location: my_order.php");
} else {
    echo 'error';
}
?>