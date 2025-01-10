<!-- delete logic -->

<!-- php code -->
<?php
include '../config.php';
if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];
    $delete_query=mysqli_query($conn,"Delete from `orders` where order_id=$delete_id") or die("query failed!");
    if($delete_query){
        echo"Order deleted";
        header('location:order_table.php');
    }else{
        echo"order_not deleted";
        header('location:order_table.php');
    }
}
?>