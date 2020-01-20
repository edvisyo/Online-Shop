<?php
include_once "../classes/database.class.php";
include_once "../classes/register.class.php";
require_once("../inc/register.validation.inc.php");

session_start();


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
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script&display=swap" rel="stylesheet">
    <!-- My CSS -->
    <link href="../CSS/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" /> 
    <title>Register</title>
</head>
<body class="bg-light">
<h1 style="text-align: center; font-family: 'Kaushan Script', cursive; margin-top: 30px">Online Store</h1>
    <div class="row justify-content-center" style="margin-top: 30px">
    <div class="registerForm" id="registerForm">
        <form action="register.view.php" method="POST">
        <div class="" style="width: 58rem;">
        <div class="card-body">
            </button> 
                <div class="row justify-content-center">
                    <h4 class="card-title">Registracija</h4>
                </div>
                <?php if(isset($errors) && count($errors) > 0) {
                foreach($errors as $error) { ?>
                    <div class="alert alert-danger" role="alert" style="text-align: center">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>
                <?php } else if(isset($success) && $success == TRUE) { ?>
                    <div class="alert alert-success" role="alert">
                    <div style="text-align: center;">
                        <p>Registracija sėkminga!</p>
                        <?php $regist->loginAfterRegister($email, md5($password)); ?>
                        </div>
                    </div>
                    <?php header("Refresh:4; url=../index.php") ?>
                <?php }  ?>
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
<?php include "../inc/footer.php"; ?>
</body>
</html>