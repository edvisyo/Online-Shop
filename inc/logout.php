<?php
session_start();
session_destroy();
unset($_SESSION['username']);

//header("Location: ../views/login.view.php");
//header("Location: ../views/register.view.php");
header("Location: ../index.php");