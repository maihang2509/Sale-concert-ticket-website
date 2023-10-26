<?php
    include "../../../pdo.php";
    session_start();

    if ( isset($_POST['Hoten']) && isset($_POST['Email'])
        && isset($_POST['Pw']) && isset($_POST['MaKH']) ) {

        // Data validation
        if ( strlen($_POST['Hoten']) < 1 || strlen($_POST['Pw']) < 1) {
            $_SESSION['error'] = 'Missing data';
            header("Location: edit.php?MaKH=".$_POST['MaKH']);
            return;
        }

        if ( strpos($_POST['Email'],'@') === false ) {
            $_SESSION['error'] = 'Bad data';
            header("Location: edit.php?MaKH=".$_POST['MaKH']);
            return;
        }

        $sql = "UPDATE khach_hang SET Hoten = :Hoten,
                Email = :Email, Pw = :Pw
                WHERE MaKH = :MaKH";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':Hoten' => $_POST['Hoten'],
            ':Email' => $_POST['Email'],
            ':Pw' => $_POST['Pw'],
            ':MaKH' => $_POST['MaKH']));
        $_SESSION['success'] = 'Record updated';
        header( 'Location: index.php' ) ;
        return;
    }

    // Guardian: Make sure that MaKH is present
    if ( ! isset($_GET['MaKH']) ) {
    $_SESSION['error'] = "Missing MaKH";
    header('Location: index.php');
    return;
    }

    $stmt = $pdo->prepare("SELECT * FROM khach_hang where MaKH = :xyz");
    $stmt->execute(array(":xyz" => $_GET['MaKH']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ( $row === false ) {
        $_SESSION['error'] = 'Bad value for MaKH';
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
    $MaKH = $row['MaKH'];
?>

<body>
    <p>Edit User</p>
    <form method="post">
        <p>Name:
        <input type="text" name="Hoten" value="<?= $n ?>"></p>
        <p>Email:
        <input type="text" name="Email" value="<?= $e ?>"></p>
        <p>Password:
        <input type="text" name="Pw" value="<?= $p ?>"></p>
        <input type="hidden" name="MaKH" value="<?= $MaKH ?>">
        <p><input type="submit" value="Update"/>
        <a href="../../../view/admin/users/index.php">Cancel</a></p>
    </form>
</body>