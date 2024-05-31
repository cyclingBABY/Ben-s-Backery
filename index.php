<?php
include 'config.php';
session_start();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);

    $select = "SELECT * FROM user_form WHERE email = '$email' AND password = '$pass'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            header('location:admin.php');
        } elseif ($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            header('location:user.php');
        }
    } else {
        $error[] = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ben's Bakery</title>
    <link rel="stylesheet" href="style.css">
    <style>
      
    </style>
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
    
        <div class="form">
            <div class="form-container">
                <form action="" method="post">
                    <h3>Login Now</h3>
                    <?php
                    if (isset($error)) {
                        foreach ($error as $error) {
                            echo '<span class="error-msg">' . $error . '</span>';
                        }
                    }
                    ?>
                    <input type="email" name="email" required placeholder="Enter your email">
                    <input type="password" name="password" required placeholder="Enter your password">
                    <input type="submit" name="submit" value="Login Now" class="form-btn">
                    <p>Don't have an account? <a href="register.php" class="btn">Register Now</a></p>
                </form>
                <div class="icons">
                    <a href="#"><ion-icon name="logo-facebook"></ion-icon></a>
                    <a href="#"><ion-icon name="logo-instagram"></ion-icon></a>
                    <a href="#"><ion-icon name="logo-twitter"></ion-icon></a>
                    <a href="#"><ion-icon name="logo-google"></ion-icon></a>
                    <a href="#"><ion-icon name="logo-skype"></ion-icon></a>
                </div>
            </div>
        </div>
    </div>

    </section>
    
    <script>
        const images = document.querySelectorAll('.image-slider img');
        let currentImage = 0;

        function showImage(index) {
            images.forEach((image, i) => {
                if (i === index) {
                    image.classList.add('active');
                } else {
                    image.classList.remove('active');
                }
            });
        }

        function nextImage() {
            currentImage = (currentImage + 1) % images.length;
            showImage(currentImage);
        }

        setInterval(nextImage, 3000);
    </script>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>
