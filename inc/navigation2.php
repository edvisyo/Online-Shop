<header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid" style="width: 80%">
        <a class="navbar-brand" href="#">Navbar</a>
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
            <li class="nav-item">
                <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            <div id="btns">
            <a href="#" id="login_btn">Prisijungimas</a> 
            <a href="#" id="register_btn">Registracija</a>  
            </div>
            <!-- <a href="views/cart.view.php"><i class="fas fa-shopping-cart fa-lg" style="margin-left: 15px"></i></a> -->
            <?php 
                //if(isset($_SESSION['cart'])) {
                    //$count = count($_SESSION['cart']);
                    //echo "<span>$count</span>";
                //} else {
                    //echo "<span>0</span>";
                //}
            ?>
            <!-- <a href="#" id="login_btn">Prisijungimas</a> -->
            <a href="#" id="user_menu"><h6 style="color: black"><?php 
            if(isset($_SESSION['username'])) {
            echo($_SESSION['username']);
            } ?></h6></a>
            <div class="hidden_logout_btn" id="hidden_logout_btn">
            <a href="inc/logout.php">Atsijungti</a>
            </div>
            </form>
        </div>
        </div>
        </nav>
    </header> 