<?php
session_start();
@include('db.php');

$error = array(); 

if(isset($_POST['register'])){
    
    if (!isset($connect) || mysqli_connect_errno()) {
        $error[] = "Database connection error. Please try again later.";
    } else {
        
        $fullname = mysqli_real_escape_string($connect, $_POST['fullname']);
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $phone = mysqli_real_escape_string($connect, $_POST['phone']); 
        $address = mysqli_real_escape_string($connect, $_POST['address']);
        $pass = $_POST['pass'];
        $confirm_pass = $_POST['confirm_pass'];
        
        if($pass != $confirm_pass){
            $error[] = "Password confirmation does not match.";
        } else {
            
            $check_existing = "SELECT UserName, Email FROM `Users` WHERE UserName = '$username' OR Email = '$email'";
            $result = mysqli_query($connect, $check_existing);
            
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)) {
                    if($row['UserName'] == $username) { $error[] = "Username already exists."; }
                    if($row['Email'] == $email) { $error[] = "This email is already registered."; }
                }
            } 
            
            if (empty($error)) { 
                $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
                $role_id = 2;
                $phone_sql = empty($phone) ? "NULL" : "'$phone'";
                $address_sql = empty($address) ? "NULL" : "'$address'";

                $insert_query = "INSERT INTO `Users` 
                                 (FullName, UserName, Password, PhoneNumber, Address, Email, RoleID) 
                                 VALUES 
                                 ('$fullname', '$username', '$hashed_password', $phone_sql, $address_sql, '$email', '$role_id')";
                               
                if(mysqli_query($connect, $insert_query)){
                    header('location: login.php');
                    exit(); 
                } else {
                    $error[] = "System error: Unable to create new user.";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style type="text/css">
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f4f7f6; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            margin: 0; 
        }

        /* ⭐ Form nhỏ gọn hơn */
        .form-container { 
            width: 100%; 
            max-width: 360px; 
            padding: 20px 25px; 
            background: #fff; 
            border-radius: 12px; 
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08); 
        }

        .form-container h2 { 
            font-weight: 700; 
            color: #FF5722; 
            margin-bottom: 20px; 
            font-size: 22px; 
            text-align: center; 
        }

        .form-group { margin-bottom: 12px; }

        .form-group label { 
            display: block; 
            margin-bottom: 4px; 
            font-weight: 500; 
            color: #555; 
            font-size: 14px;
        }

        .form-group input { 
            width: 100%; 
            padding: 10px 12px; 
            border: 1px solid #e0e0e0; 
            border-radius: 7px; 
            box-sizing: border-box; 
            font-size: 14px; 
        }

        .submit-btn { 
            width: 100%; 
            background-color: #4CAF50; 
            color: white; 
            padding: 12px; 
            border: none; 
            border-radius: 8px; 
            font-size: 16px; 
            font-weight: 600; 
            cursor: pointer; 
            margin-top: 10px; 
        }

        .submit-btn:hover { background-color: #388E3C; }

        .error-msg { 
            background-color: #ffe0e0; 
            color: #cc0000; 
            padding: 9px; 
            border-radius: 5px; 
            margin-bottom: 12px; 
            font-size: 13px; 
            text-align: center;
        }

        .login-link { 
            text-align: center; 
            margin-top: 15px; 
            font-size: 13px; 
        }

        .login-link a { 
            color: #4CAF50; 
            text-decoration: none; 
            font-weight: 600; 
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Create New Account</h2>
        
        <?php if(!empty($error)): ?>
            <?php foreach($error as $err): ?>
                <div class="error-msg"><?php echo $err; ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <form method="post" action="register.php"> 
            
            <div class="form-group"><label for="fullname">Full Name:</label><input type="text" name="fullname" id="fullname" required></div>
            <div class="form-group"><label for="username">Username:</label><input type="text" name="username" id="username" required></div>
            <div class="form-group"><label for="email">Email:</label><input type="email" name="email" id="email" required></div>
            <div class="form-group"><label for="phone">Phone Number:</label><input type="text" name="phone" id="phone"></div>
            <div class="form-group"><label for="address">Address:</label><input type="text" name="address" id="address"></div>
            <div class="form-group"><label for="pass">Password:</label><input type="password" name="pass" id="pass" required></div>
            <div class="form-group"><label for="confirm_pass">Confirm Password:</label><input type="password" name="confirm_pass" id="confirm_pass" required></div>

            <button type="submit" name="register" class="submit-btn">Create Account</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="login.php">Log In</a>
        </div>
    </div>
</body>
</html>
