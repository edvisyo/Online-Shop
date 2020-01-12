<?php
ob_start();
include "../inc/navigation.inc.php";
require("../classes/database.class.php");
require("../classes/products.class.php");
require("../classes/getproducts.class.php");
require("../classes/orders.class.php");


if(isset($_SESSION['cart'])) {
$product = new Products();

$product_id = array_column($_SESSION['cart'], 'product_Id');
$quantity = array_column($_SESSION['cart'], 'product_quantity');

$total_price = array_column($_SESSION['cart'], 'total_price');
$total = array_sum($total_price);

$getProducts = $product->getProducts("SELECT * FROM products WHERE id IN (" . implode(',', $product_id) . ")");
//print_r($_SESSION['cart']);
// if(!empty($_SESSION['cart'])) {
//     foreach($_SESSION['cart'] as $item => $value) {
//         if($value['product_Id'] == $product_id) {
//             unset($_SESSION["cart"][$item]);
//         }
//     } 
// }

// if(isset($_POST['delete'])) {
//     unset($_SESSION["cart"][$item]);
//     header("Location: cart.view.php");
// } 


if(isset($_GET['productID'])) {
    $id = $_GET['productID'];
        foreach($_SESSION['cart'] as $item => $value) {
            if($value['product_Id'] == $id) {
            unset($_SESSION["cart"][$item]);
        }
    }
}
else if (isset($_POST['buy'])) {
    if(isset($_SESSION['cart'])) {

    $user_id = $_SESSION['userId'];
    $item_array = ($_SESSION['cart']);
    
    foreach($item_array AS $ordered_items => $products) {
        $product_id = $products['product_Id'];
        $product_name = $products['product_name'];
        $product_price = $products['product_price'];
        $product_quantity = $products['product_quantity'];
        $total_price = $products['total_price'];

        $order = new Orders();
        $insert = $order->makeOrder($user_id, $product_id, $product_name, $product_price, $product_quantity, $total_price);

    if($insert = TRUE) {
        $order_success = TRUE;
    }   else {
           printf("Iskilo problemu vykdant jusu uzsakyma");
           exit();
        } 
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
    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- My CSS -->
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Document</title>
</head>
<body>

    <div class="container">
        <h4>Jūsų prekių krepšelis</h4>
        <form action="cart.view.php" method="POST">

        <?php if(isset($order_success) && $order_success == TRUE) { ?>
        <div class="alert alert-success" role="alert">
            <div style="text-align: center;">
            <?php echo "Jūsų užsakymas pateiktas"; ?>
            </div>
        </div> 
        <?php } ?>
            <table class="table">
            <thead class="thead-light">
                <tr>
                <th scope="col">Paveikslėlis</th>
                <th scope="col">Pavadinimas</th>
                <th scope="col">Kiekis:</th>
                <th scope="col">Kaina:</th>
                <th scope="col"></th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php
            if(is_array($getProducts)) { ?>
               <?php foreach($getProducts as $products) { ?>
                <tr>
                <td><img src="../IMG/<?php echo $products->getImage(); ?>" style="width: 130px; height: 130px" class="card-img-top" alt="..."></td>
                <td><?php echo $products->getName(); ?></td>
                <td><?php 
                    foreach($quantity as $key => $value) {
                        echo $value;
                    } 
                ?></td> 
                <td><?php echo $products->getPrice(); ?>&euro;</td>
                <!-- <td><button type="submit" name="delete" class="btn btn-danger">Pašalinti</button></td>  -->
                <!-- <td><a href="cart.view.php?productID=<?php //echo $products->getId(); ?>">Pašalinti</a></td> -->
                <td><a href="cart.view.php?productID=<?php echo $products->getId(); ?>" class="btn btn-danger">Pašalinti</a></td> 
                </tr>
                <?php } ?>
            <?php } else { ?>
            <div class="alert alert-success" role="alert" style="text-align: center">
            <?php echo "Jūsų visos prekės pašalintos" ?>
            </div>
            <?php } ?>
            </tbody>
            </table>
            <div class="row justify-content-between" style="margin-top: 50px">
            <div class="totalprice">
            <h5>Pilna kaina: <?php echo $total; ?>&euro;</h5>
            </div>
            <div class="orderbtn">
            <button name="buy" class="btn btn-success">Pateikti užsakymą</button>
            </div>
            </div>
            </form>
    </div>

    <?php } else { ?>
    <div class="container"> 
    <h4>Jūsų prekių krepšelis</h4>
        <table class="table">
            <thead class="thead-light">
                <tr>
                <th scope="col">id</th>
                <th scope="col">Paveikslėlis</th>
                <th scope="col">Pavadinimas</th>
                <th scope="col">Kiekis:</th>
                <th scope="col">Kaina:</th>
                </tr>
            </thead>
            <tbody>
            <th></th>
            <th></th>
            <th><p>Jūsų krepšelis tuščias</p></th>
            <th></th>
            <th></th>
            </tbody>
        </table>
    </div> 
    <?php } ?>
    <?php ob_end_flush(); ?>
</body>
</html>

        