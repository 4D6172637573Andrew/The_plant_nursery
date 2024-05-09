<header data-bs-theme="dark">
    <nav class="navbar navbar-expand-md  fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">The plant Nursery</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                            <a href= "cart.php" class="nav-link active" href="#">Cart</a>
                            <a href= "logout.php" class="nav-link active" href="#">Logout</a>
                    </li>

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="phpDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            plants
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="phpDropdown">
                            <li><a href= "Dark_light_mode.php" class="dropdown-item" href="#">All Plants</a></li>
                            <li><a href= "Dark_light_mode.php" class="dropdown-item" href="#">Indoor Plants</a></li>
                            <li><a href= "Dark_light_mode.php" class="dropdown-item" href="#">Oudoor Plants</a></li>
                        </ul>
                    </li>  
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="phpDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            care guides
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="phpDropdown">
                            <li><a href= "Dark_light_mode.php" class="dropdown-item" href="#">Drop</a></li>
                            <li><a href= "Dark_light_mode.php" class="dropdown-item" href="#">Drop</a></li>
                            <li><a href= "Dark_light_mode.php" class="dropdown-item" href="#">Drop</a></li>
                            <li><a href= "Dark_light_mode.php" class="dropdown-item" href="#">Drop</a></li>
                            <li><a href= "Dark_light_mode.php" class="dropdown-item" href="#">Drop</a></li>  
                        </ul>
                    </li> 
                            
                    
                </ul>
                <form class="d-flex" role="search" action="search.php" method="get">
    <input class=" form-control me-2 search_bar" type="search" name="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
</form>
            </div>
        </div>
    </nav>
</header>