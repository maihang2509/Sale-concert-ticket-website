<?php
    include "../../../pdo.php";
    session_start();

    if ( isset($_POST['Hoten']) && isset($_POST['Email'])
        && isset($_POST['Pw'])) {

        // Data validation
        if ( strlen($_POST['Hoten']) < 1 || strlen($_POST['Pw']) < 1) {
            $_SESSION['error'] = 'Missing data';
            header("Location: add.php");
            return;
        }

        if ( strpos($_POST['Email'],'@') === false ) {
            $_SESSION['error'] = 'Bad data';
            header("Location: add.php");
            return;
        }

        $sql = "INSERT INTO khach_hang (Hoten, Email, Pw)
                VALUES (:Hoten, :Email, :Pw)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':Hoten' => $_POST['Hoten'],
            ':Email' => $_POST['Email'],
            ':Pw' => $_POST['Pw']));
        $_SESSION['success'] = 'Record Added';
        header( 'Location: index.php' ) ;
        return;
    }

    // Flash pattern
    if ( isset($_SESSION['error']) ) {
        echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
        unset($_SESSION['error']);
    }
?>

<body>
    <p>Add A New User</p>
    <form method="post">
    <p>Name:
    <input type="text" name="Hoten"></p>
    <p>Email:
    <input type="text" name="Email"></p>
    <p>Password:
    <input type="password" name="Pw"></p>
    <p><input type="submit" value="Add New"/>
    <a href="../../../view/admin/users/index.php">Cancel</a></p>
    </form>
</body>