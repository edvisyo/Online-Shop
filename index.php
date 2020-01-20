<?php
include_once "inc/autoloader.inc.php";

$pagination = new Pagination('products');
$allProducts = $pagination->getData();
$pages = $pagination->getPageNumbers();

session_start();
    
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
    <link href="CSS/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" /> 
    <title>ShoppingPage</title>
</head>
<body class="bg-light">

<header>
                <?php include "navigation.php"; ?>
</header>
     
<main>   
                <!-- Hidden Login Form  -->
                <?php include "views/login.view.php"; ?>
                <!-- End Login Form -->
    <div class="container">
    <?php if(isset($errors) && count($errors) > 0) {
                foreach($errors as $error) { ?>
                    <div class="alert alert-danger" role="alert" style="text-align: center">
                        <?php echo $error; ?>
                    </div>
                    <?php } ?>
                <?php } ?>
        <div class="row justify-content-between">
    <?php if($allProducts) { ?>
    <?php foreach($allProducts as $product) { ?>

        <div class="card" style="width: 18rem; margin-top: 0px; margin-bottom: 70px">
            <img src="IMG/<?php echo $product->image; ?>" class="card-img-top" height="300" width="300" alt="...">
            <div class="card-body">
            <hr>
                <h5 class="card-title"><?php echo $product->name; ?></h5>
                
                <p><?php echo $product->price; ?>&euro;</p>
                <hr>
                <a href="views/product.view.php?product_id=<?php echo $product->id; ?>" class="btn btn-primary">Plačiau</a>
            </div>
        </div>
            
    <?php } ?>
    <?php } ?>
    </div>

        <nav aria-label="Page navigation example" style="margin-bottom: 80px">
        <ul class="pagination justify-content-center">
            <li class="page-item">
            <a class="page-link" href="index.php?page=<?php echo $pagination->prevPage(); ?>" tabindex="-1" aria-disabled="true">Atgal</a>
            </li>
            <?php for($page = 1; $page <= $pages; $page++) { ?>
            <li class="page-item <?php echo $pagination->is_active($page); ?>"><a class="page-link" href="index.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
            <?php } ?>
            <li class="page-item">
            <a class="page-link" href="index.php?page=<?php echo $pagination->nextPage($page); ?>">Pirmyn</a>
            </li>
        </ul>
        </nav>

    </div>
</main>
    
    <?php include "inc/footer.php"; ?>


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
<script src="Script/myscript.js?v=<?php echo time(); ?>"></script>
</body>
</html>