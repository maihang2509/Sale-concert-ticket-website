<?php include('../../pdo.php');
    session_start();
?>

<?php
    if (isset($_POST['Hoten']) && isset($_POST['Pw']) && isset($_POST['Email']) ) 
    {
        $sql = "UPDATE khach_hang SET Hoten = :Hoten ,Email = :Email, Pw = :Pw WHERE MaKH = :MaKH";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':Hoten' => $_POST['Hoten'],
            ':Email' => $_POST['Email'],
            ':Pw' => $_POST['Pw'],
            ':MaKH' => $_POST['MaKH']));
    }
    
    
    $stmt = $pdo->prepare("SELECT * FROM khach_hang where MaKH = :x");
    $stmt->execute(array(":x" => $_SESSION['id']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $n = htmlentities($row['Hoten']);
    $e = htmlentities($row['Email']);
    $p = htmlentities($row['Pw']);
    $MaKH = $row['MaKH'];
?>


