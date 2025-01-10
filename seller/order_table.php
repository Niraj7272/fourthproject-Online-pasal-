<?php
session_start();
include '../config.php';
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
    <title>dashbord design</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
           <li>
            <a href="producttable.php">
            <i class="fa-solid fa-gift"></i>
                <span>Products</span>
            </a>
           </li>
           <li class="active">
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
                <span>Seller</span>
                <h2>Dashboard</h2>
            </div>
            <div class="user-info">
                 <a href="../profile.php"><img src="../img/user_image/<?php echo $fetch_user['user_image']?>" alt=""></a>
                 <select onchange="location = this.value;">
                <option value="../profile.php">profile</option>
                <option value="../index.php">Home</option>
                <option value="../logout.php" onclick="return confirm('You Are Sure You Want To Logout?');">Logout</option>
            </select>
            </div>
        </div>
    <div class="tabular-wrapper">
        <h3 class="main-title">Order List</h3>
        <div class="table-container">

        <?php
           $i = 1;
           $rows = mysqli_query($conn, "SELECT o.*,p.*,u.* FROM orders AS o JOIN products AS p ON o.productId= p.productId JOIN signup AS u ON o.user_id=u.user_id");
           if(mysqli_num_rows($rows)>0){ 

            echo' <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>User Name</th>
                    <th>Invoice No</th>
                    <th>product Name</th>
                    <th>Total Price</th>
                    <th>Order Placed at</th>
                    <th>Action</th>
                </tr>
            </thead>';
            ?>
            <?php foreach($rows as $row) : ?>
                <?php $grand_total=($row['price'] * $row['order_quantity']); ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row["fname"] ?></td>
        <td><?php echo $row["invoice_no"] ?></td>
        <td><?php echo $row["productName"] ?></td>
        <td><?php echo $grand_total ?></td>
        <td><?php echo $row["order_date"] ?></td>
        <td>
                 <a href="deletesellerproduct.php?delete=<?php echo $row['order_id']?>" 
                class="delete_product_btn" onclick="return confirm('Are you sure you want to delete this product');">
                <i class="fas fa-trash"></i></a>

                <!-- <a href="../my_order.php"
                 class="update_product_btn">
                    <i class="fa-solid fa-eye"></i></a> -->
        </td>
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