<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí</title>
    <link rel="stylesheet" href="../../assets/css/login.css">
    <link rel="stylesheet" href="../../assets/css/style.css"> 
</head>
<body>

<?php
include "../../pdo.php";
session_start();
if ( isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['email']) ) {
    // Data validation
    if(empty($_POST['email'])){
        header("location: register.php?error=Email is required");
        exit();
    }
    if ( strlen($_POST['user_name']) < 1  ) {
        header("location: register.php?error=User name is required");
        exit();
    }
    if(empty($_POST['password'])){
        header("location: register.php?error=Password is required");
        exit();
    }
    // đưa dữ liệu vào db
    $sql = "INSERT INTO khach_hang ( Hoten, Pw, Email) VALUES (:user_name, :password, :email)";
    $stmt = $pdo ->prepare($sql);
    $stmt -> execute(array(
        ':email' => $_POST['email'],
        ':user_name' => $_POST['user_name'],
        ':password' => $_POST['password'])
    );
    // done
    header("location: login.php ");
    exit();
}
?>
    <form method="post">
        <h2>REGISTER</h2>
        <?php
            if(isset($_GET['error'])){ ?>
            <p class="error"><?php echo $_GET['error']; ?> </p>   
         <?php 
            } ?>
        <label for="">Email</label>
        <input type="email"name ="email" placeholder="Email"><br>

        <label for="">User Name</label>
        <input type="text"name ="user_name" placeholder="Họ và tên"><br>

        <label for="">Password</label>
        <input type="password"name ="password" placeholder="Mật khẩu"><br>

        <button type="submit" name="submit">Đăng kí</button>

    </form>
</body>
</html>


