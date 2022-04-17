<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand ps-5" href="index.php">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#idDeLaCible">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="idDeLaCible">
            <ul class="navbar-nav m-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="pc-gamer.php">PC Gamer</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="ordinateur-de-bureau.php">Ordinateur de bureau</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="pc-portable.php">PC portable</a>
                </li>
                <li class="nav-item mx-2 dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">Périférique</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="ecran.php">Ecran</a></li>
                        <li><a class="dropdown-item" href="clavier.php">Clavier</a></li>
                        <li><a class="dropdown-item" href="souris.php">Souris</a></li>
                        <li><a class="dropdown-item" href="casque-audio.php">Casque audio</a></li>
                    </ul>
                </li>
                <?php 
                if (isset($_SESSION['admin'])) { 
                ?>
                    <li class="nav-item mx-2 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Administration</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="ajouter-produit.php">Ajouter un produit</a></li>
                            <li><a class="dropdown-item" href="modif-produit.php">Modifier un produit</a></li>
                        </ul>
                    </li>
                <?php 
                } 
                ?>
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
