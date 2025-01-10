<?php 
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header with sub-menu</title>
    <style>
.menu-bar{
    background: rgb(199, 198, 198);
    height: 60px;
}

.menu-bar ul{
    display: inline-flex;
    list-style: none;
    color: white;
}
.menu-bar ul li{
    width: 120px;
} 
.menu-bar ul li a{
    text-decoration: none;
    color: black;
    font-size: 20px;
    padding-top: 10px;
    margin-left: 20px;
}
.menu-bar ul li:hover{
    background: lightgreen;
    border-radius: 3px;
    /* margin: 10px; */
}
    </style>
</head>
<body>
    <div class="menu-bar">
        <ul>
            <li><a href="second_hand_product.php">All</a></li>
            <?php
            $query ="SELECT * FROM category";
            $result = $conn->query($query);
            if($result->num_rows> 0){
              $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
            }
            foreach ($options as $option) {
             if($option['category_name']!=='electronic'){
                continue;
             }
            ?>
            <li class=""><a href="./second_hand_product.php?cat=<?php echo $option["category_name"]?>"><?php echo $option["category_name"];}?></a></li>
            
        </ul>
    </div>
    
</body>
</html>