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
        // echo '<br><br><br><br>';
        // var_dump($infoProduit);
        // var_dump($infoImage)
		?>
		<div class="box-produit">
            <div class="row">
                <div class="col-4">
                    <?php
                    echo '<a href="'.$infoImage[0]['cheminImage'].'" target="_blank"><img id="img-principal" src="'.$infoImage[0]['cheminImage'].'" style="height:auto; width:100%;"></a>';
                    ?>
                    <div class="row">
                    <?php
                    foreach ($infoImage as $val) {
                        echo '<div class="col" role="button" onclick="switchImgProduit('."'".$val['cheminImage']."'".')"><img src="'.$val['cheminImage'].'" style="height:auto; width:100%;"></div>';
                    }
                    ?>
                    </div>
                </div>
                <div class="col-6">
                    <?php
                    echo '<h3>'.$infoProduit->getNom().'</h3>';
                    echo '<pre class="p-3">'.$infoProduit->getDescriptionProduit().'</pre>'
                    ?>
                </div>
                <div class="col-2">
                    <div class="card m-2 p-3">
                    <?php
                        echo '<h3 class="text-center">'.$infoProduit->getPrix().'€</h3>';
                    ?>
                    <p class="text-center">Livraison gratuite</p>
                    <button class="btn btn-primary">Ajouter au panier</button>
                    </div>
                </div>
            </div>
        </div>

		<?php require_once "includes/footer.php"; ?>
	</body>
</html>