<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../assets/css/login.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <form action="handle.php" method="post">
        <h2>Đăng Nhập</h2>
        <?php
            if(isset($_GET['error'])){ ?>
            <p class="error"><?php echo $_GET['error']; ?> </p>   
        <?php } ?>
                
            <label for="">Email</label>
            <input type="email" name ="user_name"  placeholder="Email"><br>

            <label for="">Password</label>
            <input type="password" name ="password" placeholder="Mật khẩu"><br>

            <button type="submit" name= "login">Đăng Nhập</button>
    </form>  
</body>
</html>

