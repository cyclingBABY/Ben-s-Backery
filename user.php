<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ben's Bakery</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery for AJAX -->
</head>
<body>
<?php include "header2.php"; ?>

<div class="product-container container">
    <?php
    include("conect.php"); 
    $sql = "SELECT * FROM products";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product-item">';
            echo '<div class="cake_bread-img">';
            echo '<img decoding="async" src="uploads/' . $row['image_url'] . '" alt="' . $row['product_name'] . '">';
            echo '</div>';
            echo '<div class="cake_bread-description">';
            echo '<h2 class="cake_bread-titile">' . $row['product_name'] . '</h2>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<p class="cake_bread-price">Ush ' . $row['price'] . ' UGX</p>';
            echo '<button class="add-to-cart-btn" data-id="' . $row['id'] . '" data-name="' . $row['product_name'] . '" data-price="' . $row['price'] . '">Add to Cart</button>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "No products found.";
    }

    $mysqli->close();
    ?>
</div>

<!-- Cart Icon -->
<div class="cart-icon-container">
    <a href="view_cart.php">
        <img src="cart_icon.png" alt="Cart Icon">
        <span id="cart-count">0</span>
    </a>
</div>

<?php include 'footer.php'?>
<script>

$(document).ready(function() {
    $('.add-to-cart-btn').click(function(e) {
        e.preventDefault();
        
        const product_id = $(this).data('id');
        const product_name = $(this).data('name');
        const product_price = $(this).data('price');
        const product_image = $(this).closest('.product-item').find('img').attr('src'); // Get image URL

        // Check if item is already in the cart
        if ($(this).hasClass('added-to-cart')) {
            // Remove item from cart
            $.post('remove_from_cart.php', {
                product_id: product_id
            }, function(data) {
                $('#cart-count').text(data);
            });
            $(this).removeClass('added-to-cart').text('Add to Cart');
        } else {
            // Add item to cart
            $.post('add_to_cart.php', {
                product_id: product_id,
                product_name: product_name,
                product_price: product_price,
                product_image: product_image // Pass image URL
            }, function(data) {
                $('#cart-count').text(data);
            });
            $(this).addClass('added-to-cart').text('Remove from Cart');
        }
    });
});


</script>
</body>
</html>
