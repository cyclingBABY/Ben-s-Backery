<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if product is already in the cart
    $found = false;
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $product_id) {
            // Remove product from cart
            unset($_SESSION['cart'][$key]);
            $found = true;
            break;
        }
    }

    // If not found, add product to cart
    if (!$found) {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image']; // Ensure this field is posted

        $_SESSION['cart'][] = [
            'id' => htmlspecialchars($product_id, ENT_QUOTES, 'UTF-8'),
            'name' => htmlspecialchars($product_name, ENT_QUOTES, 'UTF-8'),
            'price' => htmlspecialchars($product_price, ENT_QUOTES, 'UTF-8'),
            'image' => htmlspecialchars($product_image, ENT_QUOTES, 'UTF-8')
        ];
    }

    // Return the updated cart count
    echo count($_SESSION['cart']);
    exit;
}
?>
