<?php

include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <title>User side @stuart Ntumwa</title> 
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.jpg" alt="">
            </div>

            <span class="logo_name">Ben's Bakery</span>
        </div>

        <div class="menu-items">
        <ul class="nav-links">
        
        <li><a href="user.php">
    <i class="uil uil-apps"></i>
    <span class="link-name">All categories</span>
</a></li>
<li><a href="about.php">
    <i class="uil uil-info-circle"></i>
    <span class="link-name">About Us</span>
</a></li>
<li><a href="contact.php">
    <i class="uil uil-envelope"></i>
    <span class="link-name">Contact Us</span>
</a></li>
      
    </ul>
            
            <ul class="logout-mode">
                <li><a href="index.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>
          
                    
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
            <h1><br><span><?php echo $_SESSION['user_name'] ?></span></h1>
            <marquee behavior="left" direction="">stuart Ntumwa 22/BIT/BU/R/1001 ---------conatct------ <span>0781072868</span> </marquee>
            <a href="cart.php" id="cart-icon">
            <i class="fa fa-shopping-cart cart-icon"></i><span id="cart-count" class="btn">0</span>

        </a>
        </div>
       <style>
        /* Add this to your style.css file */

</style>
    </section>

    <script src="script.js">


$(document).ready(function() {
    $('.add-to-cart-btn').click(function(e) {
        e.preventDefault();
        
        const product_id = $(this).data('id');
        const product_name = $(this).data('name');
        const product_price = $(this).data('price');

        $.post('add_to_cart.php', {
            product_id: product_id,
            product_name: product_name,
            product_price: product_price
        }, function(data) {
            $('#cart-count').text(data);
        });
    });
});
    </script>
</body>
</html>