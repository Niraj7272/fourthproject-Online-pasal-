<?php
session_start();
include 'config.php';
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main home page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="indexbody">
    <div class="header">
    <?php
      include 'header.php';
    ?>
    </div>
    <div id="main">
        <img class="indeximg" src="img/main/image6.jpg" id="slideimage">
    </div>

    <script>
        function first(){
            document.getElementById("slideimage").src="img/main/image11.jpeg";
        }
        function second(){
            document.getElementById("slideimage").src="img/main/image8.webp";
        }
        function third(){
            document.getElementById("slideimage").src="img/main/image9.webp";
        }
        function fourth(){
            document.getElementById("slideimage").src="img/main/image10.jpg";
        }
        function fifth(){
            document.getElementById("slideimage").src="img/main/image6.jpg";
        }
        setInterval(first,4000);
        setInterval(second,8000);
        setInterval(third,12000);
        setInterval(fourth,16000);
        setInterval(fifth,20000);
    
    </script>
    <?php
     include 'foot.php';
    ?>
</body>
</html>