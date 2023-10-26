<?php
    include "../../../pdo.php";
    session_start();

    if ( isset($_POST['delete']) && isset($_POST['Mave']) ) {
        $sql = "DELETE FROM ve WHERE Mave= :zip";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':zip' => $_POST['Mave']));
        $_SESSION['success'] = 'Record deleted';
        header( 'Location: index.php' ) ;
        return;
    }
    
    // Guardian: Make sure that Mave is present
    if ( ! isset($_GET['Mave']) ) {
    $_SESSION['error'] = "Missing ID_Ve";
    header('Location: index.php');
    return;
    }

    $stmt = $pdo->prepare("SELECT Tenve, Mave FROM ve where Mave = :xyz");
    $stmt->execute(array(":xyz" => $_GET['Mave']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ( $row === false ) {
        $_SESSION['error'] = 'Bad value for ID_Ve';
        header( 'Location: index.php' ) ;
        return;
    }
?>

<body>
    <p>Confirm: Deleting <?= htmlentities($row['Tenve']) ?></p>

    <form method="post">
    <input type="hidden" name="Mave" value="<?= $row['Mave'] ?>">
    <input type="submit" value="Delete" name="delete">
    <a href="../../../view/admin/ve/index.php">Cancel</a>
    </form>
</body>