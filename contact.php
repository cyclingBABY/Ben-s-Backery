<?php include "header2.php"   ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Contact</title>
</head>
<body>

<form action="pro.php" method="POST" id="contact-form" class="form">
    <h1>CONTACT US</h1>

    <label for="fname">First Name:</label><br>
    <input type="text" name="fname" id="fname" required><br>

    <label for="lname">Last Name:</label><br>
    <input type="text" name="lname" id="lname" required><br>

    <label for="phone">Telephone Number:</label><br>
    <input type="text" name="phone" id="phone" required><br>

    <label for="message">Enter your message below we shall get back to you as soon as possible:</label><br>
    <input type="text" name="message" id="message" required><br>

    <input type="submit" value="submit"><br> 
</form>

</body>
<?php include 'footer.php'?>
</html>
