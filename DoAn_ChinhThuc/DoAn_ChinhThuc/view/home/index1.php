<?php include("../../pdo.php");?>

<?php 
session_start();

    if(isset($_POST["edit"])) {
        if (isset($_POST['Hoten']) && isset($_POST['Pw']) && isset($_POST['Email']) ) 
        {
            $sql = "UPDATE khach_hang SET Hoten = :Hoten ,Email = :Email, Pw = :Pw WHERE MaKH = :MaKH";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':Hoten' => $_POST['Hoten'],
                ':Email' => $_POST['Email'],
                ':Pw' => $_POST['Pw'],
                ':MaKH' => $_POST['MaKH']));            
        } 
        $_SESSION["success"]="Thành công";
    }
    

    $stmt = $pdo->prepare("SELECT * FROM khach_hang where MaKH = :x");
    $stmt->execute(array(":x" => $_SESSION['id']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $n = htmlentities($row['Hoten']);
    $e = htmlentities($row['Email']);
    $p = htmlentities($row['Pw']);
    $MaKH = $row['MaKH'];
?> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/edit.css">
    <style>
        *{ 
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Kumbh Sans',sans-serif;
        }
        
    </style>
</head>
<body class="body">
    <form class="form" method="post">
        <?php if(isset($_POST["edit"])) {
            echo "<span style='color: green;'>" . $_SESSION["success"] . "</span>";
        } 
        ?>
        <h2 class="header">Thông Tin Cá Nhân</h2>
         
        <label class="lable" for="">User name</label>
        <input class="input" type="text" name="Hoten" value="<?= $n ?>" placeholder="Họ và tên"><br>

        <label class="lable" for="">Email</label>
        <input class="input" type="email" name ="Email" value="<?= $e ?>" placeholder="Email"><br>

        <label class="lable" for="">Password</label>
        <input class="input" type="password" name ="Pw" value="<?= $p ?>" placeholder="Mật khẩu"><br>
        
        <input class="input" type="hidden" name="MaKH" value="<?= $MaKH ?>">
        <a href="index.php">Return</a>
        <input class="button" type="submit" name="edit">
    </form>   
</body>
</html>



