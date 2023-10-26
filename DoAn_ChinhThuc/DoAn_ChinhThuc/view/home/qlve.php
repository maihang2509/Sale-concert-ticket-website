<?php
    include "../../pdo.php";
    include "../../inc/header.php";
    include "../../db/getdata.php";

    $tong = 0;
    
?>
<head>
    <title>Vé Đã Đặt</title>
</head>
<body>
    <link rel="stylesheet" href="../../assets/css/thanhtoan.css">
    <style>
        .contain {
            background-color: rgb(234, 175, 195);
        }
        .khung {
            margin: 0 auto;
            width: 600px;
        }
        .list-group-item {
            padding: 0.8rem 1rem;
        }
        .tong {
            width: 200px;
        }
        body {
            background-color: rgb(234, 175, 195);
        }
        .khung {
            background-color: white;
            /* margin-top: 10px; */
            margin: 5rem auto;
            width: 600px;
        }
        .list-group-item {
            padding: 0.8rem 1rem;
        }
        .tong {
            width: 200px;
        }
    </style>
    <div class="contain">
        <ul class="list-group khung">
        <?php
            while($row6 = $stmt6->fetch(PDO::FETCH_ASSOC)) {
                $tong += $row6["Tong_tien"];
                echo '<li class="list-group-item tieude">';
                echo $row6["TenCC"] . "</li>";
                echo '<li class="list-group-item">Tên vé: ' . $row6["Tenve"] . "&emsp;&emsp;&emsp;Số lượng: " . $row6["Soluongve_dat"] . "&emsp;&emsp;&emsp;Số tiền: " . addphay((string)$row6["Tong_tien"]) . " VND</li>";
            }
            echo '<li class="list-group-item tongcong"><nav class="nav"><li class="nav-link tong">Tổng tiền</li><li class="nav-link cot2">' . addphay((string)$tong) . " VND </li></nav></li>";
        ?>
        </ul>
    </div>
</body>