<?php
include '../config.php';
//update logic
if(isset($_POST['update_category'])){
    $update_category_id=$_POST['update_category_id'];
    $update_category_name=$_POST['update_category_name'];

    $update_category=mysqli_query($conn,"update `category` set category_name='$update_category_name' where category_id=$update_category_id");
    if($update_category){
        echo
            "<script>
            alert('Successfully updated');
            document.location.href ='categorytable.php';
             </script>";
    }else{
        $error[] = 'There is some error in updating the product ';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add category page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    if (isset($error)) {
        foreach ($error as $error) {
            echo '<span class="error-msg">'.$error.'</span>';
        }
    }
    ?>
    <div class="addcategory_container">
    <?php
   $edit_query=mysqli_query($conn,"select * from `category`");
    if(mysqli_num_rows($edit_query)>0){
    $fetch_data=mysqli_fetch_assoc($edit_query);
        ?>

        <form action="" method="post">
         <h1 class="addcategory_heading">Update Category</h1>
         <input type="hidden"value="<?php echo $fetch_data['category_id']?>" name="update_category_id">
         <input type="text" name="update_category_name" required value="<?php echo $fetch_data['category_name']?>" class="addcategory_inputbox"><br>
         <input type="submit" class="updatecategory_btn" value="Update Category" name="update_category" >
        <a href="categorytable.php" class="addcategory_cancel_btn">Cancel</a>
        </form>
        <?php
   }
    ?>
    </div>
</body>
</html>