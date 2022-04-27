<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>MicroWorld</title>
	<?php require_once "includes/head.php"; ?>
    <script src="assets/js/ecran.js"></script>
</head>
	<body class="body-bg-grey">
		<?php
		require_once "includes/autoload.php";
		require_once "includes/nav.php";
		?>
		<div class="box-produit">
			<h1 class="text-center pb-4">Ecran</h1>
			<table id="datatable" class="table table-striped">
				<thead>
					<tr>
						<th class="no-sort"></th>
						<th>Nom</th>
						<th class="no-sort">Description</th>
						<th>Prix</th>
						<th>Note</th>
					</tr>
				</thead>
			</table>
		</div>

		<?php require_once "includes/footer.php"; ?>
	</body>
</html>