<?php
//require("classes/database.class.php");
require("classes/login.class.php");
require("inc/user.validation.inc.php");

//session_start();

// if(isset($_SESSION['username']) || isset($_COOKIE['username'])) {
//     header("Location: index.php");
// }

if(isset($_POST['login'])) {

    $validate = new UserValidation($_POST);
    $errors = $validate->validateForm();

    if(count($errors) == 0) {

    $logIn = new Login();

    $email = $_POST['email'];
    $password = $_POST['password'];
    //$remember = isset($_POST['remember_me']) == true ? 1 : 0;

    
    $loginSuccess = $logIn->LoginUsers($email, md5($password)); //$remember);

    if($loginSuccess == true) {
        return true;
        //header("Location: ../index.php");
    } else {
        header("Location: ../views/register.view.php");
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
    <!-- My CSS -->
    <link rel="stylesheet" href="CSS/style.css">
    <title>LogIn</title>
</head>
<body>
    <div class="row justify-content-center" style="margin-top: 55px">
    <div class="loginForm" id="loginForm">
        <form action="index.php" method="POST">
        <div class="card" style="width: 24rem;">
        <div class="card-body">
            <button type="button" id="close_login_form" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
                <?php if(isset($errors) && count($errors) > 0) {
                foreach($errors as $error) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                    <?php } ?>
                <?php } ?>
                <div class="row justify-content-center">
                    <h5 class="card-title">Prisijungimas</h5>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <input type="email" name="email" class="form-control"  aria-label="Sizing example input" placeholder="Jūsų  elektroninis paštas" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <input type="password" name="password" class="form-control"  aria-label="Sizing example input" placeholder="Jūsų slaptažodis" aria-describedby="inputGroup-sizing-sm">
                </div>
                <label for="checkbox">Atsiminti mane</label>
                <input type="checkbox" id="checkbox" name="remember_me"><br>
                <button type="submit" id="loginBtn" name="login" style="margin-top: 8px; margin-bottom: 5px" class="btn btn-outline-primary btn-sm">Prisijungti</button>
                <div>
        </div>
        </div>
        </form> 
        </div>
    </div>
    
</body>
</html>