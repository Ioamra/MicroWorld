<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>MicroWorld</title>
	<?php require_once "includes/head.php"; ?>
</head>
	<body class="body-bg-grey">
		<?php
		require_once "includes/autoload.php";
		require_once "includes/nav.php";

		$managerCategorie = new CategorieManager($bdd);
		$managerProduit = new ProduitManager($bdd);
		$managerImageProduit = new ImageProduitManager($bdd);
		$listCateg = $managerCategorie->getList();
		?>
<div class="box-produit">
	<h2 class="text-center mb-5">Nos nouveaux produits</h2>	
	<div class="row row-cols-2 justify-content-center">



		<?php
		

		foreach ($listCateg as $key => $val) {
			$infoProduit = $managerProduit->getTroisDernierByCategorie($val->getIdCategorie());
			echo '<div class="col card p-2">';
			echo '	<a class="text-decoration-none text-dark" href="'.str_replace(" ", "-", $val->getNomCategorie()).'.php"><h3 class="text-center">'.$val->getNomCategorie().'</h3></a>';
			echo '	<div class="row row-cols-3">';
			foreach ($infoProduit as $li) {
				$img = $managerImageProduit->getOne($li['idProduit']);
				echo ' <div class="col text-center">';
				echo ' 	<a class="text-decoration-none text-dark" href="produit.php?id='.$li['idProduit'].'">';
				echo ' 		<img src="'.$img.'" style="height:8em; width:auto;">';
				echo ' 		<p>'.$li['nom'].'</p>';
				echo ' 		<b>'.$li['prix'].' €</b>';
				echo ' 	</a>';
				echo ' </div>';

			}
			echo '	</div>';
			echo '</div>';
		}
		?>
	</div>
</div>

		<?php require_once "includes/footer.php"; ?>
	</body>
</html>