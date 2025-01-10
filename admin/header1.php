<?php
error_reporting(0);
include 'config.php';
$user_id=$_SESSION["user_id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>headerpage</title>
     <link rel="stylesheet" href="index.css">
     
</head>
<body>
    
<div class="headerbox">
    <div class="headernavbar">
        <div class="headerlogo">
            <img src="../img/onlinepasallogo.jpeg" width="80px">
        </div>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="../products.php">Shop</a></li>
                <?php
                 if(isset($_SESSION['user_type'])){
                    if($_SESSION['user_type']=='Admin'){
               echo ' <li><a href="dashboard.php">Admin</a></li>';
                    }else if ($_SESSION['user_type']=='Seller') {
                       echo'<li><a href="../fourthproject/seller/sellerdashboard.php">Seller</a></li>';
                    } else {
                        echo ' <li><a href="profile.php">Profile</a></li>';
                    }
                 }
                ?>
                 <?php
                     if(isset($_SESSION['email'])){
                    echo '<li><a href="logout.php" onclick="return confirm(\'You Are Sure You Want To Logout?\');"><button class="btnlogin"><b>Logout</b></button></a></li>';
                    } else {
                             echo '<li><a href="login.php"><button class="btnlogin">Login</button></a></li>';
                            }
                         ?>

                <?php
                $select_product=mysqli_query($conn,"select * from `cart` WHERE user_id='$user_id'")or die('query failed');
                $row_count=mysqli_num_rows($select_product);
                    if(isset($_SESSION['email'])){
                    echo '<li><a href="mycart.php" class="cart"><i class="fa-solid fa-cart-shopping"></i><span><sup>' . $row_count . '</sup></span></a></li>';
                    }
                ?>       
            </ul>
        </nav>
    </div>
    </div>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
</body>
</html>