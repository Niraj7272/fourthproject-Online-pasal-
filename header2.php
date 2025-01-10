<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header with sub-menu</title>
    <style>
      .menu{
         /* background: gray; */
         background: rgb(155, 154, 154);
         text-align: center;
      }
      .menu ul{
         display: inline-flex;
         list-style: none;
         color: white;
      }
      .menu ul li{
          width: 300px;
      } 
      .menu ul li a{
         text-decoration: none;
         color: white;
        font-size: 25px;
      }
      .active, .menu ul li:hover{
         background: lightgreen;
         border-radius: 3px;
         margin: 10px;
      }
    </style>
</head>
<body>
    <div class="menu">
        <ul>
            <li class="active"><a href="products.php">Brand New Product</a></li>
            <li><a href="second_hand_product.php">Second Hand product</a></li>
        </ul>
    </div>
    
</body>
</html>