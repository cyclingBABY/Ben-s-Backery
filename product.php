<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ben's Bakery</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
 <?php include"header.php" ?>
      <?php
          include("conect.php");
          $sql = "SELECT * FROM products";
          $result = $mysqli->query($sql);

          if ($result->num_rows > 0) {
              echo '<div class="product-container container">';
              while ($row = $result->fetch_assoc()) {
                  echo '<div class="product-item">';
                  echo '<div class="cake_bread-img">';
                  echo '<img decoding="async" src="uploads/' . $row['image_url'] . '" alt="' . $row['product_name'] . '">';
                  echo '</div>';
                  echo '<div class="cake_bread-description">';
                  echo '<h2 class="cake_bread-titile">' . $row['product_name'] . '</h2>';
                  echo '<p>' . $row['description'] . '</p>';
                  echo '<p class="cake_bread-price">Ush ' . $row['price'] . ' UGX</p>';
                  echo '</div>';
                  echo '</div>';
              }
              echo '</div>';
          } else {
              echo "No products found.";
          }

          $mysqli->close();
?>

    </div>
  </section>
  <?php include 'footer.php' ?>
</body>
</html>