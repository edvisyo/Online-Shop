<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid" style="width: 80%">
        <a class="navbar-brand" href="#" style="color: #ffffff; font-family: 'Kaushan Script', cursive;">Online Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
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
                <a class="dropdown-item" href="inc/logout.php">Atsijungti</a>
                </div>
            </li>
            </ul>
            <?php } ?>
            
            <!-- <a href="#" id="login_btn">Prisijungimas</a> -->
            <!-- <a href="#" id="user_menu" style="text-decoration: none;"><h6 style="color: #a96d22"><?php   
            //if(isset($_SESSION['username'])) {
            //echo($_SESSION['username']);
            //} ?>
            </h6></a> 
            <div class="hidden_logout_btn" id="hidden_logout_btn">
            <a href="inc/logout.php">Atsijungti</a>
            </div>  -->
            </form>
        </div>
        </div>
        </nav>