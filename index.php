<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>MicroWorld</title>
	<?php require_once "includes/head.php"; ?>
</head>
	<body>
		<?php
		require_once "includes/autoload.php";
		require_once "includes/nav.php";
		?>
		<br><br><br>
		<?php

			$categ1 = new Categorie([
				"IdCategorie" => 1,
				"NomCategorie" => "lalala"
			]);

			$manager = new CategorieManager($bdd);
			$manager->update($categ1);

			// var_dump($manager->get(1)->getNomCategorie());
			
			// $list = $manager->getList();
			// foreach($list as $li){
			// 	var_dump($li);
			// }
			var_dump($_SESSION);

		?>
		

		<?php require_once "includes/footer.php"; ?>
	</body>
</html>