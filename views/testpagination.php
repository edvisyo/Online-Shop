<?php
include_once "../classes/database.class.php";
// require("../classes/products.class.php");
// require("../classes/getproducts.class.php");
require("../classes/pagination.class.php");

//require_once 'class/Pagination.php';
	//$pagination =  new Pagination('products');
	//$users = $pagination->get_data();
	//$pages	= $pagination->get_pagination_numbers();

$pagination = new Pagination('products');
$all = $pagination->getData();
//$pagination->set_total();
//echo $pagination;
//var_dump($all);
$pages  = $pagination->getPageNumbers();
//echo $pages;


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
    <title>Document</title>
</head>
<body>
<?php foreach($all as $a) { ?>
        <?php echo $a->name; ?>
<?php } ?>
<br>
<?php for($page=1; $page <= $pages; $page++) { ?>
    <?php //if($pagination->is_showable($page)) { ?>
        <a href="testpagination.php?page=<?php echo $page;?>"><?php echo $page; ?></a> 
    <?php //} ?>
<?php } ?>

<!-- <ul class="pagination justify-content-center">
    <li class="page-item">
        <a class="page-link" href="index.php" tabindex="-1" aria-disabled="true">First</a>
    </li>
    <?php //for ($page = 1; $page <= $number_of_pages; $page++) { ?>
    <li class="page-item"><a class="page-link" <?php //echo '<a href="pagination.php?page=' . $page . '">' . $page . '</a>'; ?></a></li>
    <?php //} ?>
    <li class="page-item">
      <a class="page-link" href="#">Last</a>
    </li>
  </ul>  -->
</body>
</html>