<?php
include"../inc/navigation.inc.php";
require("../classes/database.class.php");
require("../classes/register.class.php");

//session_start();

if(isset($_SESSION['username']) && isset($_SESSION['status'])) {

    $admin_user = 1;
    $add_admin = new Register();

    if(isset($_POST['regist'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $user_status_id = $admin_user;

        $result = $add_admin->adminRegister($name, md5($password), $user_status_id);

        if($result) {
            $registered = TRUE;
        } else {
            printf("REGISTER ERROR");
            exit();
        }

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <div style="margin-top: 20px; margin-bottom: 50px">
    <a href="admin.view.php">Atgal</a>
    </div>
        <div class="row justify-content-center">
        <form action="addnewadmin.php" method="POST" id="new_admin_regist">
        <?php if(isset($registered) && $registered == TRUE) { ?>
        <div class="alert alert-success" role="alert">
            <div style="text-align: center;">
            <?php echo "Naujas administratorius uzregistruotas sekmingai!"; ?>
            </div>
        </div>
        <?php //header('Refresh:3; url=admin.view.php');?>
        <?php } ?>
        <h3>Naujo administratoriaus registravimas</h3>
            Vardas: <input type="text" name="name" autocomplete="off" class="form-control">
            <br>
            Slaptažodis: <input type="password" name="password" class="form-control">
            <br>
            <input type="submit" name="regist" value="Registruoti" class="btn btn-primary">
        </form>
        </div>
        
        <?php } else { ?>
     
     <?php echo '<script>alert("Pirmiausia privalote prisijungti!")</script>'; ?>
     <?php header("Refresh:0.2; url=login.view.php"); ?>
 <?php } ?>
<!-- jQuery Script CDN -->
<!-- <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script> -->
<!-- My Script -->
<script src="../Script/myscript.js"></script>
</body>
</html>