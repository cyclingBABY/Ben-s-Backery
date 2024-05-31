<?php

include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
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

    <title>Admin Dashboard Panel</title> 
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
        <li><a href="admin.php">
            <i class="uil uil-estate"></i>
            <span class="link-name">Dashboard</span>
        </a></li>
        <li><a href="ourpro.php">
            <i class="uil uil-edit"></i>
            <span class="link-name">Edit Product</span>
        </a></li>
        <li><a href="add.php">
            <i class="uil uil-plus-circle"></i>
            <span class="link-name">Add Product</span>
        </a></li>
        <li><a href="product.php">
            <i class="uil uil-box"></i>
            <span class="link-name">Product</span>
        </a></li>
        <li><a href="orders.php">
            <i class="uil uil-receipt"></i>
            <span class="link-name">Order</span>
        </a></li>
        <li><a href="customer_fd.php">
            <i class="uil uil-comment-alt-dots"></i>
            <span class="link-name">Feedback</span>
        </a></li>
        <li><a href="admin_user.php">
            <i class="uil uil-user-plus"></i>
            <span class="link-name">+Admin</span>
        </a></li>
    </ul>
            
            <ul class="logout-mode">
                <li><a href="index.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>
                <div class="stuart">
   
   <div class="container_stuart">
   
      <div class="content_welcome">
         <h1><span><?php echo $_SESSION['admin_name'] ?></span></h1>
      </div>
   </div>
   
   </div>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
            <marquee behavior="left" direction="">stuart Ntumwa 22/BIT/BU/R/1001 ---------conatct------ <span>0781072868</span> </marquee>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>