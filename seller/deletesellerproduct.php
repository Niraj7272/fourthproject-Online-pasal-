<!-- delete logic -->

<!-- php code -->
<?php
include '../config.php';
if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];
    $delete_query=mysqli_query($conn,"Delete from `products` where productId=$delete_id") or die("query failed!");
    if($delete_query){
        echo"product  deleted";
        header('location:producttable.php');
    }else{
        echo"product not deleted";
        header('location:producttable.php');
    }
}
?>