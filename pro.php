<?php
include("conect.php");
extract($_POST);
$sql = "INSERT INTO `feedback`(`FName`, `LName`, `Tel`, `Message`) VALUES ('".$fname."','".$lname."','".$phone."','".$message."')";
$result = $mysqli->query($sql);
if(!$result){
    die("Couldn't enter data: ".$mysqli->error);
}
echo "Ben's Backery ";
$mysqli ->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>thanks</title>
</head>
<body>
    <div>
    <a class="btn"   href="contact.php">back to home</a>
    </div>
</body>
</html>