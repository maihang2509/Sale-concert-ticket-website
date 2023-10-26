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
        $stmt = $pdo->query("SELECT TenCC, Thoigiandien, Diadiem, image, MaCC, sodo FROM concert");
        echo("<thead>");
            echo("<tr>");
                echo("<th class='text-center'>Name</th>");
                echo("<th class='text-center'>Time</th>");
                echo("<th class='text-center'>Place</th>");
                echo("<th class='text-center'>Image</th>");
                echo("<th class='text-center'>Map</th>");
            echo("</tr>");
        echo("</thead>");
        echo("<tbody>");
            while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>";
                echo(htmlentities($row['TenCC']));
                echo("</td><td>");
                echo(htmlentities($row['Thoigiandien']));
                echo("</td><td>");
                echo(htmlentities($row['Diadiem']));
                echo("</td><td>"); 
                echo('<img src = "data:image/png;base64,' . base64_encode($row['image']) . '" width = "50px" height = "50px"/>');
                echo("</td><td>"); 
                echo('<img src = "data:image/png;base64,' . base64_encode($row['sodo']) . '" width = "50px" height = "50px"/>');
                echo("</td><td>");  
                echo('<a href="edit.php?MaCC='.$row['MaCC'].'">Edit</a> / ');
                echo('<a href="delete.php?MaCC='.$row['MaCC'].'">Delete</a>');
                echo("</td></tr>\n");
            }
        echo("</tbody>");
    ?>
    </table>
    <a href="../../../view/admin/concerts/add.php">Add New</a>
</body>