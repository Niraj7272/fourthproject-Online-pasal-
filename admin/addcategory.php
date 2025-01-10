<?php
include '../config.php';
session_start();
?>
<?php 
if(isset($_POST['add_category'])){
    $category_name = $_POST['category_name'];

        $insert = "INSERT INTO category(category_name) VALUES('$category_name')";
            
        mysqli_query($conn, $insert);
        header('location:categorytable.php');
    }
    else {
    echo " ";
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
    <div class="addcategory_container">
        <form action="" method="post">
         <h1 class="addcategory_heading">Add Category</h1>
         <input type="text" name="category_name" placeholder="Enter category Title" class="addcategory_inputbox" required ><br>
         <input type="submit" class="addcategory_btn" value="Add Category" name="add_category" >
        <a href="categorytable.php" class="addcategory_cancel_btn">Cancel</a>
        </form>
    </div>
</body>
</html>