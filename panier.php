<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>MicroWorld</title>
	<?php require_once "includes/head.php"; ?>
    <script src="assets/js/panier.js"></script>
</head>
	<body class="body-bg-grey">
		<?php
		require_once "includes/autoload.php";
		require_once "includes/nav.php";
		?>
        <div class="box-perso text-center" id="box-panier">
            
        </div>

		<?php require_once "includes/footer.php"; ?>
	</body>
</html>