<?php

    $kh_id = $_SESSION["id"];


    $set = "INSERT INTO `ve_dat`(`id_Mave`, `Khach_hang_id`, `Soluongve_dat`, `Tong_tien`) 
            VALUES (:ve, :kh, :sl, :t)";
    $setmt = $pdo->prepare($set);
    $setmt->execute(array(
    ':ve' => $rows[$j]["Mave"],
    ':kh' => $kh_id,
    ':sl' => $_POST[$name],
    ':t' => $tienvetong
    ));   
?>