<?php
    // session_start();
    $_SESSION["id"] = 1;
    include "../../pdo.php";
    include "../../inc/header.php";
    include "../../db/getdata.php";
    include "../../db/infoconcer.php";

    // unset($_SESSION["error"]);
                                                    // khi không tìm thấy id KH và SP
    if($row3 === false || $row4 === false) {
       header("Location: index.php");
    }

    if(isset($_POST["submit"])) {
        if(empty($_POST["check"])) {
            $_SESSION["error"] = "Xin hãy chọn hình thức thanh toán";
            header("location: thanhtoan.php?sp=" . $_GET["sp"]);
        }
        else {
            $set2 = "UPDATE `ve_dat` SET `check-ve`= :ch WHERE `Khach_hang_id`= :kh";
            $setmt2 = $pdo->prepare($set2);
            $setmt2->execute(array(
            ':ch' => "success",
            ':kh' => $_SESSION["id"]
            ));
            unset($_SESSION["error"]);
            header("location: ../home/qlve.php?sp=");
       }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Booking</title>
        
    </head>
<body>
    <link rel="stylesheet" href="../../assets/css/thanhtoan.css">
    <script src="../../assets/js/thanhtoan.js"></script>

    <ul class="list-group">
        <?php
            if(isset($_SESSION["error"])) {
                echo "<br><span class='warn'>" . $_SESSION["error"] . "</span>";
                
            }
        ?>
        <li class="list-group-item tieude">
            <nav class="nav">
                <li class="nav-link">THÔNG TIN NGƯỜI NHẬN VÉ</li>
            </nav>
        </li>
        <li class="list-group-item">
            <nav class="nav">
                <li class="nav-link hinh">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                    </svg>
                </li>
                <li class="nav-link cot1 chu-indam">Họ tên</li>
                <li class="nav-link cot2"><?php echo htmlentities($row4["Hoten"]);?></li>
            </nav>
        </li>
        <li class="list-group-item">
            <nav class="nav">
                <li class="nav-link hinh">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                    </svg>
                </li>
                <li class="nav-link cot1 chu-indam">Email</li>
                <li class="nav-link cot2"><?php echo htmlentities($row4["Email"]);?></li>
            </nav>
        </li>
        <li class="list-group-item">
            <nav class="nav">
                <li class="nav-link hinh">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                    </svg>
                </li>
                <li class="nav-link cot1 chu-indam">Điện thoại</li>
                <li class="nav-link cot2"><?php echo htmlentities($row4["Sdt"]);?></li>
            </nav>
        </li>
        <li class="list-group-item tieude">
            <nav class="nav">
                <li class="nav-link">
                    HÌNH THỨC THANH TOÁN
                </li>
            </nav>
        </li>
        <li class="list-group-item">
            <nav class="nav">
                <li class="nav-link">
                    <select class="form-select chu-indam" id="hinhthuc" onchange="showValue()" style="width: 240px;" aria-label="Default select example">
                        <option selected disabled>Thanh toán trực tuyến</option>
                        <option value="1">Thẻ tín dụng</option>
                        <option value="2">Internet Banking</option>
                        <option value="3">Momo</option>
                    </select>
                </li>
                
            </nav>
        </li>
        <li class="list-group-item tieude">
            <nav class="nav">
                <li class="nav-link">THÔNG TIN ĐẶT VÉ</li>
            </nav>
        </li>
        <li class="list-group-item">
            <nav class="nav">
                <li class="nav-link cot1-lv chu-indam">Loại vé</li>
                <li class="nav-link cot2 chu-indam">Số lượng</li>
            </nav>
        </li>
        <?php
            $tong = 0;
            while($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
                $tong += $row5["Tong_tien"];
        ?>
            <li class="list-group-item">
            <nav class="nav">
                <li class="nav-link cot1-lv">
        <?php
            echo htmlentities($row5["Tenve"]) . "<br>" . htmlentities(addphay($row5["Don_gia"])) . " VND";
        ?>
                </li>
                <li class="nav-link cot2">
        <?php
            echo htmlentities($row5["Soluongve_dat"]) . "<br>" . htmlentities(addphay($row5["Tong_tien"])) . " VND";
            echo "</li></nav></li>";
            }
        ?>
        <li class="list-group-item tongcong">
            <nav class="nav">
                <li class="nav-link tong">Tổng cộng</li>
                <li class="nav-link cot2"><?php echo htmlentities(addphay($tong)) . " VND"; ?></li>
            </nav>
        </li>
        <p class="ktr">Vui lòng kiểm tra kĩ đơn hàng</p>
        <form action="" method="post" id="thaotac">
            <input type="hidden" id="check" name="check">
            <input class="nutxn" type="submit" name="submit" value="Tiếp tục">
        </form>
    </ul>
    
</body>
</html>

<?php include "../../inc/footer.php" ?>