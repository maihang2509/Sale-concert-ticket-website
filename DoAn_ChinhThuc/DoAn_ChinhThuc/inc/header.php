<?php
    session_start();
?> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../../assets/css/headers.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">
</head>

<body>
    <nav class="header_nav">
        <a class="image_logo" href="../../view/home/index.php"><img src="../../assets/img/logo.png " alt=""></a> 
        
        <nav class="navbar">
            <div class="container-fluid">
                <form method="post" action="../../view/home/search.php" class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder=" Search..." aria-label="Search" name="search" size="50">
                    <b><button class="btn btn-outline-dark" type="submit" name="submit">search</button></b>
                </form>
            </div>
        </nav>

        <ul class="menu_header">
                <li class="direct"><a class="<?php echo $currentPage =="index" ? 'active' : ''?>"  href="../../view/home/index.php">Trang chủ</a></li>
                <li class="direct"><a class="<?php echo $currentPage =="contact" ? 'active' : ''?>" href="../../view/home/contact.php">Liên hệ</a></li>
            
            <?php
                if(isset($_SESSION["id"])) {
            ?>
                <li class="user">
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['user_name']; ?>
                        </a>  
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../view/home/index1.php">Thông tin</a></li>
                        <li><a class="dropdown-item" href="../../view/home/qlve.php?sp">Vé đã đặt</a></li>
                        <li><a class="dropdown-item" href="../home/logout.php">Đăng xuất</a></li>
                        </ul>
                    </div>  
                </li>
            <?php
                }
                else {
            ?>
                <li class="log"><a href="register.php">Đăng kí</a></li>
                <li class="log"><a href="login.php">Đăng nhập</a> </li>
            <?php
                }
            ?>
        </ul>
    </nav>
</body>