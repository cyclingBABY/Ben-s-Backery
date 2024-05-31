<?php include"header.php" ?>

<?php
include("conect.php");
extract($_POST);
$sql = "INSERT INTO `furstuart`(`FName`, `LName`, `Tel`, `Message`) VALUES ('".$pname."','".$price."','".$phone."','".$message."')";
$result = $mysqli->query($sql);
if(!$result){
    die("Couldn't enter data: ".$mysqli->error);
}
echo "Ben's Bakery Uganda wishes you a safe day!";
$mysqli->close();
?>

<style>
/* CSS Styles */
body {
  font-family: Arial, sans-serif;
  text-align: center;
  background-color: #f0f0f0;
}

.message {
  margin-top: 20px;
  font-size: 18px;
  color: #333;
}

.button {
  margin-top: 20px;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.button:hover {
  background-color: #0056b3;
}
</style>

<div class="message">Your order is being worked on!</div>
<br>
<button class="btn" onclick="window.location.href='index.php';">Return to Home</button>
