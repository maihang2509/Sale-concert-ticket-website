<?php
    include "../../../pdo.php";
    session_start();

    if ( isset($_POST['TenCC']) && isset($_POST['Thoigiandien'])
        && isset($_POST['Diadiem']) && isset($_FILES['image']["name"]) && isset($_FILES['sodo']["name"]) && isset($_POST['MaCC']) ) {

        // Data validation
        if ( strlen($_POST['TenCC']) < 1 || strlen($_POST['Diadiem']) < 1) {
            $_SESSION['error'] = 'Missing data';
            header("Location: edit.php?MaCC=".$_POST['MaCC']);
            return;
        }

        if ( strlen($_POST['Thoigiandien']) == NULL ) {
            $_SESSION['error'] = 'Bad data';
            header("Location: add.php");
            return;
        }

        $status = $statusMsg = ''; 
        if(isset($_POST["submit"])){ 
            $status = 'error'; 
            if(!empty($_FILES["image"]["name"]) && !empty($_FILES["sodo"]["name"])) { 
                // Get file info 
                $fileName = basename($_FILES["image"]["name"]); 
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                
                $fileName1 = basename($_FILES["sodo"]["name"]); 
                $fileType1 = pathinfo($fileName1, PATHINFO_EXTENSION); 

                // Allow certain file formats 
                $allowTypes = array('jpg','png','jpeg','gif'); 
                if(in_array($fileType, $allowTypes) && in_array($fileType1, $allowTypes)){ 
                    $image = $_FILES['image']['tmp_name']; 
                    $imgContent = addslashes(file_get_contents($image)); 
                    $image1 = $_FILES['sodo']['tmp_name']; 
                    $imgContent1 = addslashes(file_get_contents($image1)); 

                    $TenCC = $_POST['TenCC'];
                    $Thoigiandien = $_POST['Thoigiandien'];
                    $Diadiem = $_POST['Diadiem'];
                    $MaCC = $_GET['MaCC'];
                    // Insert image content into database 

                    $insert = $pdo->query("UPDATE concert SET TenCC = '$TenCC', Thoigiandien = '$Thoigiandien', 
                    Diadiem = '$Diadiem', image = '$imgContent', sodo = '$imgContent1' WHERE MaCC = '$MaCC'");

                    // $sql = "UPDATE concert SET TenCC = '$TenCC', Thoigiandien = '$Thoigiandien', 
                    // Diadiem = '$Diadiem', image  WHERE MaCC = $MaCC";
                    
                    // $stmt= $pdo->prepare($sql);
                    // $stmt->execute();

                    if($insert){ 
                        $status = 'success'; 
                        $statusMsg = "File uploaded successfully."; 
                    }else{ 
                        $statusMsg = "File upload failed, please try again."; 
                    }  
                }else{ 
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
                } 
            }else{ 
                $statusMsg = 'Please select an image file to upload.'; 
            } 
        } 
        
        //Display status message 
        echo $statusMsg;
        
        header( 'Location: index.php' ) ;
        return;
    }

    // Guardian: Make sure that MaCC is present
    if ( ! isset($_GET['MaCC']) ) {
    $_SESSION['error'] = "Missing MaCC";
    header('Location: index.php');
    return;
    }

    $stmt = $pdo->prepare("SELECT * FROM concert where MaCC = :xyz");
    $stmt->execute(array(":xyz" => $_GET['MaCC']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ( $row === false ) {
        $_SESSION['error'] = 'Bad value for MaCC';
        header( 'Location: index.php' ) ;
        return;
    }

    // Flash pattern
    if ( isset($_SESSION['error']) ) {
        echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
        unset($_SESSION['error']);
    }

    $n = htmlentities($row['TenCC']);
    $e = htmlentities($row['Thoigiandien']);
    $p = htmlentities($row['Diadiem']);
    $a = base64_encode($row['image']);
    $b = base64_encode($row['sodo']);
    $MaCC = $row['MaCC'];
?>

<body>
    <p>Edit Concert</p>
    <form method="post" enctype="multipart/form-data">
        <p>Name:
        <input type="text" name="TenCC" value="<?= $n ?>"></p>
        <p>Time:
        <input type="date" name="Thoigiandien" value="<?= $e ?>"></p>
        <p>Place:
        <input type="text" name="Diadiem" value="<?= $p ?>"></p>
        <p>Select Image:
        <input type="file" name="image" value="<?= $a ?>"></p>
        <p>Select Chair:
        <input type="file" name="sodo" value="<?= $b ?>"></p>
        <input type="hidden" name="MaCC" value="<?= $MaCC ?>">
        <p><input type="submit" name=submit value="Update"/>
        <a href="../../../view/admin/concerts/index.php">Cancel</a></p>
    </form>
</body>