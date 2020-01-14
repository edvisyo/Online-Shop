<?php

//include_once "../classes/database.class.php";
include_once "classes/register.class.php";
require("inc/register.validation.inc.php");

// session_start();

// if(isset($_SESSION['username'])) {
//     header("Location: ../index.php");
// }

if(isset($_POST['send'])) {

    $validation = new RegisterValidation($_POST);
    $errors = $validation->validateForm();

    if(count($errors) == 0) {   

    $default_user = 2;    
    $regist = new Register();

    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_status_id = $default_user;

    $result = $regist->userRegister($name, $lastname, $email, md5($password), $user_status_id);

        if($result) {
            $success = TRUE;
        }       else {
            printf("REGISTER ERROR");
            exit();
        }

    }
}
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
    <title>Register</title>
</head>
<body>

    <div class="row justify-content-center" style="margin-top: 0px">
    <div class="registerForm" id="registerForm">
        <form action="index.php" method="POST">
        <div class="card" style="width: 24rem;">
        <div class="card-body">
            <button type="button" id="close_register_form" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true" style="color: black">&times;</span>
            </button>
                <?php if(isset($errors) && count($errors) > 0) {
                foreach($errors as $error) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                    <?php } ?>
                <?php } else if(isset($success) && $success == TRUE) { ?>
                    <div class="alert alert-success" role="alert">
                    <div style="text-align: center;">
                        <p>Registracija sėkminga!</p>
                        <p>Greit būsite nukreipti į prisijungimą</p>
                        </div>
                    </div>
                    <?php header("Refresh:4; url=login.view.php") ?>
                <?php }  ?>
                <div class="row justify-content-center">
                    <h5 class="card-title">Registracija</h5>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <input type="text" name="name" class="form-control"  aria-label="Sizing example input" placeholder="Jūsų Vardas" aria-describedby="inputGroup-sizing-sm" autocomplete="off">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <input type="text" name="lastname" class="form-control"  aria-label="Sizing example input" placeholder="Jūsų Pavardė" aria-describedby="inputGroup-sizing-sm" autocomplete="off">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <input type="email" name="email" class="form-control"  aria-label="Sizing example input" placeholder="Jūsų El.Pašto adresas" aria-describedby="inputGroup-sizing-sm" autocomplete="off">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <input type="password" name="password" class="form-control"  aria-label="Sizing example input" placeholder="Jūsų Slaptažodis" aria-describedby="inputGroup-sizing-sm" autocomplete="off">
                </div>
                <button type="submit" name="send" class="btn btn-outline-primary btn-sm">Registruotis</button>
                <div>
        </div>
        </div>
        </form> 
    </div>
    </div>

</body>
</html>