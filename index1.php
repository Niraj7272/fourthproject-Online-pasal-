<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <?php
        include 'header.php';
    ?>
     <div class="slider-box">
        <div id="slider">
             <img src="img/main/image1.jpeg">
             <img src="img/main/image2.jpeg">
            <img src="img/main/image3.jpeg">
            <img src="img/main/image4.jpeg"> 
        </div>
        <div class="indicators">
            <span id="btn1"></span>
            <span id="btn2"></span>
            <span id="btn3"></span>
            <span id="btn4"></span>

        </div> 
    </div>

    
    <script>
        var slide = document.getElementById("slider");
        var btn1 = document.getElementById("btn1");
        var btn2 = document.getElementById("btn2");
        var btn3 = document.getElementById("btn3");
        var btn4 = document.getElementById("btn4");

        btn1.onclick =function(){
            slide.style.transform ="translateX(0px)"; -->
            btn1.classList.add("active");
            btn2.classList.remove("active");
            btn3.classList.remove("active");
            btn4.classList.remove("active");
        }

        btn2.onclick =function(){
            slide.style.transform ="translateX(-100%)";
            btn1.classList.remove("active");
            btn2.classList.add("active");
            btn3.classList.remove("active");
            btn4.classList.remove("active");
        }

        btn3.onclick =function(){
            slide.style.transform ="translateX(-200%)";
            btn1.classList.remove("active");
            btn2.classList.remove("active");
            btn3.classList.add("active");
            btn4.classList.remove("active");
        }

        btn4.onclick =function(){
            slide.style.transform ="translateX(-300%)";
            btn1.classList.remove("active");
            btn2.classList.remove("active");
            btn3.classList.remove("active");
            btn4.classList.add("active");
        }
     
    </script>
    <?php
      include 'footer.php';
    ?>
</body>
</html>