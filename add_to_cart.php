<?php
session_start();
include("db.php");

// Lấy id sản phẩm
$id = $_GET['id'];

// Nếu giỏ hàng chưa tồn tại thì tạo mới
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Nếu sản phẩm đã có trong giỏ → tăng số lượng
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['quantity'] += 1;
} else {
    // Lấy thông tin sản phẩm từ DB
    $sql = "SELECT * FROM product WHERE product_id = $id";
    $result = mysqli_query($connect, $sql);
    $product = mysqli_fetch_assoc($result);

    $_SESSION['cart'][$id] = [
        'name' => $product['product_name'],
        'price' => $product['product_price'],
        'image' => $product['product_image'],
        'quantity' => 1
    ];
}

// Chuyển lại về homepage hoặc trang giỏ hàng
header("Location: shoppingcart.php");
exit;
