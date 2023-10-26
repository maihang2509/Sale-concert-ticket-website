<?php
    include "../../../pdo.php";
    session_start();

    if ( isset($_POST['delete']) && isset($_POST['Id_mg']) ) {
        $sql = "DELETE FROM manager WHERE Id_mg = :zip";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':zip' => $_POST['Id_mg']));
        $_SESSION['success'] = 'Record deleted';
        header( 'Location: index.php' ) ;
        return;
    }

    // Guardian: Make sure that Id_mg is present
    if ( ! isset($_GET['Id_mg']) ) {
    $_SESSION['error'] = "Missing Id_mg";
    header('Location: index.php');
    return;
    }

    $stmt = $pdo->prepare("SELECT Hoten, Id_mg FROM manager where Id_mg = :xyz");
    $stmt->execute(array(":xyz" => $_GET['Id_mg']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ( $row === false ) {
        $_SESSION['error'] = 'Bad value for Id_manager';
        header( 'Location: index.php' ) ;
        return;
    }
?>

<body>
    <p>Confirm: Deleting <?= htmlentities($row['Hoten']) ?></p>

    <form method="post">
    <input type="hidden" name="Id_mg" value="<?= $row['Id_mg'] ?>">
    <input type="submit" value="Delete" name="delete">
    <a href="../../../view/admin/manager/index.php">Cancel</a>
    </form>
</body>