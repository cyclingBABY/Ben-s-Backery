

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>@stuart ntumwa </title>
</head>
<body class="ntumwa">
<?php
    include("header2.php"); 
    include("conect.php");
    if(isset($_GET['product_id'])) {      
        $product_id = $_GET['product_id'];
        $product_name = $_GET['name'];
        $product_price = $_GET['price'];
        $image_url = $_GET['image_url'];

        // Function to sanitize input values
        function sanitize($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        // Process form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {          
            $customer_name = sanitize($_POST['customer_name']);
            $customer_contact = sanitize($_POST['customer_contact']);
            $payment_method = sanitize($_POST['payment_method']);
            $order_date = date("Y-m-d"); // Current date

            // Insert order details into the orders table
            $insert_sql = "INSERT INTO orders (product_name, total_price, customer_name, customer_contact, payment_method, order_date) 
                           VALUES ('$product_name', '$product_price', '$customer_name', '$customer_contact', '$payment_method', '$order_date')";
            if ($mysqli->query($insert_sql) === TRUE) {
                echo "Order placed successfully!" ;
            } else {
                echo "Error: " . $insert_sql . "<br>" . $mysqli->error;
            }
        }

        // Display the product details for confirmation along with the form
        echo '<h4>Product Details</h4>';
        echo '<div class="product-item">';
        echo '<div class="cake_bread-img">';
        echo '<img decoding="async" src="uploads/' . $image_url . '" alt="' . $product_name . '">';
        echo '</div>';
        echo '<div class="cake_bread-description">';
        echo '<h2 class="cake_bread-titile">' . $product_name . '</h2>';
        echo '<p><strong>Price:</strong> Ush ' . $product_price . ' UGX</p>';
        echo '</div>';
        echo '</div>';

        // Display the form for customer details and payment method
        echo '<h4>Customer Details</h4>';
        echo '<form method="post">';
        echo '<input type="text" name="customer_name" required placeholder="Enter Name"><br>';
        echo '<input type="date" name="order_date" required><br>'; 
        echo '<input type="text" name="customer_contact" required placeholder="Enter Phone Number"><br>';
        echo '<select class="input" name="payment_method" required placeholder="choose payment methode">';
        echo '<option value="Cash">Cash</option>';
        echo '<option value="Credit Card">Credit Card</option>';
        echo '</select><br>';
        echo '<input type="submit" value="Place Order" class="btn">';
        echo '</form>';

    } else {
        echo "Product ID not provided.";
    }

    $mysqli->close();

?>

</body>
<?php include 'footer.php' ?>
</html>
