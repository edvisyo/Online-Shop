<?php
ob_start(); 
include"../inc/navigation.inc.php";
require("../classes/database.class.php");
require("../classes/products.class.php");
require("../classes/getcategories.class.php");

if(isset($_POST['add_product'])) {

    $add_new_product = new Products();

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $product_category_id = $_POST['product_category_id'];


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
            if($fileSize < 1000000) {
                $fileDestination = '../IMG/'. $fileName;
                move_uploaded_file($fileTmpName, $fileDestination);
                //header("Location: ../views/addnewproduct.php?nuotrauka_ikelta");
            } else {
                echo "Failo dydis per didelis!";
            }
        } else {
            echo "Iskilo problemu ikeliant jusu faila!";
        }
    } else {
        echo "Sitas failo tipas negalimas ikelti!";
    }

    $result = $add_new_product->productRegister($name, $description, $price, $image, $product_category_id);

    if($result = TRUE) {
        $registered = TRUE;
    } else {
        printf("PRODUCT REGISTER ERROR");
            exit();
    }

}

$db = new Products();
$getCategoriesList = $db->getCategory("SELECT * FROM product_category");

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

    <form action="addnewproduct.php" method="POST" enctype="multipart/form-data">
        <?php if(isset($registered) && $registered == TRUE) { ?>
            <div class="alert alert-success" role="alert">
                <div style="text-align: center;">
                <?php echo "Naujas produktas įkeltas sėkmingai!"; ?>
                </div>
            </div>
        <?php } ?>
        Pavadinimas: <input type="text" name="name" class="form-control" autocomplete="off">
        <br>
        Aprašymas: 
        <div class="input-group">
            <textarea class="form-control" name="description" aria-label="With textarea"></textarea>
        </div>
        <br>
        Kaina: <input type="text" name="price" class="form-control">
        <br>
        Nuotrauka: <input type="file" name="image" class="btn btn-default"> 
        <br>
        Produkto kategorija: 
            <div class="input-group mb-3">
            <select class="custom-select" name="product_category_id" id="inputGroupSelect01">
            <?php if(!empty($getCategoriesList)) { ?>
                <?php foreach($getCategoriesList as $categoryList) { ?>
                    <option value="<?php echo $categoryList->getId(); ?>"><?php echo $categoryList->getCategoryName(); ?></option>
                <?php } ?>
            <?php } ?>
            </select>
            </div>
        <br>
        <button type="submit" name="add_product" class="btn btn-primary">Įkelti</button>
    </form>

    </div>
    <?php ob_end_flush(); ?>
</body>
</html>