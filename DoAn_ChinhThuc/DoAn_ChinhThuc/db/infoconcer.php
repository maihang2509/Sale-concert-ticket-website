<?php
    // include "getdata.php";
?>
<body>
    <style>
        .infoconcer {
            --border-color: rgba(0, 0, 0, 0.125);
            display: flex;
            justify-content: space-evenly;
            background-color: rgb(234, 175, 195);
        }
        .infoconcer .nd {
            padding: 15px;
            padding-left: 0;
            width: 1152px;
            color: rgb(116, 112, 109);
            border: none;
        }
        .tencc {
            text-decoration: none;
            font-weight: 700;
            color: rgb(116, 112, 109);
        }
    </style>
    <div class="infoconcer">
        <div class="nd">
            <h4><a href="" class="tencc"><?php echo $row3["TenCC"];?></a></h4>
            <?php echo "<p>" . $row3["day"] . " Tháng " . $row3["month"] . " " . $row3["year"] . ", ";
            echo addso0((string)$row3["hourbd"]) . ":" . addso0((string)$row3["minutebd"]) . " - ";
            echo addso0((string)$row3["hourkt"]) . ":" . addso0((string)$row3["minutekt"]) . "</p>"; ?>
        </div>
    </div>
</body>
