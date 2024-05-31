<?php
include("header.php");
include("fd.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete_sql = "DELETE FROM feedback WHERE id = $id";
    
    if ($mysqli->query($delete_sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }
}
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>deleton done</title>
</head>
<body>
    <div>
        <a href="contact.php">back to home page</a>
    </div>
</body>
</html>
