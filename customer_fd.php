<?php
include("header.php");
include("conect.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>customer feedback</title>
</head>

<body class="swafa">
    

<?php

$sql = "SELECT * FROM feedback";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
    <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Telephone</th>
    <th>Message</th>
    <th>Action</th>
    </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['FName'] . "</td>";
        echo "<td>" . $row['LName'] . "</td>";
        echo "<td>" . $row['Tel'] . "</td>";
        echo "<td>" . $row['Message'] . "</td>";
        // Edit and delete buttons
        echo "<td>
                <a href=\"edit.php?id={$row['id']}\" id=\"edit-{$row['id']}\">Edit</a> | 
                <a href=\"delete.php?id={$row['id']}\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No data found</p>";
}

$mysqli->close();
?>
</body>
<?php include 'footer.php' ?>
</html>
<style>
 
</style>