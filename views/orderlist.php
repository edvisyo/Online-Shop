<?php
ob_start();
include "../inc/navigation.inc.php";
require_once("../classes/database.class.php");
require_once("../classes/orders.class.php");
require_once("../classes/getorders.class.php");


$orders = new Orders();
$getAll = $orders->getOrders("SELECT * FROM orders ORDER BY order_created_at ASC");


if(isset($_GET['order_id'])) {
    $id = $_GET['order_id'];
    $result = $orders->deleteOrders($id);

    if($result) {
        header("Refresh:0.1; url=orderlist.php");
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
<body class="bg-light">  
<div class="container">
<div style="margin-top: 20px; margin-bottom: 20px">
    <a href="admin.view.php">Atgal</a>
    </div>
    <h3 style="margin-bottom: 30px">Užsakymai</h3>
    <?php if($getAll) { ?>
        <?php foreach($getAll as $order) { ?>
<div class="my-3 p-3 bg-white rounded shadow-sm">
<small class="d-block text-right mt-3">
      <a href="orderlist.php?order_id=<?php echo $order->getId(); ?>">Žymėti kaip surinktą</a> 
    </small>
    <h6 class="border-bottom border-gray pb-2 mb-0">Recent updates</h6>
    <div class="media text-muted pt-3">
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
      <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <strong class="d-block text-gray-dark">Vartotojo ID: <?php echo $order->getUserId(); ?></strong>
        Užsakymo laikas: <?php echo $order->getOrderDate(); ?>
      </p>
    </div>
        <ul class="text-gray-dark">
            <li>Produkto ID: <a href="product.view.php?product_id=<?php echo $order->getProductId(); ?>"><?php echo $order->getProductId(); ?></li></a>
            <li>Produkto pavadinimas: <?php echo $order->getProductName(); ?></li>
            <li>Produkto kiekis: <?php echo $order->getProductQuantity(); ?></li>
        </ul>
  </div>
        <?php } ?>
    <?php } else {?>
        <div class="alert alert-success" role="alert" style="margin-top: 50px; text-align: center;">
        <?php echo "<p>Šiuo metu užsakymų nėra</p>"; ?>
        </div>
    <?php } ?>
</div>    

    
        
<?php ob_end_flush(); ?>
</body>
</html>