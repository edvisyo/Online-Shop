<?php 
require("../classes/database.class.php");
require("../classes/products.class.php");
require("../classes/getproducts.class.php");
//include "../inc/navigation.inc.php";
session_start();

$product = new Products();

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
        <a class="navbar-brand" href="#" style="color: #ffffff; font-family: 'Kaushan Script', cursive;">Online Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
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
            <a href="../views/cart.view.php"><i class="fas fa-shopping-cart fa-lg" style="margin-left: 15px"></i></a>
            <?php } ?>
            <?php 
                if(isset($_SESSION['cart'])) {
                    $count = count($_SESSION['cart']);
                    echo "<span>$count</span>";
                } else {
                    echo "<span>0</span>";
                }
            ?>
            <?php } ?>
            
            <!-- <a href="#" id="login_btn">Prisijungimas</a> -->
            <a href="#" id="user_menu"><h6 style="color: black"><?php 
            if(isset($_SESSION['username'])) {
            echo($_SESSION['username']);
            } ?></h6></a>
            <div class="hidden_logout_btn" id="hidden_logout_btn">
            <a href="../inc/logout.php">Atsijungti</a>
            </div>
            </form>
        </div>
        </div>
        </nav>
    </header>

<?php //include "../inc/navigation.inc.php"; ?>

                <!-- Hidden Login Form  -->
                <?php //include "login.view.php"; ?>
                <!-- End Login Form -->
                <!-- Hidden Register From -->
                <?php //include "register.view.php"; ?>
                <!-- End Register Form -->

    <div class="container">
        <?php if($getProductId) { ?>
            <?php foreach($getProductId as $productId) { ?>
                <h3 style="margin-top: 55px"><?php echo $productId->getName(); ?></h3>
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
                    <p>Parduotuve gali naudotis tik uzsiregistrave vartotojai.</p>
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
<!-- <div style="position: fixed; bottom: 0"> -->
<?php include "../inc/footer.php"; ?>
<!-- </div> -->
</body>
</html>
