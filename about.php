<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Welcome - Com Sau Que</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        background: #f0f2f5;
    }

    .wrapper {
        width: 900px;
        margin: 90px auto;
        padding: 50px;
        text-align: center;
        background: linear-gradient(90deg, #ff7b00, #ff5e00);
        border-radius: 20px;
        color: white;
        box-shadow: 0 8px 25px rgba(0,0,0,0.20);
    }

    .wrapper h1 {
        font-size: 40px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .wrapper p {
        font-size: 20px;
        margin-bottom: 40px;
        font-weight: 300;
    }

    .home-btn {
        display: inline-block;
        background: white;
        color: #ff6600;
        padding: 15px 35px;
        font-size: 20px;
        font-weight: 700;
        border-radius: 35px;
        text-decoration: none;
        box-shadow: 0 5px 15px rgba(255,255,255,0.45);
        transition: 0.3s;
    }

    .home-btn:hover {
        transform: scale(1.08);
    }

    .logo {
        margin-bottom: 30px;
    }

    .logo img {
        height: 120px;
        filter: drop-shadow(0px 4px 10px rgba(0,0,0,0.3));
    }
</style>

</head>
<body>

<div class="wrapper">

    <div class="logo">
        <img src="https://th.bing.com/th/id/R.e632436d5d867362413fe850f97d4c02?rik=NcARpHNw3FxUBA&pid=ImgRaw&r=0">
    </div>

    <h1>👋 Welcome to Com Sau Que</h1>

    <p>
        Thank you for visiting our system.<br>
        We wish you a great, fast and convenient shopping experience!
    </p>

    <a href="index.php" class="home-btn">⬅ Go to Home Page</a>

</div>

</body>
</html>
