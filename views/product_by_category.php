<?php 
require("../classes/database.class.php");
require("../classes/products.class.php");
require("../classes/getcategories.class.php");
require("../classes/pagination.class.php");

$category = $_GET['category_id'];

//$products = new Products();
//$getByCategory = $products->getProducts("SELECT * FROM products WHERE category_id= '$category'");

$pagination = new Pagination('products');
$allProducts = $pagination->getDataByCategory($category);
$pages = $pagination->getPageNumbers();

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
    <header>
        <?php include "../inc/navigation.inc.php"; ?>
    </header>
    <main>
    <div class="container">
    <div class="row justify-content-between">
    <?php if($allProducts) { ?>
    <?php foreach($allProducts as $product) { ?>

        <div class="card" style="width: 18rem; margin-top: 55px; margin-bottom: 70px">
            <img src="../IMG/<?php echo $product->image; ?>" class="card-img-top" height="300" width="300" alt="...">
            <div class="card-body">
            <hr>
                <h5 class="card-title"><?php echo $product->name; ?></h5>
                
                <p><?php echo $product->price; ?>&euro;</p>
                <hr>
                <a href="product.view.php?product_id=<?php echo $product->id; ?>" class="btn btn-primary">Plačiau</a>
            </div>
        </div>
            
    <?php } ?>
    <?php } ?>
    </div>
        <?php if(empty($allProducts)) { ?>
            <div class="alert alert-warning" role="alert" style="text-align: center; margin-top: 50px">
            <?php echo "Jūsų pasirinkta kategorija produktų nėra"; ?>
            </div>
        <?php } ?>
        <nav aria-label="Page navigation example" style="margin-bottom: 80px">
        <ul class="pagination justify-content-center">
            <li class="page-item">
            <a class="page-link" href="index.php?page=1" tabindex="-1" aria-disabled="true">First</a>
            </li>
            <?php for($page = 1; $page <= $pages; $page++) { ?>
            <li class="page-item"><a class="page-link" href="product_by_category.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
            <?php } ?>
            <li class="page-item">
            <a class="page-link" href="index.php?page=3">Last</a>
            </li>
        </ul>
        </nav>
    </div>    
    </main>
    <?php include "../inc/footer.php"; ?>
</body>
</html>