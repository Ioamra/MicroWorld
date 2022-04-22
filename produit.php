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
                    echo '<h3>'.stripslashes($infoProduit->getNom()).'</h3>';
                    echo '<p class="description p-3">'.stripslashes($infoProduit->getDescriptionProduit()).'</p>'
                    ?>
                </div>
                <div class="col col-lg-2">
                    <div class="card m-2 p-3">
                    <?php
                        echo '<h3 class="text-center">'.$infoProduit->getPrix().'€</h3>';
                    ?>
                    <p class="text-center">Livraison gratuite</p>
                    <?php
                    echo '<button class="btn btn-primary" onclick="let panier = new Panier(); panier.add({id:'.$id.',nom:'."'".substr(stripslashes($infoProduit->getNom()),0,20)."...'".
                        ',prix:'.$infoProduit->getPrix().',cheminImage:'."'".$infoImage[0]['cheminImage']."'".'});">Ajouter au panier</button>';
                    ?>
                    </div>
                </div>
            </div>
            <?php
            echo $infoProduit->getCaracteristique();
            ?>
        </div>

		<?php require_once "includes/footer.php"; ?>
	</body>
</html>