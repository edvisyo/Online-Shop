<?php 
require("../classes/database.class.php");
require("../classes/products.class.php");
require("../classes/getcategories.class.php");
require("../classes/category.pagination.class.php");

session_start();


//$products = new Products();
//$getCategories = $products->getCategory("SELECT * FROM product_category");

$category = $_GET['category_id'];

$pagination = new CategoryPaging('products');
$allProducts = $pagination->getDataByCategory($category);
$pages = $pagination->getPageNumbers();

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
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script&display=swap" rel="stylesheet">
    <!-- My CSS -->
    <link rel="stylesheet" href="../CSS/style.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body class="bg-light">
    <header>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid" style="width: 80%">
        <a class="navbar-brand" href="../index.php" style="color: #ffffff; font-family: 'Kaushan Script', cursive;">Online Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Pagrindinis <span class="sr-only">(current)</span></a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li> -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ieškoti pagal kategoriją
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php if($getCategories) { ?>
                    <?php foreach($getCategories as $category) { ?>
                        <a class="dropdown-item" href="views/product_by_category.php?category_id=<?php echo $category->getId(); ?>"><?php echo $category->getCategoryName(); ?></a>
                    <?php } ?>
                <?php } ?>
                </div>
            </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
            <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button> -->
            <?php if(!isset($_SESSION['username'])) { ?>
            <div id="btns" style="margin-left: 20px">
            <a href="#" id="login_btn" style="text-decoration: none; margin-right: 15px; color: #a96d22"><b>Prisijungimas</b></a>
            <a href="#" id="register_btn" style="text-decoration: none; color: #a96d22"><b>Registracija</b></a> 
            </div>
            <?php } else { ?>
            <?php if(isset($_SESSION['username'])) { ?>
            <a href="views/cart.view.php"><i class="fas fa-shopping-cart fa-lg" style="margin-right: 5px"></i></a>
            <?php } ?>
            <?php 
                if(isset($_SESSION['cart'])) {
                    $count = count($_SESSION['cart']);
                    echo "<span><b>$count</b></span>";
                } else {
                    echo "<span><b>0</b></span>";
                }
            ?>
            <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #a96d22;">
               <?php if(isset($_SESSION['username'])) {
            echo($_SESSION['username']);
            } ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="../inc/logout.php">Atsijungti</a>
                </div>
            </li>
            </ul>
            <?php } ?>            
            </div>  
            </form>
        </div>
        </div>
        </nav>

    <?php //include "../inc/navigation.inc.php"; ?>

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
            <li class="page-item"><a class="page-link" href="product_by_category.php?category_id=<?php echo $category; ?>&page=<?php echo $page; ?>"><?php echo $page; ?></a></li> 
            <?php } ?>
            <li class="page-item">
            <a class="page-link" href="index.php?page=3">Last</a>
            </li>
        </ul>
        </nav>
    </div>    
    </main>
    <?php include "../inc/footer.php"; ?>

    <!-- jQuery Script CDN -->
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<!-- JS for Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- My Script -->
<script src="../Script/myscript.js?v=<?php echo time(); ?>"></script>
</body>
</html>