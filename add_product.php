<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: "Segoe UI", Arial, sans-serif;
        background: linear-gradient(135deg, #f5e3c3, #f7d9aa);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form-container {
        width: 340px; /* Smaller size */
        background: #ffffff;
        padding: 25px;
        border-radius: 18px;
        box-shadow: 0 7px 25px rgba(0,0,0,0.12);
        animation: fadeIn 0.4s;
        border: 2px solid #f1c08b;
    }

    h2 {
        text-align: center;
        margin-bottom: 15px;
        color: #c17015;
        font-size: 22px;
        letter-spacing: 1px;
    }

    .form-group {
        margin-bottom: 12px;
    }

    label {
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 5px;
        display: block;
        color: #6c4e27;
    }

    input {
        width: 100%;
        padding: 8px;
        border-radius: 10px;
        border: 1px solid #d1b89b;
        font-size: 13px;
        transition: 0.3s;
        background: #fff8f0;
    }

    input:focus {
        border-color: #c9832b;
        box-shadow: 0 0 6px rgba(206, 102, 18, 0.4);
        outline: none;
    }

    input[type="file"] { 
        border: none;
        background: none;
        padding: 4px;
    }

    button {
        width: 100%;
        padding: 10px;
        background: #c9832b;
        color: white;
        font-size: 15px;
        font-weight: bold;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 8px;
    }

    button:hover {
        background: #a45e12;
        transform: translateY(-1px);
    }

    /* Back button */
    .back-btn {
        margin-top: 12px;
        width: 100%;
        text-align: center;
        display: block;
        padding: 9px;
        background: #6e6e6e;
        color: white;
        font-size: 14px;
        font-weight: bold;
        border-radius: 10px;
        text-decoration: none;
        transition: 0.3s;
    }

    .back-btn:hover {
        background: #464646;
        transform: translateY(-1px);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.97); }
        to { opacity: 1; transform: scale(1); }
    }
</style>

</head>
<body>

<div class="form-container">
    <h2>Add Product</h2>

    <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label>Product ID:</label>
            <input type="text" name="product_id" required>
        </div>

        <div class="form-group">
            <label>Product Name:</label>
            <input type="text" name="product_name" required>
        </div>

        <div class="form-group">
            <label>Product Price:</label>
            <input type="text" name="product_price" required>
        </div>

        <div class="form-group">
            <label>Quantity:</label>
            <input type="text" name="quantity" required>
        </div>

        <div class="form-group">
            <label>Product Image:</label>
            <input type="file" name="product_img" required>
        </div>

        <div class="form-group">
            <label>Description:</label>
            <input type="text" name="product_description">
        </div>

        <div class="form-group">
            <label>Supplier:</label>
            <input type="text" name="product_supplier">
        </div>

        <div class="form-group">
            <label>Category ID:</label>
            <input type="text" name="category_id">
        </div>

        <button type="submit" name="add_product">Add Product</button>

        <a href="index.php" class="back-btn">⟵ Back to Home</a>

    </form>
</div>


<?php 
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "se07301_sdlc";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_product"])) {

    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $quantity = $_POST["quantity"];
    $product_description = $_POST["product_description"];
    $product_supplier = $_POST["product_supplier"];
    $category_id = $_POST["category_id"];

    $product_img = $_FILES["product_img"]["name"];
    $product_img_tmp = $_FILES["product_img"]["tmp_name"];

    $target_dir = "images/";

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    move_uploaded_file($product_img_tmp, $target_dir . $product_img);

    $sql = "INSERT INTO product VALUES 
    ('$product_id', '$product_name', '$product_price', '$quantity', '$product_description', '$product_img', '$product_supplier', '$category_id')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Product added successfully!');</script>";
    } else {
        echo "<script>alert('Failed to add product!');</script>";
    }
}
?>

</body>
</html>
