<?php
session_start();
require '../config.php';
$user_id=$_SESSION["user_id"];

$select_user=mysqli_query($conn,"Select * from `signup` WHERE user_id='$user_id'");
mysqli_num_rows($select_user);
$fetch_user=mysqli_fetch_assoc($select_user);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product display</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="sellerdashboard-sidebar">
        <div class="logo"><h4>ONLINE PASAL</h4></div>
        <ul class="sellerdashboard-menu">
           <li>
            <a href="sellerdashboard.php">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
           </li>
           <li>
            <a href="../profile.php">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
           </li>
           <li class="active">
            <a href="producttable.php">
            <i class="fa-solid fa-gift"></i>
                <span>Products</span>
            </a>
           </li>
           <li>
            <a href="order_table.php">
            <i class="fa-solid fa-truck"></i>
                <span>Orders</span>
            </a>
           </li>
           
           <li class="logout">
            <?php
               if(isset($_SESSION['user_type'])){
             echo'<a href="../logout.php" onclick="return confirm(\'You Are Sure You Want To Logout?\');">
            <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </a>';
               }
            ?>
           </li>
        </ul>
    </div>
<!-- main body section -->
    <div class="sellerdashboard-main-content">
        <div class="sellerdashboard-header-wrapper">
            <div class="sellerdashboard-header-title">
                <span>MY</span>
                <h2>Products</h2>
            </div>
            <div class="user-info">
                 <a href="../profile.php"><img src="../img/user_image/<?php echo $fetch_user['user_image']?>" alt=""></a>
                 <select onchange="location = this.value;">
                <option value="./profile.php">profile</option>
                <option value="../index.php">Home</option>
                <option value="../logout.php" onclick="return confirm('You Are Sure You Want To Logout?');">Logout</option>
            </select>
            </div>
        </div>

    <div class="addproduct_container">
        <h2 class="sellerproduct-table-heading">Added products</h2>
        <a href="addproduct.php" class="addproductbtn">ADD PRODUCT</a>
    <div class="addproduct_table">
            <?php
          $i = 1;
          $rows = mysqli_query($conn, "SELECT *FROM products WHERE user_id='$user_id'");
          if(mysqli_num_rows($rows)>0){

           echo' <table>
        <thead class="tablerow">
            <th class="one">SI No</th>
            <th class="one">ID</th>
            <th class="two">Name</th>
            <th class="three">Price</th>
            <th class="four">Description</th>
            <th class="five">Category</th>
            <th class="six">Stock</th>
            <th class="seven">Product_Type</th>
            <th>Image</th>
            <th class="eight">Action</th>
        </thead>';
        ?>
        <?php foreach($rows as $row) : ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row["productId"]; ?></td>
            <td><?php echo $row["productName"]; ?></td>
            <td><?php echo $row["price"]; ?></td>
            <td><?php echo $row["description"]; ?></td>
            <td><?php echo $row["category"]; ?></td>
            <td><?php echo $row["stock"]; ?></td>
            <td><?php echo $row["productType"]; ?></td>
            <td><img src="../img/productimage/<?php echo $row['image']; ?>" width="100" height="100" title=""></td>
            <td>
                <a href="deletesellerproduct.php?delete=<?php echo $row['productId']?>" 
                class="delete_product_btn" onclick="return confirm('Are you sure you want to delete this product');">
                <i class="fas fa-trash"></i></a>

                <a href="productupdate.php?edit=<?php echo $row['productId']?>"
                 class="update_product_btn">
                    <i class="fas fa-edit"></i></a>
            </td>
        </tr>
          <?php 
          endforeach; 
        }
          else{
            echo"<div class='empty_text'>No products Available</div>";
          }
          ?>
    
    </table>
    </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</div>
</body>
</html>