<?php
include 'config.php';
session_start();

    if(isset($POST['add_to_cart']))
    {
        if(isset($_SESSION['cart']))
        {
            $myitem=array_column($_SESSION['cart'],'productName');
            if(in_array($_POST['productName'],$myitem))
            {
                echo"<script>
                        alert('Item Already Added');
                        window.location.href='products.php';
                    </script>";
            }
            $count = count($_SESSION['cart']);
            $_SESSION['cart'][$count]=array('productName'=>$_POST['productName'],'price'=>$_POST['price'],'quantity'=>1);
            print_r($_SESSION['cart']);
        }
        else
        {
            $_SESSION['cart'][0]=array('productName'=>$_POST['productName'],'price'=>$_POST['price'],'quantity'=>1);
            print_r($_SESSION['cart']);
            echo"<script>
                   alert('Item Added');
                   window.location.href='products.php';
              </script>";
        }
    }

?>