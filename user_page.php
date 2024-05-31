<link rel="stylesheet" href="styles.css">
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
   <title>user_page</title>
   <link rel="stylesheet" href="styles.css">
   <link rel="stylesheet" href="style.css">

</head>
<body class="stuart">
   
<div class="container_stuart">

   <div class="content_welcome">
      <h3>@, <span>stuart Ntumwa 22/bit/bu/r/1001</span></h3>
      <h1>Welcome Back <br><span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p>this is Ben's Bakery Uganda feel free to buy any thing,and  remember we are the 
         only online platfom that refunds its customers in 2hrs after an invalid  purchase </p>
      <a href="user.php" class="btn">start purchase </a>
      <a href="logout.php" class="btn">logout</a>
   </div>
</div>

</body>
</html>
<style>
   .stuart {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, sans-serif;
    background-color: #f0f0f0; 
}

</style>