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
        $stmt = $pdo->query("SELECT Tenve, MaCC, Don_gia, Soluongve, Mave FROM ve");
        echo("<thead>");
            echo("<tr>");
                echo("<th class='text-center'>Name</th>");
                echo("<th class='text-center'>Concert</th>");
                echo("<th class='text-center'>Price</th>");
                echo("<th class='text-center'>Quantum</th>");
            echo("</tr>");
        echo("</thead>");
        echo("<tbody>");
            while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                echo "<tr><td>";
                echo(htmlentities($row['Tenve']));
                echo("</td><td>");
                echo(htmlentities($row['MaCC']));
                echo("</td><td>");
                echo(htmlentities($row['Don_gia']));
                echo("</td><td>");
                echo(htmlentities($row['Soluongve']));
                echo("</td><td>");
                echo('<a href="edit.php?Mave='.$row['Mave'].'">Edit</a> / ');
                echo('<a href="delete.php?Mave='.$row['Mave'].'">Delete</a>');
                echo("</td></tr>\n");
            }
        echo("</tbody>");
    ?>
    </table>
    <a href="../../../view/admin/ve/add.php">Add New</a>
</body>