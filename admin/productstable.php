<?php
include '../config.php';
session_start();
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
    <title>addusers Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
<div class="sidebar">
        <div class="logo"><h4>ONLINE PASAL</h4></div>
        <ul class="menu">
           <li>
            <a href="dashboard.php">
                <!-- <i class="fas fa-tachometer-alt"></i> -->
                <i><img src="../img/dashboard.png" class="side-icon"></i>
                <span>Dashboard</span>
            </a>
           </li>
           <li>
            <a href="profile.php">
                <!-- <i class="fas fa-user"></i> -->
                <i><img src="../img/profile.png" class="side-icon"></i>
                <span>Profile</span>
            </a>
           </li>
           <li class="active">
            <a href="productstable.php">
            <!-- <i class="fa-solid fa-gift"></i> -->
            <i><img src="../img/product.png" class="side-icon"></i>
                <span>Products</span>
            </a>
           </li>
           <li>
            <a href="userstable.php">
            <!-- <i class="fa-solid fa-user-plus"></i> -->
            <i><img src="../img/add-user.png" class="side-icon"></i>
                <span>Users</span>
            </a>
           </li>
           <li>
            <a href="order_table.php">
            <!-- <i class="fa-solid fa-truck"></i> -->
            <i><img src="../img/order.png" class="side-icon"></i>
                <span>Orders</span>
            </a>
           </li>
           <li>
            <a href="categorytable.php">
            <!-- <i class="fa-sharp fa-solid fa-cart-plus"></i> -->
            <i><img src="../img/add-category.png" class="side-icon"></i>
                <span>Category</span>
            </a>
           </li>
           <li class="logout">
            <?php
               if(isset($_SESSION['user_type'])){
             echo'<a href="../logout.php" onclick="return confirm(\'You Are Sure You Want To Logout?\');">
             <i><img src="../img/log-out.png" class="side-icon"></i>
                <span>Logout</span>
            </a>';
               }
            ?>
           </li>
        </ul>
    </div>
<!-- main body section -->
    <div class="main-content">
        <div class="header-wrapper">
            <div class="header-title">
                <h2>Products</h2>
            </div>
            <div class="user-info">
                <a href="profile.php"><img src="../img/user_image/<?php echo $fetch_user['user_image']?>" alt=""></a>
            <select onchange="location = this.value;">
                <option value="profile.php">profile</option>
                <option value="../index.php">Home</option>
                <option value="../logout.php" onclick="return confirm('You Are Sure You Want To Logout?');">Logout</option>
            </select>
            </div>
        </div>

        <div class="tabular-wrapper">
        <h3 class="main-title">Products List</h3>
        <div class="table-container">

        <?php
          $i = 1;
          $rows = mysqli_query($conn, "SELECT p.productId,p.productName, p.price, p.description, p.category, p.stock, p.image, u.user_id ,u.fname FROM products p JOIN signup u ON p.user_id=u.user_id");
          if(mysqli_num_rows($rows)>0){

           echo' <table>
                <thead>
                    <tr>
                        <th>SI No</th>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Added By</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>';
                ?>
                <?php foreach($rows as $row) : ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row["productId"]; ?></td>
            <td><?php echo $row["productName"]; ?></td>
            <td><?php echo $row["fname"]; ?></td>
            <td><?php echo $row["price"]; ?></td>
            <td><?php echo $row["description"]; ?></td>
            <td><?php echo $row["category"]; ?></td>
            <td><?php echo $row["stock"]; ?></td>
            <td><img src="../img/productimage/<?php echo $row['image']; ?>" width="100" height="100" title=""></td>
            <td>
                <a href="delete.php?delete=<?php echo $row['productId']?>" 
                class="delete_product_btn" onclick="return confirm('Are you sure you want to delete');">
                <i class="fas fa-trash"></i></a>

            </td>
        </tr>
          <?php 
          endforeach; 
        }
          else{
            echo"<div class='empty_text'>No Products Available</div>";
          }
          ?>
            </table>
        </div>
    </div>
</div>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
</body>
</html>