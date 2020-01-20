<?php 
require_once("../classes/database.class.php");
require_once("../classes/products.class.php");
require_once("../classes/getproducts.class.php");
require_once("../classes/getcategories.class.php");

session_start();

$product = new Products();

$getAllCategories = $product->getCategory("SELECT * FROM product_category");

$id = $_GET['product_id'];
$getProductId = $product->getProducts("SELECT * FROM products WHERE id= '$id'");

if(isset($_POST['add_to_cart'])) {

    if(isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], 'product_Id');
        if(in_array($_POST['hidden_id'], $item_array_id)) {
            echo '<script>alert("Produktas jau pridetas jusu krepselyje!")</script>';
            echo '<script>window.location = product.view.php</script>';
        } else {
            $count_products = count($_SESSION['cart']);
            $item_array = array(
                'product_Id' => $_POST['hidden_id'],
                'product_name' => $_POST['hidden_name'],
                'product_price' => $_POST['hidden_price'],
                'product_quantity' => $_POST['quantity'],
                'total_price' => $_POST['quantity'] * $_POST['hidden_price']
            );
            $_SESSION['cart'][$count_products] = $item_array;
            echo '<script>alert("Preke prideta i krepseli!")</script>';
            echo '<script>window.location = product.view.php</script>';
        }
    } else {
        $item_array = array(
            'product_Id' => $_POST['hidden_id'],
            'product_name' => $_POST['hidden_name'],
            'product_price' => $_POST['hidden_price'],
            'product_quantity' => $_POST['quantity'],
            'total_price' => $_POST['quantity'] * $_POST['hidden_price']
        );
        $_SESSION['cart'][0] = $item_array;
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
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script&display=swap" rel="stylesheet">
    <!-- My CSS -->
    <link rel="stylesheet" href="../CSS/style.css?v=<?php echo time(); ?>">
    <title>Shopping Page</title>
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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ieškoti pagal kategoriją
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php if($getAllCategories) { ?>
                    <?php foreach($getAllCategories as $category) { ?>
                        <a class="dropdown-item" href="product_by_category.php?category_id=<?php echo $category->getId(); ?>"><?php echo $category->getCategoryName(); ?></a>
                    <?php } ?>
                <?php } ?>
                </div>
            </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
            <?php if(!isset($_SESSION['username'])) { ?>
            <div id="btns" style="margin-left: 20px">
            </div>
            <?php } else { ?>
            <?php if(isset($_SESSION['username'])) { ?>
            <a href="cart.view.php"><i class="fas fa-shopping-cart fa-lg" style="margin-right: 5px"></i></a>
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
                <?php if(isset($_SESSION['status'])) { ?>    
                <a class="dropdown-item" href="../views/admin.view.php">Administratoriaus puslapis</a>
                    <?php } ?>
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

    </header>

                

    <div class="container">
        <?php if($getProductId) { ?>
            <?php foreach($getProductId as $productId) { ?>
                <h3 style="margin-top: 55px;"><?php echo $productId->getName(); ?></h3>
                <br>
                <div class="row justify-content-between">
                <div class="card">
                <img src="../IMG/<?php echo $productId->getImage(); ?>" style="margin-left: 5px; width: 550px;" height="400" class="card-img-top" alt="...">
                </div>
                <div class="description" style="margin-right: 85px">
                <h5>Kaina:</h5>
                <h4><?php echo $productId->getPrice(); ?> &euro;</h4> 
                <hr>
                <h5>Prekės aprašymas:</h5>
                <p style="width: 350px"><?php echo $productId->getDescription(); ?>. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem assumenda soluta, 
                omnis vitae repellendus similique necessitatibus natus cumque dolore dolorum id blanditiis tempore. Modi minus molestiae iusto maiores nisi pariatur!</p>
                <?php if(!isset($_SESSION['username'])) { ?>
                    <br>
                    <strong>Pastaba!</strong>
                    <p>Parduotuve gali naudotis tik užsiregistravę vartotojai.</p>
                    <a href="register.view.php">Registruotis</a>
                <?php } else { ?>
                    <?php if(isset($_SESSION['username'])) { ?>
                <form action="product.view.php?product_id=<?php echo $productId->getId(); ?>" method="POST">
                <h5>Kiekis:</h5> <input type="number" name="quantity" class="form-control" value="1" autocomplete="off">
                <input type="hidden" name="hidden_price" value="<?php echo $productId->getPrice(); ?>">
                <input type="hidden" name="hidden_name" value="<?php echo $productId->getName(); ?>">
                <input type="hidden" name="hidden_id" value="<?php echo $productId->getId(); ?>">
                <br>
                <button type="submit" name="add_to_cart" class="btn btn-success">Pirkti</button>
                </form> 
                    <?php } ?>
                <?php } ?>
                </div>
                </div>
    </div>
    <?php } ?>
<?php } ?>

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
