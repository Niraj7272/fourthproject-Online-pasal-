<?php
session_start();
include '../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashbord design</title>
    <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/akar-icons-fonts/1.1.20/css/akar-icons.css">
    
</head>
<body>
    <div class="sidebar">
        <div class="logo"><h4>ONLINE PASAL</h4></div>
        <ul class="menu">
           <li class="active">
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
           <li>
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
             echo'<a href="logout.php" onclick="return confirm(\'You Are Sure You Want To Logout?\');">
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
        <?php include "header.php" ?>
        <!-- card-container -->
        <div class="card-container">
        <h3 class="main-title">Today data</h3>
        <div class="card-wrapper">
            <div class="payment-card light-red">
                <div class="card-header">
                    <div class="amount">
                        <span class="title">Total Users</span>
                        <span class="amount-value">
                        <?php
                            $select_users=mysqli_query($conn,"select * from `signup`")or die('query failed');
                            $row_count=mysqli_num_rows($select_users);
                            echo $row_count ;
                        ?>       
                        </span>
                    </div>
                    <!-- <i class="fa-solid fa-users icon"></i> -->
                    <img src="../img/users.png" class="icon">
                </div>
                
            </div>

            <div class="payment-card light-purple">
                <div class="card-header">
                    <div class="amount">
                        <span class="title">Total Products</span>
                        <span class="amount-value">
                        <?php
                            $select_products=mysqli_query($conn,"select * from `products`")or die('query failed');
                            $row_count=mysqli_num_rows($select_products);
                            echo $row_count ;
                        ?>       
                        </span>
                    </div>
                    <!-- <i class="fa-solid fa-gift icon dark-purple"></i> -->
                    <img src="../img/product.png" class="icon dark-purple">
                </div>
                
            </div>

            <div class="payment-card light-green">
                <div class="card-header">
                    <div class="amount">
                        <span class="title">Total Orders</span>
                        <span class="amount-value">
                        <?php
                            $select_orders=mysqli_query($conn,"select * from `orders`")or die('query failed');
                            $row_count=mysqli_num_rows($select_orders);
                            echo $row_count ;
                        ?>    
                        </span>
                    </div>
                    <!-- <i class="fa-solid fa-truck icon dark-green"></i> -->
                    <img src="../img/order.png" class="icon dark-green">
                </div>
                
            </div>

            <div class="payment-card light-blue">
                <div class="card-header">
                    <div class="amount">
                        <span class="title">Catrgory</span>
                        <span class="amount-value">
                        <?php
                            $select_category=mysqli_query($conn,"select * from `category`")or die('query failed');
                            $row_count=mysqli_num_rows($select_category);
                            echo $row_count ;
                        ?>       
                        </span>
                    </div>
                    <!-- <i class="fa-solid fa-chart-line icon dark-blue"></i> -->
                    <img src="../img/category.png" class="icon dark-blue">
                </div>
                
            </div>
        </div>
    </div>

    <div class="tabular-wrapper">
        <h3 class="main-title">Available User</h3>
        <div class="table-container">

        <?php
          $i = 1;
          $rows = mysqli_query($conn, "SELECT *FROM signup");
          if(mysqli_num_rows($rows)>0){

           echo' <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User Id</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Address</th>
                        <th>User Type</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>';
                ?>
                <?php foreach($rows as $row) : ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row["user_id"]; ?></td>
            <td><?php echo $row["fname"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["phone"]; ?></td>
            <td><?php echo $row["address"]; ?></td>
            <td><?php echo $row["user_type"]; ?></td>
            <td><?php echo $row["dt"]; ?></td>
        </tr>
          <?php 
          endforeach; 
        }
          else{
            echo"<div class='empty_text'>No User Available</div>";
          }
          ?>
            </table>
        </div>
    </div>
    </div>
</body>
</html>