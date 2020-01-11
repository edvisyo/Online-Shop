<?php
include_once "../classes/database.class.php";
require("../classes/products.class.php");
require("../classes/getproducts.class.php");
require("../classes/pagination.class.php");

$products = new Products();
$getAll = $products->getProducts("SELECT * FROM products LIMIT 3"); 


// if(isset($_GET['page'])) {
// $current_page = $_GET['page'];
// } else {
//     $current_page = 1;
// }


$page = isset($_GET['page']) ? $_GET['page'] : 1;
$records_per_page = 3;
$from_record_num = ($records_per_page * $page) - $records_per_page;

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

<?php if($getAll) {
    foreach($getAll as $prod) {
        echo $prod->getId().':';
        echo $prod->getName().'<br>';
    }
} ?>
<a href="testpagination.php?page="></a>
</body>
</html>