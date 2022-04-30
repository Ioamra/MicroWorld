<?php session_start(); 
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>MicroWorld</title>
	<?php require_once "includes/head.php"; ?>
    <script src="assets/js/produit.js"></script>
</head>
	<body class="body-bg-grey">
		<?php
		require_once "includes/autoload.php";
		require_once "includes/nav.php";
        $managerAvisClient = new AvisClientManager($bdd);
        $managerClient = new ClientManager($bdd);

        // * Si a avis a été poser
        if (isset($_POST['submitAvis'])) {
            $noteAvis = htmlspecialchars($_POST['noteAvis']);
            $titreAvis = htmlspecialchars($_POST['titreAvis']);
            $contenuAvis = htmlspecialchars($_POST['contenuAvis']);

            $managerAvisClient->add(
                new AvisClient([
                    "IdProduit" => $_GET['id'],
                    "DateAvis" => date("Y-m-d"),
                    "IdClient" => $_SESSION['id'],
                    "Note" => $noteAvis,
                    "Titre" => $titreAvis,
                    "Contenu" => $contenuAvis
                ])
            );
        }


        $managerProduit = new ProduitManager($bdd);
        $managerImageProduit = new ImageProduitManager($bdd);
        $infoProduit = $managerProduit->get($id);
        $infoImage = $managerImageProduit->get($id);
		?>
		<div class="box-produit">
            <div class="row row-cols-1">
                <div class="col col-lg-4">
                    <?php
                    echo '<a href="'.$infoImage[0]['cheminImage'].'" target="_blank"><img id="img-principal" src="'.$infoImage[0]['cheminImage'].'" style="height:auto; width:100%;"></a>';
                    ?>
                    <div class="row">
                    <?php
                    if (count($infoImage) > 1) {
                        foreach ($infoImage as $val) {
                            echo '<div class="col" role="button" onclick="switchImgProduit('."'".$val['cheminImage']."'".')"><img src="'.$val['cheminImage'].'" style="height:auto; width:100%;"></div>';
                        }
                    }
                    ?>
                    </div>
                </div>
                <div class="col col-lg-6">
                    <?php
                    echo '<h3>'.$infoProduit->getNom().'</h3>';
                    echo '<p class="description p-3">'.$infoProduit->getDescriptionProduit().'</p>'
                    ?>
                </div>
                <div class="col col-lg-2">
                    <?php
                        if ($infoProduit->getDispo() == 1) {
                            echo '<div class="card m-2 p-3">';
                            echo '<h3 class="text-center">'.$infoProduit->getPrix().' €</h3>';
                            echo '<p class="text-center">Livraison gratuite</p>';
                            echo '<button class="btn btn-primary" onclick="let panier = new Panier(); panier.add({id:'.$id.',nom:'."'".substr(stripslashes($infoProduit->getNom()),0,20).
                                "...'".',prix:'.$infoProduit->getPrix().',cheminImage:'."'".$infoImage[0]['cheminImage']."'".'}); actuNavPanier(); if (confirm('."'".'Le produit à été ajouter au panier. Voulez vous voir votre panier?'."'".') == true){window.location.href='."'".'panier.php'."'".';}">Ajouter au panier</button>';
                            echo '</div>';
                        } else {
                            echo '<div class="card m-2 p-3">';
                            echo '<h3 class="text-center">'.$infoProduit->getPrix().' €</h3>';
                            echo '<p class="text-center btn btn-danger">Produit indisponible</p>';
                            echo '</div>';
                        }

                    //* Si le client a déjè acheter le produit => possibilité de poser un avis
                    if (isset($_SESSION['id'])) {
                        $posibilitePoseAvis = false;
                        $managerCommande = new CommandeManager($bdd);
                        $managerLigneDeCommande = new LigneDeCommandeManager($bdd);
                        $listeCommandeClient = $managerCommande->getByIdClient($_SESSION['id']);
                        foreach ($listeCommandeClient as $li) {
                            $res = $managerLigneDeCommande->verifProduitAchete(
                                new LigneDeCommande([
                                    "IdCmde" => $li->getIdCmde(),
                                    "IdProduit" => $_GET['id']
                                ])
                            );
                            if ($res > 0) $posibilitePoseAvis = true;
                        }
                        if ($posibilitePoseAvis == true) {
                    ?>
                            <div class="card m-2 p-3">
                                <h5 class="text-center">Vous avez déjà acheter ce produit.<br>Ecrivez un commentaire.</h5>
                                <form method="post">
                                    <div class="noteAvis">
                                        <input type="radio" name="noteAvis" value="5" id="5" required/><label for="5">☆</label>
                                        <input type="radio" name="noteAvis" value="4" id="4" /><label for="4">☆</label>
                                        <input type="radio" name="noteAvis" value="3" id="3" /><label for="3">☆</label>
                                        <input type="radio" name="noteAvis" value="2" id="2" /><label for="2">☆</label>
                                        <input type="radio" name="noteAvis" value="1" id="1" /><label for="1">☆</label>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-center">
                                        <input type="text" name="titreAvis" id="titreAvis" class="w-100" pattern=".{0,60}" required>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-center">
                                        <textarea name="contenuAvis" id="contenuAvis" class="w-100" pattern=".{0,800}" required></textarea>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-center">
                                        <button class="btn btn-primary" name="submitAvis">valider</button>
                                    </div>
                                </form>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
            echo $infoProduit->getCaracteristique();

            // Si il y a des avis client
            if (!empty($managerAvisClient->getByIdProduit($_GET['id']))) {

                $moyenneAvis = round($managerAvisClient->getMoyenne($_GET['id']), 2);
                $roundMoyenneAvis = round($moyenneAvis);
                $nbAvis = $managerAvisClient->countByIdProduit($_GET['id']);
                $ratio_5 = round($managerAvisClient->countByIdProduitAndNote($_GET['id'], 5) / $nbAvis * 100, 2);
                $ratio_4 = round($managerAvisClient->countByIdProduitAndNote($_GET['id'], 4) / $nbAvis * 100, 2);
                $ratio_3 = round($managerAvisClient->countByIdProduitAndNote($_GET['id'], 3) / $nbAvis * 100, 2);
                $ratio_2 = round($managerAvisClient->countByIdProduitAndNote($_GET['id'], 2) / $nbAvis * 100, 2);
                $ratio_1 = round($managerAvisClient->countByIdProduitAndNote($_GET['id'], 1) / $nbAvis * 100, 2);
            ?>
            <div class="row row-cols-1 pt-5">
                <div class="col col-lg-3 card p-2 m-2">
                    <h3>Commentaires client</h3>
                    <div class="w-100">
                        <div class="etoile d-inline pe-2">
                            <?php
                            for ($i=0; $i < $roundMoyenneAvis; $i++) { 
                                echo '★';
                            }
                            for ($i=0; $i < 5-$roundMoyenneAvis; $i++) { 
                                echo '☆';
                            }
                            ?>
                        </div>
                        <div class="d-inline">
                            <?php echo $moyenneAvis; ?> sur 5
                        </div>
                        <div class="mb-3">
                            <?php echo $nbAvis; ?> évaluations
                        </div>
                    </div>

                    <div class="w-100 mb-2">
                        <div class="d-inline-block label-ratio-avis"> 5 étoiles </div>
                        <div class="d-inline-block bar-avis">
                            <div class="ratio-bar-avis" style="width:<?=$ratio_5;?>%;"> </div>
                        </div>
                        <div class="d-inline-block ratio-avis"><?=$ratio_5;?> %</div>
                    </div>

                    <div class="w-100 mb-2">
                        <div class="d-inline-block label-ratio-avis"> 4 étoiles </div>
                        <div class="d-inline-block bar-avis">
                            <div class="ratio-bar-avis" style="width:<?=$ratio_4;?>%;"> </div>
                        </div>
                        <div class="d-inline-block ratio-avis"><?=$ratio_4;?> %</div>
                    </div>

                    <div class="w-100 mb-2">
                        <div class="d-inline-block label-ratio-avis"> 3 étoiles </div>
                        <div class="d-inline-block bar-avis">
                            <div class="ratio-bar-avis" style="width:<?=$ratio_3;?>%;"> </div>
                        </div>
                        <div class="d-inline-block ratio-avis"><?=$ratio_3;?> %</div>
                    </div>

                    <div class="w-100 mb-2">
                        <div class="d-inline-block label-ratio-avis"> 2 étoiles </div>
                        <div class="d-inline-block bar-avis">
                            <div class="ratio-bar-avis" style="width:<?=$ratio_2;?>%;"> </div>
                        </div>
                        <div class="d-inline-block ratio-avis"><?=$ratio_2;?> %</div>
                    </div>

                    <div class="w-100 mb-2">
                        <div class="d-inline-block label-ratio-avis"> 1 étoiles </div>
                        <div class="d-inline-block bar-avis">
                            <div class="ratio-bar-avis" style="width:<?=$ratio_1;?>%;"> </div>
                        </div>
                        <div class="d-inline-block ratio-avis"><?=$ratio_1;?> %</div>
                    </div>

                </div>
                <div class="col col-lg-6 card m-2" id="avis-client">
                <?php
                    $listeAvis = $managerAvisClient->getByIdProduit($_GET['id']);
                    if (isset($_GET['avis']) || $nbAvis < 6) {
                        foreach ($listeAvis as $li) {
                            $dataClient = $managerClient->get($li->getIdClient());
                            echo '<div class="p-2">';
                            echo '    <div>de '.$dataClient->getPseudo().', commenté le '.date("d-m-Y", strtotime($li->getDateAvis())).'</div>';
                            switch ($li->getNote()) {
                                case 1:
                                    echo '<div class="etoile d-inline pe-4">★☆☆☆☆</div>';
                                    break;
                                case 2:
                                    echo '<div class="etoile d-inline pe-4">★★☆☆☆</div>';
                                    break;
                                case 3:
                                    echo '<div class="etoile d-inline pe-4">★★★☆☆</div>';
                                    break;
                                case 4:
                                    echo '<div class="etoile d-inline pe-4">★★★★☆</div>';
                                    break;
                                case 5:
                                    echo '<div class="etoile d-inline pe-4">★★★★★</div>';
                                    break;
                            }
                            echo '    <div class="d-inline">'.$li->getTitre().'</div>';
                            echo '    <div class="card mt-2 p-2 description">'.$li->getContenu().'</div>';
                            echo '</div><hr>';
                        }
                    } else {
                        for ($i=0; $i < 5; $i++) { 
                            $dataClient = $managerClient->get($listeAvis[$i]->getIdClient());
                            echo '<div class="p-2">';
                            echo '    <div>de '.$dataClient->getPseudo().', commenté le '.date("d-m-Y", strtotime($listeAvis[$i]->getDateAvis())).'</div>';
                            switch ($listeAvis[$i]->getNote()) {
                                case 1:
                                    echo '<div class="etoile d-inline pe-4">★☆☆☆☆</div>';
                                    break;
                                case 2:
                                    echo '<div class="etoile d-inline pe-4">★★☆☆☆</div>';
                                    break;
                                case 3:
                                    echo '<div class="etoile d-inline pe-4">★★★☆☆</div>';
                                    break;
                                case 4:
                                    echo '<div class="etoile d-inline pe-4">★★★★☆</div>';
                                    break;
                                case 5:
                                    echo '<div class="etoile d-inline pe-4">★★★★★</div>';
                                    break;
                            }
                            echo '    <div class="d-inline">'.$listeAvis[$i]->getTitre().'</div>';
                            echo '    <div class="card mt-2 p-2 description">'.$listeAvis[$i]->getContenu().'</div>';
                            echo '</div><hr>';
                        }
                        echo '<a class="btn m-2" href="produit.php?id='.$_GET['id'].'&avis=tous">Afficher tous les commentaires ></a>';
                    }

                ?>
                    
                </div>
            </div>
            <?php
            }
            ?>
        </div>

		<?php require_once "includes/footer.php"; ?>
	</body>
</html>