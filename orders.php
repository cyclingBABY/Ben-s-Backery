<?php
    include("header.php");
    include("conect.php"); 

    // Fetch data from the orders table, ordered by id in descending order
    $sql = "SELECT * FROM orders ORDER BY id DESC";
    $result = $mysqli->query($sql);

    echo "<div class='orders-table'>";
    echo "<h2 class='title'>Orders</h2>";

    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Product Name</th><th>Total Price</th><th>Customer Name</th><th>Customer Contact</th><th>Payment Method</th><th>Order Date</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["product_name"] . "</td>";
            echo "<td>" . $row["total_price"] . "</td>";
            echo "<td>" . $row["customer_name"] . "</td>";
            echo "<td>" . $row["customer_contact"] . "</td>";
            echo "<td>" . $row["payment_method"] . "</td>";
            echo "<td>" . $row["order_date"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No orders found.";
    }

    echo "</div>";

    $mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>orders@ben's</title>
</head>
<body>
    
</body>
<?php include 'footer.php' ?>
</html>