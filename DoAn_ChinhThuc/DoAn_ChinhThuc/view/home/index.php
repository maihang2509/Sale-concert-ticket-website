<?php
    $currentPage="index";
    
    include('../../inc/header.php');
    include "../../pdo.php";
    // session_start();

    
?>

<body>

    <?php 
        // output data of each row
        $stmt = $pdo->query("SELECT TenCC, Thoigiandien, Diadiem, image, MaCC FROM concert");
        $stmt->execute();
        
        $con = mysqli_connect("localhost","thuy_demo","12345","demo_doan");
        $sql = "SELECT * from concert";   
        if ($result = mysqli_query($con, $sql)) {
      
            // Return the number of rows in result set
            $rowcount = mysqli_num_rows( $result );
        }
        
        // Close the connection
        mysqli_close($con);

        //show
            
        echo('<div class="container">');
            echo('<div class="row">');
            while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo('<div class="col-md-3">');
                    echo('<div class="card">');
                        echo('<ul class="list-group">');
                            echo '<li class="list-group-item" id="image">';
                            if(isset($_SESSION["id"])) {
                                echo '<a href="../../view/concert/concert.php?sp=' . $row["MaCC"] . '">';
                            }
                            else {
                                echo '<a href="../../view/home/login.php">';
                            }
                            echo '<img src = "data:image/png;base64,' . base64_encode($row['image']) . '" width = "100%" height = "160px" max-width: "200px";/>'.'</a>' . '</li>';
                            echo('<li class="list-group-item" id="name"><b>'.htmlentities($row["TenCC"]).'</b></li>');
                            echo('<li class="list-group-item" id="time">'.htmlentities($row["Thoigiandien"]).'</li>');
                            echo('<li class="list-group-item" id="place">'.htmlentities($row["Diadiem"]).'</li>');
                        echo('</ul>');
                    echo('</div>');
                echo('</div>');
            }
            echo('</div>');
        echo('</div>');
        
    ?>
</body>

<?php
    include('../../inc/footer.php');
?>