<?php
include("header.php");
include("conect.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $edit_sql = "SELECT * FROM feedback WHERE id = $id";
    $result = $mysqli->query($edit_sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit</title>
</head>
<body>

<form action="update.php" method="POST" id="edit-form">
    <h1>EDIT</h1>

    <label for="fname">First Name:</label><br>
    <input type="text" name="fname" id="fname" value="<?php echo $row['FName'];?>" required><br>

    <label for="lname">Last Name:</label><br>
    <input type="text" name="lname" id="lname" value="<?php echo $row['LName'];?>" required><br>

    <label for="phone">Telephone Number:</label><br>
    <input type="text" name="phone" id="phone" value="<?php echo $row['Tel'];?>" required><br>

    <label for="message">Message:</label><br>
    <input type="text" name="message" id="message" value="<?php echo $row['Message'];?>" required><br>

    <input type="hidden" name="id" value="<?php echo $row['id'];?>">
    <input type="submit" value="Update"><br>
</form>

<?php
$mysqli->close();
?>
</body>
<?php include 'footer.php' ?>
</html>
