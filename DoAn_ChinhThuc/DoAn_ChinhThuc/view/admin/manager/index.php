<?php
    include "../../../pdo.php";
    session_start();
?>

<body>
    <?php
        if ( isset($_SESSION['error']) ) {
            echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
            unset($_SESSION['error']);
        }
        if ( isset($_SESSION['success']) ) {
            echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
            unset($_SESSION['success']);
        }
        echo('<table border="1">'."\n");
        $stmt = $pdo->query("SELECT Hoten, Email, Pw, Id_mg FROM manager");
        echo("<thead>");
            echo("<tr>");
                echo("<th class='text-center'>Tên</th>");
                echo("<th class='text-center'>Email</th>");
                echo("<th class='text-center'>Password</th>");
            echo("</tr>");
        echo("</thead>");
        echo("<tbody>");
            while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                echo "<tr><td>";
                echo(htmlentities($row['Hoten']));
                echo("</td><td>");
                echo(htmlentities($row['Email']));
                echo("</td><td>");
                echo(htmlentities($row['Pw']));
                echo("</td><td>");
                echo('<a href="edit.php?Id_mg='.$row['Id_mg'].'">Edit</a> / ');
                echo('<a href="delete.php?Id_mg='.$row['Id_mg'].'">Delete</a>');
                echo("</td></tr>\n");
            }
        echo("</tbody>");
    ?>
    </table>
    <a href="../../../view/admin/manager/add.php">Add New</a>
</body>