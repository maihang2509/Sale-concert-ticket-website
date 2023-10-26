<?php

    function addphay($giatri) {
        $mang = str_split(strrev((string)$giatri), 3); //strrev đảo chuỗi, str_split cắt chuỗi
        $chuoi = implode(',', $mang);  // thêm ',' vào số
        return strrev($chuoi);
    }
    function addso0($x) {
        if(strlen($x) == 1) {
            $x = "0" . $x;
        }
        return $x;
    }
    //bảng concer
    $sp_id = $_GET["sp"];
    $kh_id = $_SESSION["id"];

    $sql3 = "SELECT `MaCC`, `TenCC`, `image`, `Dvitochuc`, `Diadiem`, `sodo`, WEEKDAY(Thoigiandien) as thu, day(Thoigiandien) as day, month(Thoigiandien) as month, year(Thoigiandien) as year, hour(time_begin) as hourbd, minute(time_begin) as minutebd, hour(time_finish) as hourkt, minute(time_finish) as minutekt FROM `concert` 
            WHERE MaCC= :na";
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->execute(array(
        ':na' => $sp_id
    ));
    $row3=$stmt3->fetch(PDO::FETCH_ASSOC);

    //bảng vé
    $sql = "SELECT * FROM `ve` 
            WHERE MaCC= :na";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':na' => $sp_id
    ));
    $stmt2 = $pdo->prepare($sql);
    $stmt2->execute(array(
        ':na' => $sp_id
    ));
    $text = 1;
    $rows=$stmt2->fetchAll(PDO::FETCH_ASSOC);
    
    //bảng khách hàng
    $sql4 = "SELECT * FROM `khach_hang` 
            WHERE `MaKH` = :kh";
    $stmt4 = $pdo->prepare($sql4);
    $stmt4->execute(array(
        ':kh' => $kh_id = $_SESSION["id"]
    ));
    $row4 = $stmt4->fetch(PDO::FETCH_ASSOC);
    
    //bảng vé đặt
    $sql5 = "SELECT * FROM `ve_dat` INNER JOIN `ve` ON `ve_dat`.`id_Mave` = `ve`.`Mave`
            WHERE `ve_dat`.`Khach_hang_id` = :id AND `ve_dat`.`check-ve` IS null";  //KH chưa thanh toán
    $stmt5 = $pdo->prepare($sql5);
    $stmt5->execute(array(
        ':id' => $kh_id
    ));
    $sql5 = "SELECT * FROM `ve_dat` INNER JOIN `ve` ON `ve_dat`.`id_Mave` = `ve`.`Mave`
            WHERE `ve_dat`.`Khach_hang_id` = :id AND `ve_dat`.`check-ve` IS null";  //KH chưa thanh toán
    $stmt5 = $pdo->prepare($sql5);
    $stmt5->execute(array(
        ':id' => $kh_id
    ));

    $sql6 = "SELECT * FROM `ve_dat`, `ve`, `khach_hang`, `concert` 
            WHERE `khach_hang`.`MaKH`= :kh AND `khach_hang`.`MaKH` =`ve_dat`.`Khach_hang_id` AND `ve_dat`.`id_Mave` = `ve`.`Mave` AND `ve`.`MaCC` = `concert`.`MaCC` AND `ve_dat`.`check-ve`='success'";
    $stmt6 = $pdo->prepare($sql6);
    $stmt6->execute(array(
        ':kh' => $kh_id
    ));
?>