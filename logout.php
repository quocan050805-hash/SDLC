<?php
session_start();

// Hủy session
session_destroy();

// Chuyển hướng về trang chủ
header('location: index.php');
exit();
?>
