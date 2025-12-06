<?php
session_start();
@include('db.php');

$error = array();

if (isset($_POST['login'])) {
    
    if (!isset($connect) || mysqli_connect_errno()) {
        $error[] = "Lỗi kết nối Database. Vui lòng thử lại sau.";
    } else {
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $pass = $_POST['pass'];

        if (empty($email) || empty($pass)) {
            $error[] = "Vui lòng nhập đầy đủ Email và Mật khẩu.";
        } else {
            
            $select = "SELECT * FROM `Users` WHERE Email = '$email'";
            $result = mysqli_query($connect, $select);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                
                if (password_verify($pass, $row['Password'])) {
                    
                    $_SESSION['user_id'] = $row['UserID'];
                    $_SESSION['fullname'] = $row['FullName'];
                    $_SESSION['role_id'] = $row['RoleID']; 
                    
                    header('location: index.php');
                    exit();
                    
                } else {
                    $error[] = "Mật khẩu không chính xác.";
                }
            } else {
                $error[] = "Không tìm thấy tài khoản với Email này.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập Hệ Thống</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style type="text/css">
        /* CSS FORM: Giữ nguyên từ bản trước */
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .form-container { width: 100%; max-width: 420px; padding: 30px 40px; background: #fff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); }
        .form-container h2 { font-weight: 700; color: #FF5722; margin-bottom: 25px; font-size: 26px; text-align: center; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 500; color: #555; }
        .form-group input { width: 100%; padding: 14px 15px; border: 1px solid #e0e0e0; border-radius: 8px; box-sizing: border-box; font-size: 15px; }
        .submit-btn { width: 100%; background-color: #4CAF50; color: white; padding: 14px; border: none; border-radius: 8px; font-size: 17px; font-weight: 600; cursor: pointer; margin-top: 15px; }
        .submit-btn:hover { background-color: #388E3C; }
.error-msg { background-color: #ffe0e0; color: #cc0000; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px; text-align: center;}
        .login-link { text-align: center; margin-top: 20px; font-size: 14px; }
        .login-link a { color: #4CAF50; text-decoration: none; font-weight: 600; }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Account Login</h2>
        
        <?php if(!empty($error)): ?>
            <?php foreach($error as $err): ?>
                <div class="error-msg"><?php echo $err; ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <form method="post" action="login.php">
            
            <div class="form-group"><label for="email">Email:</label><input type="email" id="email" name="email" required placeholder="Nhập địa chỉ email"></div>
            <div class="form-group"><label for="pass">Password:</label><input type="password" id="pass" name="pass" required placeholder="Nhập mật khẩu"></div>
            
            <button type="submit" name="login" class="submit-btn">login</button>
            
        </form>
        <div class="login-link">
           Don't have an account? <a href="register.php">register</a> 
        </div>
    </div>
</body>
</html>
