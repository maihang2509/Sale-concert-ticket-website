<?php
    include "../../../pdo.php";
    session_start();

    if ( isset($_POST['Tenve']) && isset($_POST['Don_gia']) && isset($_POST['Soluongve'])) {

        // Data validation
        if ( strlen($_POST['Tenve']) < 1 || strlen($_POST['Don_gia']) < 1 || strlen($_POST['Soluongve']) < 1) {
            $_SESSION['error'] = 'Missing data';
            header("Location: add.php");
            return;
        }

        $sql = "INSERT INTO ve (Tenve, Don_gia, Soluongve)
                VALUES (:Tenve, :Don_gia, :Soluongve)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':Tenve' => $_POST['Tenve'],
            ':Don_gia' => $_POST['Don_gia'],
            ':Soluongve' => $_POST['Soluongve']));
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
    <p>Add A New Ticket</p>
    <form method="post">
    <p>Name:
    <input type="text" name="Tenve"></p>
    <p>Price:
    <input type="text" name="Don_gia"></p>
    <p>Quantum:
    <input type="text" name="Soluongve"></p>
    <p><input type="submit" value="Add New"/>
    <a href="../../../view/admin/ve/index.php">Cancel</a></p>
    </form>
</body>