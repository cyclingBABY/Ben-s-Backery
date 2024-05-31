<?php
ob_start();

include "header.php";
include("conect.php");

function handleFileUpload(&$uploadOk, &$target_file) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);

    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($_FILES["image"]["size"] > 5000000) { // 5MB limit
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
        $uploadOk = 0;
    }

    return basename($_FILES["image"]["name"]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $uploadOk = 1;
    $image_name = null;

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] != UPLOAD_ERR_NO_FILE) {
        $image_name = handleFileUpload($uploadOk, $target_file);
    } else {
        $uploadOk = 0;
    }

    if ($uploadOk == 1 || ($uploadOk == 0 && isset($_GET['product_id']))) {
        $stmt = null;
        if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
            $product_id = $_GET['product_id'];
            if ($uploadOk == 1) {
                $stmt = $mysqli->prepare("UPDATE products SET product_name=?, description=?, price=?, image_url=? WHERE id=?");
                $stmt->bind_param("ssdsi", $product_name, $description, $price, $image_name, $product_id);
            } else {
                $stmt = $mysqli->prepare("UPDATE products SET product_name=?, description=?, price=? WHERE id=?");
                $stmt->bind_param("ssdi", $product_name, $description, $price, $product_id);
            }
        } else {
            $stmt = $mysqli->prepare("INSERT INTO products (product_name, description, price, image_url) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssds", $product_name, $description, $price, $image_name);
        }

        if ($stmt && $stmt->execute()) {
            echo "Product " . (isset($_GET['product_id']) ? "edited" : "added") . " successfully";
            header("Location: ourpro.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    $mysqli->close();
} else {
    $product_name = '';
    $description = '';
    $price = '';
    $image_url = '';

    if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        $stmt = $mysqli->prepare("SELECT * FROM products WHERE id=?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $product_name = $row['product_name'];
            $description = $row['description'];
            $price = $row['price'];
            $image_url = $row['image_url'];
        } else {
            echo "Product not found.";
            exit();
        }
        $stmt->close();
    }
}
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add or Edit Product</title>
</head>
<body>

<div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Dear add What Will attract the customers</span>
                </div>

                <div class="form-container">
    <form action="" method="post" enctype="multipart/form-data">
        <?php if (isset($_GET['product_id']) && !empty($_GET['product_id'])) { ?>
            <input type="hidden" id="product_id" name="product_id" value="<?php echo $_GET['product_id']; ?>">
        <?php } ?>
        
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" placeholder="Product Name" value="<?php echo htmlspecialchars($product_name); ?>" required><br>
        
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" placeholder="Description" value="<?php echo htmlspecialchars($description); ?>" required><br>
        
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" placeholder="Price" step="0.01" value="<?php echo htmlspecialchars($price); ?>" required><br>
        
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" <?php if (empty($image_url)) echo "required"; ?> onchange="previewImage(event)"><br>
        <img id="preview" src="uploads/<?php echo htmlspecialchars($image_url); ?>" style="max-width: 200px; display: <?php echo empty($image_url) ? 'none' : 'block'; ?>;"><!-- Image preview -->

        <input type="submit" value="<?php echo isset($_GET['product_id']) ? 'Update Product' : 'Add Product'; ?>">
    </form>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
            </div>
        </div>
</body>
<?php include 'footer.php' ?>
</html>
