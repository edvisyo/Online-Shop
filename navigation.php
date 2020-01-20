<?php
require_once("classes/products.class.php");
require_once("classes/getcategories.class.php");

$categories = new Products();
$getAllCategories = $categories->getCategory("SELECT * FROM product_category");

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid" style="width: 80%">
        <a class="navbar-brand" href="index.php" style="color: #ffffff; font-family: 'Kaushan Script', cursive;">Online Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Pagrindinis <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ieškoti pagal kategoriją
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php if($getAllCategories) { ?>
                    <?php foreach($getAllCategories as $category) { ?>
                        <a class="dropdown-item" href="views/product_by_category.php?category_id=<?php echo $category->getId(); ?>"><?php echo $category->getCategoryName(); ?></a>
                    <?php } ?>
                <?php } ?>
                </div>
            </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
            <?php if(!isset($_SESSION['username'])) { ?>
            <div id="btns" style="margin-left: 20px">
            <a href="#" id="login_btn" style="text-decoration: none; margin-right: 15px; color: #a96d22"><b>Prisijungimas</b></a>
            </div>
            <?php } else { ?>
            <?php if(isset($_SESSION['username']) || isset($_COOKIE['username'])) { ?>
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
               <?php if(isset($_SESSION['username']) || isset($_COOKIE['username'])) {
            echo($_SESSION['username']);
            } ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php if(isset($_SESSION['status'])) { ?>    
                <a class="dropdown-item" href="views/admin.view.php">Administratoriaus puslapis</a>
                    <?php } ?>
                <a class="dropdown-item" href="inc/logout.php">Atsijungti</a>
                </div>
            </li>
            </ul>
            <?php } ?>            
            </div>  
            </form>
        </div>
        </div>
        </nav>