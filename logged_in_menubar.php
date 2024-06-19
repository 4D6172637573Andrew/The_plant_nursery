<!DOCTYPE html>
<html lang="en-GB">


<header data-bs-theme="dark">
    <nav class="navbar navbar-expand-md fixed-top">
        <div class="container-fluid d-flex justify-content-between">
            <a class="home_title navbar-brand" href="index.php">The plant Nursery</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <ul class="navbar-nav mb-2 mb-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="plantsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Plants
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="plantsDropdown">
                            <li><a href="all_plants.php" class="dropdown-item">SHOP</a></li>
                            <li><a href="care.php" class="dropdown-item">Care guides</a></li>
                        </ul>
                    </li>
                </ul>

                <form class="d-flex mx-auto" role="search" action="search.php" method="get">
                    <input class="form-control me-2 search_bar" type="search" name="search" placeholder="Search" aria-label="Search">
                </form>

                <ul class="navbar-nav mb-2 mb-md-0">
                    <li class="nav-item">
                        <a href="cart.php" class="nav-link active"> 
                        <i href="cart.php" class="nav-link active fa fa-shopping-cart" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav mb-2 mb-md-0">
                    <li class="nav-item">
                        <a href="liked_plant.php" class="nav-link active"> 
                        <i href="liked_plant.php" class="nav-link active fa fa-heart" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav mb-2 mb-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="Account_dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="Account_dropdown">
                            <li><a href="manage.php" class="nav-link active">Manage Account</a></li>
                            <li><a href="logout.php" class="nav-link active">Logout</a></li>
                        </ul>
                    </li> 
                </ul>          

            </div>
        </div>
    </nav>
</header>


