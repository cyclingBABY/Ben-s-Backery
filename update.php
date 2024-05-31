<?php
include("conect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $pname = $_POST['fname'];
    $price = $_POST['lname'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Prepare SQL statement
    $update_sql = "UPDATE furstuart SET Fname='$pname', Lname='$price', Tel='$phone', Message='$message' WHERE id='$id'";

    // Execute SQL statement
    if ($mysqli->query($update_sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $mysqli->error;
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>thanks for contacting us</title>
</head>
<body>
    <div>
        <a href="customer_fd.php">back to Home</a>
    </div>
</body>
</html>




