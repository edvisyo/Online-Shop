<?php

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
        echo '<script>alert("Prekes duomenys redaguoti sekmingai")</script>';
        //echo '<script>window.location = editproducts.php</script>';
        //header("Location: edit_product_info.php");
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
        <h5>Edit page</h5>
        <form action="edit_product_info.php" method="POST">
        <?php if($choosed) { ?>
        <?php foreach($choosed as $editprod) {?>
        <input type="hidden" name="hidden_id" value="<?php echo $editprod->getId(); ?>">
        Pavadinimas: <input type="text" name="name" class="form-control" value="<?php echo $editprod->getName(); ?>">
        Aprasymas: <input type="text" name="description" class="form-control" value="<?php echo $editprod->getDescription(); ?>">
        Kaina: <input type="text" name="price" class="form-control" value="<?php echo $editprod->getPrice(); ?>">
        <hr>
        <button type="submit" name="confirm_edit" class="btn btn-success">Patvirtinti pakeitimus</button>
        </form>
        <?php } ?>
        <?php } ?>

    </div>
</body>
</html>