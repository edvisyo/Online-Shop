<?php
ob_start();
include_once "../inc/navigation.inc.php";
require("../classes/database.class.php");
require("../classes/products.class.php");
require("../classes/getproducts.class.php");

$id = $_GET['edit_id'];
$edit = new Products();
$choosed = $edit->getProducts("SELECT * FROM products WHERE id= '$id'");

if(isset($_POST['confirm_edit'])) {
    $id = $_POST['hidden_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $result = $edit->editProduct($id, $name, $description, $price);
    if($result) {
        $_SESSION['message'] = "Prekės duomenys redaguoti sėkmingai";
        header("Location: ../views/editproducts.php");
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
    <div style="margin-top: 20px">
    <a href="editproducts.php">Atgal</a>
    </div>
        <h3 style="margin-top: 30px; margin-bottom: 50px">Prekės redagavimo puslapis</h3>
        <form action="edit_product_info.php" method="POST">
        <?php if($choosed) { ?>
        <?php foreach($choosed as $editprod) {?>
        <input type="hidden" name="hidden_id" value="<?php echo $editprod->getId(); ?>">
        Pavadinimas: <input type="text" name="name" class="form-control" value="<?php echo $editprod->getName(); ?>">
        Aprasymas: <textarea class="form-control" name="description" aria-label="With textarea"><?php echo $editprod->getDescription(); ?></textarea>
        Kaina: <input type="text" name="price" class="form-control" value="<?php echo $editprod->getPrice(); ?>&euro;">
        <hr>
        <button type="submit" name="confirm_edit" class="btn btn-success">Patvirtinti pakeitimus</button>
        </form>
        <?php } ?>
        <?php } ?>



    </div>

    <?php include "../inc/footer.php"; ?>

    <?php ob_end_flush(); ?>
</body>
</html>