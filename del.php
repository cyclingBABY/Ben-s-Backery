<?php
include("conect.php"); 

if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql = "DELETE FROM products WHERE id = ?";
    
    if($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $product_id);

        if($stmt->execute()) {

            header("location: ourpro.php");
            exit();
        } else {
            echo "Error deleting product.";
        }
    }
    
    $stmt->close();
}

$mysqli->close();
?>
