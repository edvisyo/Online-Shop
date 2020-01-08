<?php

if(isset($_POST['add_product'])) {
    $file = $_FILES['image'];

    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if(in_array($fileActualExt, $allowed)) {
        if($fileError === 0) {
            if($fileSize < 500000) {
                $fileDestination = '../uploads/'. $fileName;
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: ../views/testproduct.php?nuotrauka_ikelta");
            } else {
                echo "Failo dydis per didelis!";
            }
        } else {
            echo "Iskilo problemu ikeliant jusu faila!";
        }
    } else {
        echo "Sitas failo tipas negalimas ikelti!";
    }

}