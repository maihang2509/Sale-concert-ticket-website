<?php
    include "../../../pdo.php";
    session_start();

    if ( isset($_POST['delete']) && isset($_POST['MaCC']) ) {
        $sql = "DELETE FROM concert WHERE MaCC = :zip";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':zip' => $_POST['MaCC']));
        $_SESSION['success'] = 'Record deleted';
        header( 'Location: index.php' ) ;
        return;
    }

    // Guardian: Make sure that MaCC is present
    if ( ! isset($_GET['MaCC']) ) {
        $_SESSION['error'] = "Missing MaCC";
        header('Location: index.php');
        return;
    }

    $stmt = $pdo->prepare("SELECT TenCC, MaCC FROM concert where MaCC = :xyz");
    $stmt->execute(array(":xyz" => $_GET['MaCC']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ( $row === false ) {
        $_SESSION['error'] = 'Bad value for MaCC';
        header( 'Location: index.php' ) ;
        return;
    }
?>

<body>
    <p>Confirm: Deleting <?= htmlentities($row['TenCC']) ?></p>

    <form method="post">
    <input type="hidden" name="MaCC" value="<?= $row['MaCC'] ?>">
    <input type="submit" value="Delete" name="delete">
    <a href="../../../view/admin/concerts/index.php">Cancel</a>
    </form>
</body>