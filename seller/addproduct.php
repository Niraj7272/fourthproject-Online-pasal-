<?php
session_start();
require '../config.php';
$user_id=$_SESSION["user_id"];

if(isset($_POST["submit"])){
    $name = $_POST["productName"];
    $price = $_POST['price'];
    $desc = $_POST['description'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];
    $size = $_POST['size'];
    $used = $_POST['used'];
    $productType = $_POST['productType'];
    $productType = isset($_POST['productType']) ? $_POST['productType'] : '';
    if($_FILES["image"]["error"]=== 4){
        echo
        "<script> alert('Image Does Not Exist'); </script>";
    }else{
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if(!in_array($imageExtension, $validImageExtension)){
            echo
            "<script> alert('Invalid Image Extension'); </script>";
        }
        else if($filesize > 1000000){
            echo
            "<script>alert('Image Size Is Too Large'); </script>";
        }else{
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, '../img/productimage/'. $newImageName);
            $query = "INSERT INTO products (user_id, productName, price, description, category, image, stock, size, used, productType) 
                  VALUES ('$user_id','$name', '$price', '$desc', '$category', '$newImageName', '$stock', '$size', '$used', '$productType')";
        mysqli_query($conn, $query);
            echo
            "<script>
            alert('Successfully Added');
            document.location.href ='producttable.php';
             </script>";
        }
    }
}
?>
<?php 
$select_category=mysqli_query($conn,"select * from `category`");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="addproductcontainer">
    <div class="seller-product-form-container">
        <form action="" method="post" enctype="multipart/form-data">
        <h1>Add product</h1>
        <input type="text" placeholder="Enter product name" name="productName" required class="inputbox">
        <input type="number" placeholder="Enter product price" name="price" class="inputbox">
        <input type="text" placeholder="Enter product stock" name="stock" class="inputbox">
        <select name="category" class="inputboxone">
            <?php while($row_category=mysqli_fetch_assoc($select_category)){
                echo "<option value='{$row_category['category_name']}'>{$row_category['category_name']}</option>";
            }
            ?>
        </select>   
        <input type="text" placeholder="Size If Available" name="size" class="size_inputbox"><br>
        <input type="text" placeholder="Used Days Only For Second hand products" name="used" class="inputbox"><br>
        <textarea name="description" id="description" cols="64" rows="3" placeholder="Product Description" class="suggestionbox"></textarea>
        <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" class="filechoosebox">
        <label class="product_type" for="">Type:</label>
        <input type="radio" name="productType" value="new">New Product
        <input type="radio" name="productType" value="old">Old Product
        <input type="submit" class="uploadproductbtn" name="submit" value="Add product">
        <a href="producttable.php" class="product_cancel_btn">Cancel</a>
        </form>
       

    </div>
</div>
    
</body>
</html>