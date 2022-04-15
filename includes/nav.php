<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#idDeLaCible">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="idDeLaCible">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Dropdown</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Link</a></li>
                        <li><a class="dropdown-item" href="#">Another link</a></li>
                        <li><a class="dropdown-item" href="#">A third link</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav d-flex">
            <?php
                //* deconnection || connection et inscription
                    if(isset($_SESSION['id'])){
                        echo '<li class="nav-item"><a class="nav-link" href="includes/logout.php">Déconnection</a></li>';
                    }else{
                        echo '<li class="nav-item"><a class="nav-link" href="connexion.php">Connexion</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="inscription.php">Inscription</a></li>';
                    }
            ?>
            </ul> 
        </div>
    </div>
</nav>
