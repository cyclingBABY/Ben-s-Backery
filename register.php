<?php
include 'config.php';
if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $select = "SELECT * FROM user_form WHERE email = '$email'";

    $result = mysqli_query($conn, $select);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if(mysqli_num_rows($result) > 0){
        $error[] = 'User already exists!';
    } else {
        if($pass != $cpass){
            $error[] = 'Passwords do not match!';
        } else {
            $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
            if(mysqli_query($conn, $insert)){
                header('location:login_form.php');
                exit; // Ensure script stops after redirection
            } else {
                die("Insert query failed: " . mysqli_error($conn));
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <title>Registion@ ben's</title>

   <!-- custom css file link  -->
   
</head>
<body>

<section class="welcome_1">
    <div class="main">
        <div class="content">
        <h1>Welcome to <span>Ben's</span> Bakery</h1>
<p class="par">
    Indulge in the irresistible taste of Uganda’s finest baked goods. At Ben's Bakery, we transform wheat into an array of delightful products that will captivate your senses.
    <br>As the leading cake producers in the country, we pride ourselves on delivering the highest quality and most delectable treats.
    <br>Join us in celebrating the art of baking, where every bite tells a story of passion, tradition, and excellence.
</p>

            <div id="events" class="events">
                <div id="events_title"></div>
                <div id="events_list">
                    <h1><span>For the best cakes in town</span></h1>
                    <div class="image-slider">
                        <img src="uploads/t.png" class="active">
                        <img src="uploads/Vegetable-Sambosa.png" alt="Vegetable Sambosa">
                        <img src="uploads/b1a87dce-ebe1-4275-ba1e-7fc9a20d50c8.png" alt="Product Image">
                        <img src="uploads/bab118db-30c0-4e66-9d0c-df48adf2708e.png" alt="Product Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
      
        <form action="" method="post">
      <h3>Register Now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         }
      }
      ?>
      <input type="text" name="name" required placeholder="Enter your name">
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="password" name="cpassword" required placeholder="Confirm your password">
      <select name="user_type">
         <option value="user">User</option>
      </select>
      <input type="submit" name="submit" value="Register Now" class="form-btn">
      <p>Already have an account? <a href="index.php" class="btn">Login Now</a></p>
   
      <div class="icons">
                    <a href="#"><ion-icon name="logo-facebook"></ion-icon></a>
                    <a href="#"><ion-icon name="logo-instagram"></ion-icon></a>
                    <a href="#"><ion-icon name="logo-twitter"></ion-icon></a>
                    <a href="#"><ion-icon name="logo-google"></ion-icon></a>
                    <a href="#"><ion-icon name="logo-skype"></ion-icon></a>
                </div>
    </form>
            </div>
        </div>
    </div>

    </section>
<style>
     input[type="email"],
 input[type="password"],
 input[type="text"],
 input[type="number"],
 input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
</style>
</body>
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
<script src="script.js"></script>
</html>
