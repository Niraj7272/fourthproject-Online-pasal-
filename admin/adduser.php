<?php
include '../config.php';
session_start();
?>
<?php
if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn,$_POST['fname']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone= mysqli_real_escape_string($conn,$_POST['phone']);
    $pass = md5($_POST['password']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $user_type = $_POST['user_type'];

    $select = "SELECT * FROM signup WHERE email ='$email'";


    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){

        $error[] = 'user already exist!';

    }else{
        $insert = "INSERT INTO signup(fname,email,phone,password,address,user_type) VALUES('$name','$email',' $phone','$pass','$address','$user_type')";
            
         mysqli_query($conn, $insert);
         header('location:userstable.php');
    }
    
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>add Admin</title>
    <link rel ="stylesheet" href ="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        
    </style>
</head>
<body>
<div class="sidebar">
<div class="logo"><h4>ONLINE PASAL</h4></div>
        <div class="logo"></div>
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
           <li >
            <a href="productstable.php">
            <!-- <i class="fa-solid fa-gift"></i> -->
            <i><img src="../img/product.png" class="side-icon"></i>
                <span>Products</span>
            </a>
           </li>
           <li class="active">
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
                <h2>Add New Admin</h2>
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
   <section>
        <div class="addadmin-box">
            <div class="addadmin-value">
                <form action="#" method="post">
                    <div class="addadminbox">
                        <input type="text" name="fname" required>
                        <label for="fullname">Fullname</label>
                    </div>
                    <div class="addadminbox">
                        <input type="email" name="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="addadminbox">
                        <input type="number" name="phone" required>
                        <label for="phone_no">Phone No</label>
                    </div>
                     <div class="addadminbox">
                        <input type="text" name="address" required>
                        <label for="address">Address</label>
                    </div>
                    <div class="addadminbox">
                        <input type="password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <select name="user_type"class="opt">
                    <option value="Admin">Admin</option>
                    </select>
                     <!-- <button>Submit</button>  -->
                    <input type="submit" name="submit" class="loginbtn" value="Add Admin">
                </form>
            </div>
        </div>
    </section>
</div>
</body>
</html>