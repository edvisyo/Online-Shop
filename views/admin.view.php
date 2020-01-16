<?php
include"../inc/navigation.inc.php";
require("../classes/database.class.php");
require("../classes/register.class.php");

if(isset($_SESSION['username']) && isset($_SESSION['status'])) {

    // $admin_user = 1;
    // $add_admin = new Register();

    // if(isset($_POST['regist'])) {
    //     $name = $_POST['name'];
    //     $password = $_POST['password'];
    //     $user_status_id = $admin_user;

    //     $result = $add_admin->adminRegister($name, md5($password), $user_status_id);

    //     if($result) {
    //         $registered = TRUE;
    //     } else {
    //         printf("REGISTER ERROR");
    //         exit();
    //     }

    // }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- My Style -->
    <link rel="stylesheet" href="../CSS/style.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <div style="margin-top: 30px; margin-bottom: 40px">
    <h1>Administratoriaus puslapis</h1>
    </div>
    <ul>
    <li><a href="addnewadmin.php" id="new_admin">Naujo administratoriaus registracija</a></li>
    <li><a href="addnewproduct.php">Naujo produkto įkėlimas</a></li>
    <li><a href="addnewcategory.php">Naujos prekės kategorijos sukūrimas</a></li>
    <li><a href="editproducts.php">Redaguoti esamų prekių sarašą</a></li>
    <li><a href="orderlist.php">Užsakymų peržiūrėjimas</a></li>
    </ul>
        
        <?php } else { ?>
     
     <?php echo '<script>alert("Pirmiausia privalote prisijungti!")</script>'; ?>
     <?php header("Refresh:0.2; url=login.view.php"); ?>
 <?php } ?>
</div>
 <?php include "../inc/footer.php"; ?>
<!-- jQuery Script CDN -->
<!-- <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script> -->
<!-- My Script -->
<script src="../Script/myscript.js"></script>
</body>
</html>