<?php
    include "../../../pdo.php";
    session_start();

    if ( isset($_POST['Tenve'])
        && isset($_POST['Don_gia']) && isset($_POST['Soluongve']) && isset($_POST['Mave']) ) {

        // Data validation
        if ( strlen($_POST['Tenve']) < 1 || strlen($_POST['Don_gia']) < 1 || strlen($_POST['Soluongve']) < 1) {
            $_SESSION['error'] = 'Missing data';
            header("Location: add.php");
            return;
        }

        $sql = "UPDATE ve SET Tenve = :Tenve, Don_gia = :Don_gia,
                Soluongve = :Soluongve
                WHERE Mave = :Mave";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':Tenve' => $_POST['Tenve'],
            ':Don_gia' => $_POST['Don_gia'],
            ':Soluongve' => $_POST['Soluongve'],
            ':Mave' => $_POST['Mave']));
        $_SESSION['success'] = 'Record updated';
        header( 'Location: index.php' ) ;
        return;
    }

    // Guardian: Make sure that Mave is present
    if ( ! isset($_GET['Mave']) ) {
    $_SESSION['error'] = "Missing Mave";
    header('Location: index.php');
    return;
    }

    $stmt = $pdo->prepare("SELECT * FROM ve where Mave = :xyz");
    $stmt->execute(array(":xyz" => $_GET['Mave']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ( $row === false ) {
        $_SESSION['error'] = 'Bad value for Mave';
        header( 'Location: index.php' ) ;
        return;
    }

    // Flash pattern
    if ( isset($_SESSION['error']) ) {
        echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
        unset($_SESSION['error']);
    }

    $n = htmlentities($row['Tenve']);
    $p = htmlentities($row['Don_gia']);
    $a = htmlentities($row['Soluongve']);
    $Mave = $row['Mave'];
?>

<body>
    <p>Edit Ticket</p>
    <form method="post">
        <p>Name:
        <input type="text" name="Tenve" value="<?= $n ?>"></p>
        <p>Price:
        <input type="text" name="Don_gia" value="<?= $p ?>"></p>
        <p>Quantum:
        <input type="text" name="Soluongve" value="<?= $a ?>"></p>
        <input type="hidden" name="Mave" value="<?= $Mave ?>">
        <p><input type="submit" value="Update"/>
        <a href="../../../view/admin/ve/index.php">Cancel</a></p>
    </form>
</body>