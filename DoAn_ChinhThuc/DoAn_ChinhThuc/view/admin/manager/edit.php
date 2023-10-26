<?php
    include "../../../pdo.php";
    session_start();

    if ( isset($_POST['Hoten']) && isset($_POST['Email'])
        && isset($_POST['Pw']) && isset($_POST['Id_mg']) ) {

        // Data validation
        if ( strlen($_POST['Hoten']) < 1 || strlen($_POST['Pw']) < 1) {
            $_SESSION['error'] = 'Missing data';
            header("Location: edit.php?Id_mg=".$_POST['Id_mg']);
            return;
        }

        if ( strpos($_POST['Email'],'@') === false ) {
            $_SESSION['error'] = 'Bad data';
            header("Location: edit.php?Id_mg=".$_POST['Id_mg']);
            return;
        }

        $sql = "UPDATE manager SET Hoten = :Hoten,
                Email = :Email, Pw = :Pw
                WHERE Id_mg = :Id_mg";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':Hoten' => $_POST['Hoten'],
            ':Email' => $_POST['Email'],
            ':Pw' => $_POST['Pw'],
            ':Id_mg' => $_POST['Id_mg']));
        $_SESSION['success'] = 'Record updated';
        header( 'Location: index.php' ) ;
        return;
    }

    // Guardian: Make sure that Id_mg is present
    if ( ! isset($_GET['Id_mg']) ) {
    $_SESSION['error'] = "Missing manager_id";
    header('Location: index.php');
    return;
    }

    $stmt = $pdo->prepare("SELECT * FROM manager where Id_mg = :xyz");
    $stmt->execute(array(":xyz" => $_GET['Id_mg']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ( $row === false ) {
        $_SESSION['error'] = 'Bad value for Id_mg';
        header( 'Location: index.php' ) ;
        return;
    }

    // Flash pattern
    if ( isset($_SESSION['error']) ) {
        echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
        unset($_SESSION['error']);
    }

    $n = htmlentities($row['Hoten']);
    $e = htmlentities($row['Email']);
    $p = htmlentities($row['Pw']);
    $Id_mg = $row['Id_mg'];
?>

<body>
    <p>Edit Manager</p>
    <form method="post">
        <p>Name:
        <input type="text" name="Hoten" value="<?= $n ?>"></p>
        <p>Email:
        <input type="text" name="Email" value="<?= $e ?>"></p>
        <p>Password:
        <input type="text" name="Pw" value="<?= $p ?>"></p>
        <input type="hidden" name="Id_mg" value="<?= $Id_mg ?>">
        <p><input type="submit" value="Update"/>
        <a href="../../../view/admin/manager/index.php">Cancel</a></p>
    </form>
</body>