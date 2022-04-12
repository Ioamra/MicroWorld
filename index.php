<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>MicroWorld</title>
	<?php include "includes/head.php"; ?>
</head>
	<body>
		<?php 
		include "includes/bdd.php";
		// include "includes/nav.php";
		include "classes/categorie.class.php";
		include "classes/categorieManager.class.php";
		?>
		<br><br><br>
		<?php

			$categ1 = new Categorie([
				"IdCategorie" => 1,
				"NomCategorie" => "lalala"
			]);

			$manager = new CategorieManager($bdd);
			$manager->update($categ1);

			var_dump($manager->get(1)->getNomCategorie());
			// $list = $manager->getList();
			// foreach($list as $li){
			// 	var_dump($li);
			// }

		?>
		

		<?php include "includes/footer.php"; ?>
	</body>
</html>