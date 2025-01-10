<!-- delete logic -->

<!-- php code -->
<?php
include '../config.php';

if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];

    $delete_query=mysqli_query($conn,"DELETE from cart where user_id=$delete_id") or die("query failed!");
    $delete_query=mysqli_query($conn,"DELETE from products where user_id=$delete_id") or die("query failed!");

    $delete_query=mysqli_query($conn,"DELETE from `signup` where user_id=$delete_id") or die("query failed!");
    if($delete_query){
        echo"User  deleted";
        header('location:userstable.php');
    }else{
        echo"User not deleted";
        header('location:userstable.php');
    }
}
?>