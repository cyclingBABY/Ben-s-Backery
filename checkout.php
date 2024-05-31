<?php

include 'conect.php';
include 'header2.php';

if (!isset($_SESSION['user_name'])) {
    header('Location: login_form.php');
    exit;
}

$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total_price = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($cart_items)) {
        echo "Your cart is empty. Please add items before placing an order.";
        exit;
    }

    $customer_name = $_SESSION['user_name'];
    $customer_contact = $_POST['customer_contact'];
    $payment_method = $_POST['payment_method'];
    $order_date = date('Y-m-d');

    $success_count = 0;

    if ($stmt = $mysqli->prepare("INSERT INTO orders (product_name, total_price, customer_name, customer_contact, payment_method, order_date) VALUES (?, ?, ?, ?, ?, ?)")) {
        foreach ($cart_items as $item) {
            $product_name = $item['name'];
            $product_price = $item['price'];

            $stmt->bind_param("sdssss", $product_name, $product_price, $customer_name, $customer_contact, $payment_method, $order_date);

            if ($stmt->execute()) {
                $success_count++;
            }
        }
        $stmt->close();

        if ($success_count == count($cart_items)) {
            echo "All orders placed successfully!";
        } else {
            echo "Some orders failed to be placed. Please try again later.";
        }

        unset($_SESSION['cart']);
        exit;
    } else {
        echo "Error preparing statement: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* CSS styles */
    </style>
</head>
<body class="stuart">
    <div class="receipt-container">
        <div class="business-info">
            <h1>Ben's Bakery</h1>
            <p>P.O. Box 4567, Kampala</p>
            <p>Tell: (+256) 701-7890</p>
        </div>

        <h1>Checkout</h1>
        <?php if (count($cart_items) > 0): ?>
            <table class="cart-items">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                </tr>
                <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td>
                            <img src="<?php echo $item['image']; ?>" alt="<?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                        <td>UGX<?php echo htmlspecialchars($item['price'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <?php
                    $total_price += floatval($item['price']);
                    ?>
                <?php endforeach; ?>
            </table>
            <div class="cart-summary">
                <p>Total Quantity: <?php echo count($cart_items); ?></p>
                <p>Total Price: UGX<?php echo number_format($total_price, 2); ?></p>
            </div>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>

        <form action="" method="post">
            <p>Name: <?php echo htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8'); ?></p>
            <label for="customer_contact">Contact:</label>
            <input type="text" name="customer_contact" id="customer_contact" required>
            <label for="payment_method">Payment Method:</label>
            <select name="payment_method" id="payment_method" required>
                <option value="Credit Card">Credit Card</option>
                <option value="PayPal">PayPal</option>
                <option value="MTN Mobile Money">MTN Mobile Money</option>
                <option value="Airtel Money">Airtel Money</option>
            </select>
            <button type="submit" class="btn" ><a href="userwon.php">Place Order</a></button>
        </form>
        
        <a href="home.php" class="btn">Back to Home</a> <!-- This button takes the user back to the home page -->
    </div>
</body>
<style>
        .receipt-container {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }
        .business-info {
            text-align: center;
            margin-bottom: 20px;
        }
        .cart-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .cart-items th, .cart-items td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .cart-items img {
            width: 100px;
            height: 100px;
            margin-right: 10px;
        }
        .cart-summary {
            margin-top: 20px;
            text-align: right;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</html>
