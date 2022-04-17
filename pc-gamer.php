<?php session_start(); ?>
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
		<div class="datatable-produit">
			<table id="datatable" class="">
				<thead>
					<tr>
						<th>Nom</th>
						<th>Description</th>
						<th>Prix</th>
						<!-- <th>img1</th>
						<th>img2</th>
						<th>img3</th>
						<th>img4</th>
						<th>img5</th> -->
					</tr>
				</thead>
			</table>

		</div>

		<?php require_once "includes/footer.php"; ?>
	</body>
</html>