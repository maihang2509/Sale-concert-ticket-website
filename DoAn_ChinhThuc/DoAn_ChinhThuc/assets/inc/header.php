<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Group 4 </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
</head>

<body>
    <nav>
        <h2><a href="index.php"><img src="./assets/img/logo.png " alt=""></h2></a> 
        
        <nav class="navbar">
            <div class="container-fluid">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder=" Search..." aria-label="Search" size="50">
                    <b><button class="btn btn-outline-success" type="submit">Search</button></b>
                </form>
            </div>
        </nav>

        <ul>
            <li class="direct"><a class="<?php echo $currentPage =="home" ? 'active' : ''?>"  href="index.php">HOME</a></li>
            <li class="direct"><a class="<?php echo $currentPage =="band" ? 'active' : ''?>" href="band.php">BAND</a></li>
            <li class="direct"><a class="<?php echo $currentPage =="tour" ? 'active' : ''?>" href="tour.php">TOUR</a></li>
            <li class="direct"><a class="<?php echo $currentPage =="contact" ? 'active' : ''?>" href="contact.php">CONTACT</a></li>
            
            <?php
                if(isset($_SESSION["id"])) {
            ?>
            <li class="user">
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['user_name']; ?>
                        </a>  
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index1.php">Information</a></li>
                            <li><a class="dropdown-item" href="index.php">Log out</a></li>
                        </ul>
                    </div>  
                </li>
            <?php
                }
                else { ?>
                    <li class="log"><a href="register.php">Sign up</a></li>
                    <li class="log"><a href="login.php">Sign in</a></li>
            <?php
                }
            ?>
        </ul>
    </nav>
</body>