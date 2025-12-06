<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Your Cart</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    margin: 0;
    padding: 20px;
}

h2 {
    text-align: center;
    color: #333;
}

table {
    width: 90%;
    margin: 25px auto;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

th {
    background: #ff7b00;
    color: white;
    font-size: 18px;
    padding: 14px;
}

td {
    padding: 12px;
    border-bottom: 1px solid #eee;
    font-size: 16px;
}

img {
    width: 75px;
    border-radius: 8px;
}

.total-row td {
    font-weight: bold;
    font-size: 18px;
    background: #fff4e6;
}

.empty {
    text-align: center;
    padding: 25px;
    font-size: 18px;
}

/* Nút quay lại */
.back-btn {
    display: block;
    width: 200px;
    margin: 25px auto;
    padding: 12px 0;
    text-align: center;
    background: #ff7b00;
    color: white;
    font-size: 18px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    box-shadow: 0 3px 6px rgba(0,0,0,0.2);
    transition: 0.2s;
}

.back-btn:hover {
    background: #e26e00;
    transform: scale(1.05);
}
</style>

</head>
<body>

<h2>Shopping Cart</h2>

<table>
<tr>
    <th>Image</th>
    <th>Name</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
</tr>

<?php
$grandTotal = 0;

if (!empty($_SESSION['cart'])) {

    foreach ($_SESSION['cart'] as $id => $item) {

        $itemTotal = $item['quantity'] * $item['price'];
        $grandTotal += $itemTotal;

        echo "
        <tr>
            <td><img src='images/{$item['image']}'></td>
            <td>{$item['name']}</td>
            <td>" . number_format($item['price']) . " đ</td>
            <td>{$item['quantity']}</td>
            <td>" . number_format($itemTotal) . " đ</td>
        </tr>
        ";
    }

    echo "
    <tr class='total-row'>
        <td colspan='4' style='text-align:right;'>Grand Total:</td>
        <td>" . number_format($grandTotal) . " đ</td>
    </tr>
    ";

} else {
    echo "<tr><td colspan='5' class='empty'>Your cart is empty</td></tr>";
}
?>

</table>

<!-- NÚT QUAY LẠI TRANG CHỦ -->
<a href="index.php" class="back-btn">← Back to Home</a>

</body>
</html>
