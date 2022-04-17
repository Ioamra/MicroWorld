<?php session_start(); 
	if(empty($_SESSION['admin'])){
		header('location:index.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>MicroWorld</title>
	<?php require_once "includes/head.php"; ?>
    <script src="assets/js/pc-gamer.js"></script>
</head>
	<body>
		<?php
		require_once "includes/autoload.php";
		require_once "includes/nav.php";
		?>
		

		<?php require_once "includes/footer.php"; ?>
	</body>
</html>