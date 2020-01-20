<?php
include"../inc/navigation.inc.php";
require_once("../classes/database.class.php");
require_once("../classes/products.class.php");

if(isset($_POST['add'])) {

    $category_name = $_POST['category'];

    $category = new Products();
    $result = $category->categoryRegist($category_name);

    if($result) {
        $registered == TRUE;
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
        <form action="addnewcategory.php" method="POST">
            Kategorijos pavadinimas: <input type="text" name="category" class="form-control" autocomplete="off">
            <br>
            <button type="submit" name="add" class="btn btn-primary">Įkelti</button>
        </form>
    </div>
    
</body>
</html>