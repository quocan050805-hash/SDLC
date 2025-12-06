<?php
// Kết nối database
include('db.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BTEC Store</title>

  <!-- FONT -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: "Poppins", Arial, sans-serif; }
    body { background: #f0f2f5; }

    .wrapper { width: 1100px; margin: 30px auto; background: #ffffff; border-radius: 12px;
      overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.15); }

    /* HEADER */
    .header {
      height: 85px; display: flex; align-items: center; padding: 0 25px;
      background: linear-gradient(90deg, #ff7b00, #ff5e00);
    }
    .logo img { height: 70px; }

    #form_search { margin-left: auto; }
    #form_search input[type=text] {
      height: 38px; width: 280px; padding-left: 10px; border-radius: 20px;
      border: 1px solid #ddd; outline: none; transition: 0.3s;
    }
    #form_search input[type=submit] {
      height: 40px; background: white; color: #ff6600; border: 2px solid white;
      font-weight: bold; padding: 5px 15px; margin-left: 10px; border-radius: 20px;
      cursor: pointer; transition: 0.3s;
    }

    /* MENU */
    .menu { background: #333; height: 50px; }
    .menu ul { list-style: none; display: flex; justify-content: center; align-items: center;
      height: 100%; gap: 25px; }
    .menu ul li a { color: white; font-size: 18px; font-weight: 600; text-decoration: none; }

    /* CONTENT */
    .content { display: flex; }

    .left { width: 23%; background: #222; color: white; min-height: 580px; }
    .left p { background: #ff6600; padding: 12px; font-size: 20px; text-align: center; font-weight: bold; }
    .category ul { padding: 15px 20px; }
    .category ul li a {
      color: #eee; font-size: 17px; text-decoration: none; display: block; padding: 6px 0;
    }

    .right { width: 77%; padding: 25px; }
    .right p { font-size: 24px; color: #444; font-weight: bold; margin-bottom: 20px; }

    .products_box { display: flex; flex-wrap: wrap; gap: 25px; }

    .single_product {
      width: 230px; background: #ffffff; border-radius: 12px; padding: 12px;
      box-shadow: 0 3px 12px rgba(0,0,0,0.12); text-align: center; transition: 0.3s;
    }
    .single_product img { width: 190px; height: 190px; border-radius: 10px; object-fit: cover; }

    .single_product button {
      background: #ff6600; color: white; border: none; padding: 8px 14px;
      border-radius: 20px; cursor: pointer; font-weight: bold; transition: 0.3s;
      margin: 4px;
    }

    .footer { background: #333; height: 90px; margin-top: 20px; }
  </style>
</head>

<body>

  <div class="wrapper">

    <!-- HEADER -->
    <div class="header">
      <div class="logo">
        <img src="https://th.bing.com/th/id/R.e632436d5d867362413fe850f97d4c02?rik=NcARpHNw3FxUBA&pid=ImgRaw&r=0">
      </div>

      <div id="form_search">
        <form method="get" action="">
          <input type="text" name="user_query" placeholder="Search a Product...">
          <input type="submit" name="search" value="Search">
        </form>
      </div>
    </div>

    <!-- MENU -->
    <div class="menu">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="shoppingcart.php">Cart</a></li>
        <li><a href="add_product.php">add product</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        
        
      </ul>
    </div>

    <div class="content">

      <!-- LEFT -->
      <div class="left">
        <p>Product Type</p>
        <div class="category">
          <ul>
            <li><a href="#">Bun</a></li>
            <li><a href="#">Pho</a></li>
            <li><a href="#">Pom</a></li>
            <li><a href="#">Banh</a></li>
          </ul>
        </div>
      </div>

      <!-- RIGHT -->
      <div class="right">

      <?php  
      // Nếu người dùng bấm tìm kiếm
      if (isset($_GET['search']) && !empty($_GET['user_query'])) {

          $search_keyword = mysqli_real_escape_string($connect, $_GET['user_query']);

          echo "<p>Search result for: <span style='color:#ff6600;'>$search_keyword</span></p>";

          $sql = "SELECT * FROM product 
                  WHERE product_name LIKE '%$search_keyword%'";

      } else {
          echo "<p>All Products</p>";
          $sql = "SELECT * FROM product";
      }

      $result = mysqli_query($connect, $sql);
      ?>

      <div class="products_box">
      <?php
      if (mysqli_num_rows($result) > 0) {

          while ($row = mysqli_fetch_assoc($result)) {
              $id    = $row['product_id'];
              $name  = $row['product_name'];
              $price = $row['product_price'];
              $image = $row['product_image'];
      ?>
          <div class="single_product">
            <h3><?php echo $name; ?></h3>
            <img src="images/<?php echo $image; ?>">
            <p><b><?php echo number_format($price); ?> đ</b></p>

            <a href="detail.php?id=<?php echo $id; ?>">
              <button>Detail</button>
            </a>

            <a href="add_to_cart.php?id=<?php echo $id; ?>">
              <button>Add to cart</button>
            </a>
          </div>
      <?php
          }

      } else {
          echo "<p style='font-size:20px;color:#777;margin-top:20px;'>Không tìm thấy sản phẩm nào!</p>";
      }
      ?>
      </div>

      </div>
    </div>

  </div>

  <div class="footer"></div>

</body>
</html>
