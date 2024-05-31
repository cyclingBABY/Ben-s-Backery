<?php
include 'header2.php';

if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
    exit;
}

$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total_price = 0;
$total_quantity = count($cart_items);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt - Ben's Bakery</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
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
        .cart-items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .cart-items-table th, .cart-items-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .cart-items-table th {
            background-color: #f2f2f2;
        }
        .cart-summary {
            margin-top: 20px;
            text-align: right;
        }
        .actions {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 20px;
            margin: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="receipt-container" id="receipt-container">
        <div class="business-info">
        <h1>Ben's Bakery</h1>
            <p>P.O. Box 4567, Kampala</p>
            <p>Tell: (+256) 701-7890</p>
        </div>

        <?php if ($total_quantity > 0): ?>
            <table class="cart-items-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    <?php foreach ($cart_items as $item): ?>
                        <tr data-id="<?php echo htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?php 
                            $image_path = htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8');
                            ?>
                            <td><img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>" style="width:100px;height:100px;"></td>
                            <td><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>UGX<?php echo number_format($item['price'], 2); ?></td>
                            <td><button class="remove-from-cart-btn" data-id="<?php echo htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8'); ?>">Remove</button></td>
                        </tr>
                        <?php
                        $total_price += floatval($item['price']);
                        ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="cart-summary">
                <p>Total Quantity: <?php echo $total_quantity; ?></p>
                <p>Total Price: UGX<?php echo number_format($total_price, 2); ?></p>
            </div>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <div class="actions">
        <button class="btn" id="print-receipt">Print Order</button>
        <button class="btn" id="download-receipt">Download Order</button>
        <a href="checkout.php" class="btn">Proceed to Checkout</a>
    </div>

    <script>
    $(document).ready(function() {
        $('.remove-from-cart-btn').click(function(e) {
            e.preventDefault();

            const product_id = $(this).data('id');
            const button = $(this);

            $.post('remove_from_cart.php', {
                product_id: product_id
            }, function(data) {
                button.closest('tr').remove();

                $('#cart-count').text(data);

                let totalPrice = 0;
                let totalQuantity = 0;
                $('#cart-items tr').each(function() {
                    totalQuantity++;
                    const priceText = $(this).find('td').eq(2).text().split('UGX')[1];
                    totalPrice += parseFloat(priceText);
                });
                $('.cart-summary').html('<p>Total Quantity: ' + totalQuantity + '</p><p>Total Price: $' + totalPrice.toFixed(2) + '</p>');

                if (data == 0) {
                    $('#cart-items').replaceWith('<p>Your cart is empty.</p>');
                }
            });
        });

        $('#print-receipt').click(function() {
            window.print();
        });

        $('#download-receipt').click(function() {
            const receiptContainer = document.getElementById('receipt-container').outerHTML;
            const blob = new Blob([receiptContainer], { type: 'text/html' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'receipt.html';
            link.click();
        });
    });
    </script>
</body>
</html>
