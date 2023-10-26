<?php
    
    include "../../pdo.php";
    include "../../inc/header.php";
    include "../../db/getdata.php";
    include "../../db/infoconcer.php";
    
    if(isset($_SESSION["error"])) {
        echo "<br><span class='warn'>" . $_SESSION["error"] . "</span>";
        unset($_SESSION["error"]);
    }
    
    if(isset($_POST['submit'])) {
        $test = 0;

        //nếu tồn tại KH đặt vé nhưng chưa thanh toán thì xóa
        $sql4 = "DELETE FROM `ve_dat` 
                WHERE `Khach_hang_id` = :kh  AND `check-ve` IS null";
        $stmt4 = $pdo->prepare($sql4);
        $stmt4->execute(array(
            ':kh' => $_SESSION["id"]
        ));
        for($i = 1; $i <= count($rows); $i++) {
            $name = 've' . $i;
            $j = $i - 1;
            // $_POST[$name] là số lượng vé
            if(isset($_POST[$name]) && $_POST[$name] > 0) {
                $test += 1;
                $tienvetong = $_POST[$name] * $rows[$j]["Don_gia"];
                include "../../db/setdata.php";
            }
        }
        if($test > 0) {
            header("Location: thanhtoan.php?sp=" . $_GET['sp']);
        }
        else {
            $_SESSION["error"] = "Xin hãy chọn vé cần mua";
            header("Location: index.php?sp=" . $_GET['sp']);
        }
    }
?>
<head>
    <meta charset="UTF-8">
    <title>Booking</title>
        
</head>
<body>

    <!-- CSS only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../../assets/css/payment.css">
    <script src="../../assets/js/payment.js"></script>

    <div class="can2ben">
        <div class="select khung1">
            <ul class="list-group">
                <li class="list-group-item tieude khung1">
                    <nav class="nav">
                        <li class="nav-link loaive">LOẠI VÉ</li>
                        <li class="nav-link gia">GIÁ</li>
                        <li class="nav-link sl">SỐ LƯỢNG</li>
                    </nav>
                </li>
                <?php
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $tenve = $row['Tenve'];
                        $ve_id = $row['Mave'];
                        $giave = $row['Don_gia']; //đưa vào setsl()
                        if(count($rows) === $text) {
                            echo '<li class="list-group-item khung1" style="border-bottom-style: none;"><nav class="nav"><li class="nav-link loaive">';
                        }
                        else {
                            echo '<li class="list-group-item nd khung1"><nav class="nav"><li class="nav-link loaive">';
                        }
                        echo htmlentities($tenve);
                        echo '</li><li class="nav-link gia">';
                        echo addphay($giave) . " VND";
                        echo '</li><li class="nav-link sl">';
                ?>
                        <input type="button" name="-" class="sl-ve" value="-" onclick="setsl('-', <?php echo $ve_id; ?>, '<?php echo $tenve; ?>', '<?php echo $giave; ?>')">
                        <input type="text" class="sl-ve" id="<?php echo $ve_id; ?>" style="width: 40px" value=0 readonly>
                        <input type="button" name="+" class="sl-ve" value="+" onclick="setsl('+', <?php echo $ve_id; ?>, '<?php echo $tenve; ?>', '<?php echo $giave; ?>')">
                
                <?php
                        echo '</li></nav></li>';
                        $text += 1;
                    }
                ?>
            </ul>
        </div>
        <div class="select khung2">
            <ul class="list-group" id="list-group">
                <li class="list-group-item tieude">
                    <nav class="nav">
                        <li class="nav-link khung2">THÔNG TIN ĐẶT VÉ</li>
                    </nav>
                </li>
                <li class="list-group-item nd">
                    <nav class="nav">
                        <li class="nav-link khung2-cot1">Loại vé</li>
                        <li class="nav-link khung2-cot2">Số lượng</li>
                    </nav>
                </li>
                <li class="list-group-item" id="tong" style="font-weight: bold;">
                    <nav class="nav">
                        <li class="nav-link" style="width: 133px; text-align: left;">Tổng cộng</li>
                        <li class="nav-link" style="width: 187px; text-align: right;" id="tinhtong"></li>
                    </nav>
                </li>
                <form action="" method="post" id="thaotac">
                    <?php
                    for($i = 1; $i <= count($rows); $i++) {
                        $j = $i - 1;
                        echo '<input type="hidden" name="ve' . $i . '" id="ve' . $rows[$j]["Mave"] . '" value="0">';
                    }
                    ?>
                    <input class="submit" type="submit" name="submit" value="Tiếp tục">
                </form>
            </ul>
            
        </div>
    </div>  
    
</body>
<?php include "../../inc/footer.php" ?>