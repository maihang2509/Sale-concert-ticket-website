<?php
    include "../../pdo.php";
    include "../../inc/header.php";
    include "../../db/getdata.php";   
?>

<body>
    <style>
        hr {
            padding: 0;
            width: 0;
        }
        .concert {
            background-color: rgb(234, 175, 195);
        }
        .anh {
            height: 37.5rem;
        }
        .contain {
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 190px;
        }
        .info {
            --color: rgb(81, 81, 81);
            --color-hinh: rgb(154, 154, 154);
            --font-weight: 700;
            display: flex;
            flex-direction: column;
            padding: 0;
            /* margin-top: 30px; */
        }
        .info.khung1 {
            width: 780px;
        }
        .khung2 {
            background-color: white;
            margin: 0 auto;
        }
        .info .nd {
            width: 650px;
            position: relative;
            display: block;
            padding: 5px 1.2rem;
            font-weight: var(--font-weight);
        }
        .info .nd.td {
            font-size: larger;
            padding: 10px 1.2rem;
        }
        .info .nd .hinh {
            margin-right: 0.8rem;
            margin-bottom: 3px;
            color: var(--color);
        }
        .muave {
            color: white; 
            font-weight: var(--font-weight);
            font-size: larger;
            padding: 0.5rem 5.8rem;
            background-color: palevioletred;
            border: 2px solid palevioletred; 
            border-radius: 5px;
        }
        .muave:hover {
            background-color: #000;
            color: palevioletred; 
            border: 2px solid #000;
            border-radius: 20px;
            transition: all 0.3s ease;
        }
        .info .gt {
            position: relative;
            display: block;
            padding: 10px 1.2rem;
            border: 2px solid var(--color-hinh);
            font-weight: var(--font-weight);
        }
        .sodo {
            height: 51rem;
            width: 740px;
            background: center / contain no-repeat url(<?php echo $row3["sodo"]; ?>);
        }

        @media screen and (max-width: 1105px){
            .info.khung1 {
                width: 620px;
            }
            .info .nd {
                width: 600px;
            }
            .muave {
                padding: 0.5rem 4.5rem;
            }
        }
    </style>
    <div class="concert">
        <div class="anh">
            <?php echo '<img src = "data:image/png;base64,' . base64_encode($row3['image']) . '" style="width:100%; height:100%;">';
            ?>
        </div>
        <div class="contain">
            <ul class="info khung1">
                <li class="nd td"><?php echo $row3["TenCC"]; ?></li>
                <li class="nd">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock hinh" viewBox="0 0 16 16">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                    </svg>
                    <span>
                        <?php
                            switch($row3["thu"]) {
                                case 0: 
                                    echo "Thứ 2";
                                    break;
                                case 1: 
                                    echo "Thứ 3";
                                    break;
                                case 2: 
                                    echo "Thứ 4";
                                    break;
                                case 3: 
                                    echo "Thứ 5";
                                    break;
                                case 4: 
                                    echo "Thứ 6";
                                    break;
                                case 5: 
                                    echo "Thứ 7";
                                    break;
                                case 0: 
                                    echo "Chủ Nhật";
                                    break;
                            }
                            echo ", " . $row3["day"] . " Tháng " . $row3["month"] . " " . $row3["year"] . " (";
                            echo addso0((string)$row3["hourbd"]) . ":" . addso0((string)$row3["minutebd"]) . " - ";
                            echo addso0((string)$row3["hourkt"]) . ":" . addso0((string)$row3["minutekt"]) . ")";
                        ?>
                    </span>
                </li>
                <li class="nd">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pin-map hinh" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
                        <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                    </svg>
                    <span><?php echo $row3["Diadiem"] ?></span>
                </li>    
            </ul>
            <ul class="info">
                <a href="../payment/index.php?sp=<?php echo $_GET["sp"]; ?>"><button class="muave">Mua vé ngay</button></a>
            </ul>
        </div>
        <hr>
        <ul class="info khung1 khung2">
            <li class="gt">GIỚI THIỆU</li>
            <li class="gt">
                <p class="sodo">
                    <img src = "data:image/png;base64,<?php echo base64_encode($row3['sodo']); ?>" style="width:100%; height:100%;">';
                </p>
            </li>
        </ul>
        <hr>
    </div>
</body>

<?php include "../../inc/footer.php" ?>