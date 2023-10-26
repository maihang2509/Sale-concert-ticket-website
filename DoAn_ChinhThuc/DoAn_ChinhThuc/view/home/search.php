<?php
    include('../../inc/header.php');
    include "../../pdo.php";

?>

<body>
    
    <?php
        if(isset($_POST["search"])) {
            $search = $_POST['search'];
            $sql = "SELECT * FROM concert WHERE TenCC = '$search' ";
            $result = $pdo->query($sql);
            if($result->rowCount() === 1) {
                $row = $result->fetch(PDO::FETCH_ASSOC);  
                echo('<div class="container">');
                    echo('<div class="row">');
                        echo('<div class="col-md-3">');
                            echo('<div class="card">');
                                echo('<ul class="list-group">');
                                    echo('<li class="list-group-item" id="image"><a href="../../view/concert/concert.php?sp=' . $row["MaCC"] . '"><img src = "data:image/png;base64,' . base64_encode($row['image']) . '" width = "100%" height = "160px" max-width: "200px";/>'.'</a>' .'</li>');
                                    echo('<li class="list-group-item" id="name"><b>'.htmlentities($row["TenCC"]).'</b></li>');
                                    echo('<li class="list-group-item" id="time">'.htmlentities($row["Thoigiandien"]).'</li>');
                                    echo('<li class="list-group-item" id="place">'.htmlentities($row["Diadiem"]).'</li>');
                                echo('</ul>');
                            echo('</div>');
                        echo('</div>');
                    echo('</div>');
                echo('</div>');
            }
        }
    ?>

</body>