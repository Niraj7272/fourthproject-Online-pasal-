<!-- delete logic -->

<!-- php code -->
<?php
include '../config.php';
if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];
    $delete_query=mysqli_query($conn,"Delete from `category` where category_id=$delete_id") or die("query failed!");
    if($delete_query){
        echo"category  deleted";
        header('location:categorytable.php');
    }else{
        echo"category not deleted";
        header('location:categorytable.php');
    }
}
?>