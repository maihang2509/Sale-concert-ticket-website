<?php
    include "../../pdo.php";
    session_start();
    if(isset($_POST['user_name']) && isset($_POST['password'])) {
        $email = ($_POST['user_name']);
        $password = ($_POST['password']);

        if(empty($email)){
            header("location: login.php?error=User name is required");
            exit();
        }else if(empty($password)){
            header("location: login.php?error=Password is required");
            exit();
        }else{
            $sql = "SELECT * FROM khach_hang WHERE Email = '$email' AND  Pw='$password' ";

            //Câu lệnh sql để lấy dữ liệu
            $result = $pdo->query($sql);
            if($result->rowCount() === 1) {
                $row = $result->fetch(PDO::FETCH_ASSOC);
                if($row['Email'] === $email && $row['Pw'] === $password){ 
                    $_SESSION['user_name'] = $row['Hoten'];
                    $_SESSION['password'] = $row['Pw'];
                    $_SESSION['id'] = $row['MaKH'];
                    header("location: index.php");
                    exit();
                }
            }else{
                header("location: login.php?error=Incorect User name of password");
                exit();
            }
        }    
    }  
?>