<?php
    include "../../../pdo.php";
    session_start();

    if ( isset($_POST['delete']) && isset($_POST['MaKH']) ) {
        $sql = "DELETE FROM khach_hang WHERE MaKH = :zip";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':zip' => $_POST['MaKH']));
        $_SESSION['success'] = 'Record deleted';
        header( 'Location: index.php' ) ;
        return;
    }
    
    // Guardian: Make sure that MaKH is present
    if ( ! isset($_GET['MaKH']) ) {
    $_SESSION['error'] = "Missing ID_User";
    header('Location: index.php');
    return;
    }

    $stmt = $pdo->prepare("SELECT Hoten, MaKH FROM khach_hang where MaKH = :xyz");
    $stmt->execute(array(":xyz" => $_GET['MaKH']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ( $row === false ) {
        $_SESSION['error'] = 'Bad value for ID_User';
        header( 'Location: index.php' ) ;
        return;
    }
?>

<body>
    <p>Confirm: Deleting <?= htmlentities($row['Hoten']) ?></p>

    <form method="post">
    <input type="hidden" name="MaKH" value="<?= $row['MaKH'] ?>">
    <input type="submit" value="Delete" name="delete">
    <a href="../../../view/admin/users/index.php">Cancel</a>
    </form>
</body>