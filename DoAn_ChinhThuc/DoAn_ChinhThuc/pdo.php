<?php
    $pdo = new PDO(
        'mysql:host=localhost;port=3306;dbname=demo_doan',
        'thuy_demo',
        '12345'
     );
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
