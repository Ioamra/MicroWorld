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

<!-- <script>

let panier = new Panier(); 
panier.add({id:2,nom:
                        ',prix:'.$infoProduit->getPrix().',cheminImage:'.$infoImage[0]['cheminImage'].'})
</script> -->

		<?php require_once "includes/footer.php"; ?>
	</body>
</html>