<?php
include '../config.php';
//update logic
if(isset($_POST['update_product'])){
    $update_product_id=$_POST['update_product_id'];
    // echo $update_product_id;
    $update_product_name=$_POST['update_product_name'];
    //  echo $update_product_name;
    $update_product_price=$_POST['update_product_price'];
    // echo"$update_product_price";
    $update_product_stock=$_POST['update_product_stock'];
    $update_product_category=$_POST['update_product_category'];
    $update_product_description=$_POST['update_product_description'];
    $update_product_image=$_FILES['update_product_image']['name'];
    $update_product_image_tmp_name=$_FILES['update_product_image']['tmp_name'];
    $update_product_image_folder='../img/productimage/'.$update_product_image;

    //update query
    $update_products=mysqli_query($conn,"update `products` set productName='$update_product_name',
    price='$update_product_price',stock='$update_product_stock',category='$update_product_category',
    description='$update_product_description',image='$update_product_image' where productId=$update_product_id");
    if($update_products){
        move_uploaded_file($update_product_image_tmp_name,$update_product_image_folder);
        echo
            "<script>
            alert('Successfully updated');
            document.location.href ='producttable.php';
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
    <title>product update page</title>
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
<div class="addproductcontainer">
    <div class="sellerupdate-product-form-container">

    <?php
if(isset($_GET['edit'])){
    $edit_id=$_GET['edit'];
    // echo $edit_id;
    $edit_query=mysqli_query($conn,"select * from `products` where productId=$edit_id");
    if(mysqli_num_rows($edit_query)>0){
    $fetch_data=mysqli_fetch_assoc($edit_query);
// $row=$fetch_data['price'];
//  echo $row;
        
        ?>

<?php 
$select_category=mysqli_query($conn,"select * from `category`");
?>

        <form action="" method="post" enctype="multipart/form-data">
        <img src="../img/productimage/<?php echo $fetch_data['image']; ?>" width="150" height="150"  class="updateimgproduct"title="">
        <input type="hidden"value="<?php echo $fetch_data['productId']?>" name="update_product_id">
        <input type="text"  class="inputbox" required value="<?php echo $fetch_data['productName']?>" name="update_product_name">
        <input type="number" class="inputbox" required value="<?php echo $fetch_data['price']?>" name="update_product_price">
        <input type="text" class="inputbox" required value="<?php echo $fetch_data['stock']?>" name="update_product_stock">
        <select name="update_product_category" class="inputboxone" >
            <option value='<?php echo $fetch_data['category']; ?>'>Select a Category</option>
        <?php while($row_category=mysqli_fetch_assoc($select_category)){
                echo "<option value='{$row_category['category_name']}'>{$row_category['category_name']}</option>";
            }
            ?>
                        </select><br><br>
        <textarea name=" update_product_description" id="description" cols="64" rows="4" class="suggestionbox" required ><?php echo $fetch_data['description']?></textarea>
        <input type="file"  accept="image/png, image/jpeg, image/jpg" name="update_product_image" class="filechoosebox" required>
        <input type="submit" class="product_edit_btn" value="Update Product" name="update_product" >
        <!-- <input type="reset" id="close_product_edit_btn" class="product_cancel_btn"  value="Cancel"> -->
        <a href="producttable.php" class="product_cancel_btn">Cancel</a>
        </form>

        <?php
    }
}
    ?>
    </div>
</div>
    
</body>
</html>