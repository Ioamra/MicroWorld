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
    <script src="assets/js/ajout-produit.js"></script>
</head>
	<body class="body-bg-grey">
		<?php
		require_once "includes/autoload.php";
		require_once "includes/nav.php";

		if (isset($_POST['submit'])) {
			$valid = true;
			$nom = addslashes(htmlspecialchars($_POST['nom']));
			$description = addslashes(htmlspecialchars($_POST['description']));
			$categorie = htmlspecialchars($_POST['categorie']);
			$prix = htmlspecialchars($_POST['prix']);
			$caracteristique = $_POST['caracteristique'];

			if (!empty($_FILES['img1']['name'])) {
				$img1 = $_FILES['img1'];
				$ext_img1 = ".".strtolower(substr(strrchr($_FILES['img1']['name'], "."), 1));
				if ($ext_img1 != ".jpeg" && $ext_img1 != ".JPEG" && $ext_img1 != ".jpg" && $ext_img1 != ".JPG" && $ext_img1 != ".png" && $ext_img1 != ".PNG") {
					$valid = False;
					$mesError = "Le format de l'image 1 ne correspond pas";
				}
			} else {
				$valid = false;
				$mesError = "Vous devez mettre au moins la premiere image.";
			}
			if (!empty($_FILES['img2']['name'])) {
				$img2 = $_FILES['img2'];
				$ext_img2 = ".".strtolower(substr(strrchr($_FILES['img2']['name'], "."), 1));
				if ($ext_img2 != ".jpeg" && $ext_img2 != ".JPEG" && $ext_img2 != ".jpg" && $ext_img2 != ".JPG" && $ext_img2 != ".png" && $ext_img2 != ".PNG") {
					$valid = False;
					$mesError = "Le format de l'image 2 ne correspond pas";
				}
			}
			if (!empty($_FILES['img3']['name'])) {
				$img3 = $_FILES['img3'];
				$ext_img3 = ".".strtolower(substr(strrchr($_FILES['img3']['name'], "."), 1));
				if ($ext_img3 != ".jpeg" && $ext_img3 != ".JPEG" && $ext_img3 != ".jpg" && $ext_img3 != ".JPG" && $ext_img3 != ".png" && $ext_img3 != ".PNG") {
					$valid = False;
					$mesError = "Le format de l'image 3 ne correspond pas";
				}
			}
			if (!empty($_FILES['img4']['name'])) {
				$img4 = $_FILES['img4'];
				$ext_img4 = ".".strtolower(substr(strrchr($_FILES['img4']['name'], "."), 1));
				if ($ext_img4 != ".jpeg" && $ext_img4 != ".JPEG" && $ext_img4 != ".jpg" && $ext_img4 != ".JPG" && $ext_img4 != ".png" && $ext_img4 != ".PNG") {
					$valid = False;
					$mesError = "Le format de l'image 4 ne correspond pas";
				}
			}
			if (!empty($_FILES['img5']['name'])) {
				$img5 = $_FILES['img5'];
				$ext_img5 = ".".strtolower(substr(strrchr($_FILES['img5']['name'], "."), 1));
				if ($ext_img5 != ".jpeg" && $ext_img5 != ".JPEG" && $ext_img5 != ".jpg" && $ext_img5 != ".JPG" && $ext_img5 != ".png" && $ext_img5 != ".PNG") {
					$valid = False;
					$mesError = "Le format de l'image 5 ne correspond pas";
				}
			}
			if ($valid == true) {
				$managerProduit = new ProduitManager($bdd);
				$managerProduit->add(
					new Produit([
						"Nom" => $nom,
						"Prix" => (int)$prix,
						"IdCategorie" => (int)$categorie,
						"DescriptionProduit" => $description,
						"Caracteristique" => $caracteristique,
						"Dispo" => 1
					])
				);
				$id = $managerProduit->getByNom($nom)->idProduit;
				mkdir('image-produit/'.$id);
				$chemin_img1 = 'image-produit/'.$id.'/img1'.$ext_img1;
				$tmp_img1 = $_FILES['img1']['tmp_name'];
				$managerImageProduit = new ImageProduitManager($bdd);
				$managerImageProduit->add(
					new ImageProduit([
						"IdProduit" => $id,
						"CheminImage" => $chemin_img1
					])
				);
				move_uploaded_file($tmp_img1, $chemin_img1);

				if (isset($ext_img2)) {
					$chemin_img2 = 'image-produit/'.$id.'/img2'.$ext_img2;
					$tmp_img2 = $_FILES['img2']['tmp_name'];
					$managerImageProduit->add(
						new ImageProduit([
							"IdProduit" => $id,
							"CheminImage" => $chemin_img2
						])
					);
					move_uploaded_file($tmp_img2, $chemin_img2);
				}
				if (isset($ext_img3)) {
					$chemin_img3 = 'image-produit/'.$id.'/img3'.$ext_img3;
					$tmp_img3 = $_FILES['img3']['tmp_name'];
					$managerImageProduit->add(
						new ImageProduit([
							"IdProduit" => $id,
							"CheminImage" => "$chemin_img3"
						])
					);
					move_uploaded_file($tmp_img3, $chemin_img3);
				}
				if (isset($ext_img4)) {
					$chemin_img4 = 'image-produit/'.$id.'/img4'.$ext_img4;
					$tmp_img4 = $_FILES['img4']['tmp_name'];
					$managerImageProduit->add(
						new ImageProduit([
							"IdProduit" => $id,
							"CheminImage" => "$chemin_img4"
						])
					);
					move_uploaded_file($tmp_img4, $chemin_img4);
				}
				if (isset($ext_img5)) {
					$chemin_img5 = 'image-produit/'.$id.'/img5'.$ext_img5;
					$tmp_img5 = $_FILES['img5']['tmp_name'];
					$managerImageProduit->add(
						new ImageProduit([
							"IdProduit" => $id,
							"CheminImage" => "$chemin_img5"
						])
					);
					move_uploaded_file($tmp_img5, $chemin_img5);
				}
			}
		}
		?>
		<div class="box-perso text-center">
            <form method="post" enctype="multipart/form-data">
                <h1 class="pb-4">Ajouter un Produit</h1>

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
				<div class="mb-3">
					<label for="description" class="form-label">Description</label>
					<textarea class="w-100 form-control" name="description" id="description" rows="10"></textarea>
				</div>
				<div class="mb-3">
					<label for="caracteristique" class="form-label">Caracteristique</label>
					<textarea class="w-100 form-control" name="caracteristique" id="caracteristique" rows="30"></textarea>
				</div>
				<div class="mb-3">
					<label for="categorie" class="form-label">Categorie</label>
					<select class="form-select" name="categorie" id="categorie">
						<?php
							$managerCategorie = new CategorieManager($bdd);
							$listeCategorie = $managerCategorie->getList();
							foreach ($listeCategorie as $li) {
								echo '<option value="'.$li->idCategorie.'">'.$li->nomCategorie.'</option>';
							}
						?>
					</select>
				</div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix</label>
                    <input type="tel" class="form-control" id="prix" name="prix" required>
                </div>
				<!-- Liste d'images -->
				<div class="image-produit-upload mb-3">
					<label class="form-label">Images (une image minimum)</label><br>
					<label for="img1">
						<img src="assets/img/icon-download-img.png" role="button"/>
					</label>
					<label for="img2">
						<img src="assets/img/icon-download-img.png" role="button"/>
					</label>
					<label for="img3">
						<img src="assets/img/icon-download-img.png" role="button"/>
					</label>
					<label for="img4">
						<img src="assets/img/icon-download-img.png" role="button"/>
					</label>
					<label for="img5">
						<img src="assets/img/icon-download-img.png" role="button"/>
					</label>
                    <input class="form-control" type="file" name="img1" id='img1' onchange="loadFile(1, event)" required>
                    <input class="form-control" type="file" name="img2" id='img2' onchange="loadFile(2, event)">
                    <input class="form-control" type="file" name="img3" id='img3' onchange="loadFile(3, event)">
                    <input class="form-control" type="file" name="img4" id='img4' onchange="loadFile(4, event)">
                    <input class="form-control" type="file" name="img5" id='img5' onchange="loadFile(5, event)">
					<div>
						<img style="height:auto; width: 18%;" id="imgPrecharger1" />
						<img style="height:auto; width: 18%;" id="imgPrecharger2" />
						<img style="height:auto; width: 18%;" id="imgPrecharger3" />
						<img style="height:auto; width: 18%;" id="imgPrecharger4" />
						<img style="height:auto; width: 18%;" id="imgPrecharger5" />
					</div>

                </div>
                <button type="submit" name="submit" class="btn btn-primary">Ajouter le produit</button>
            </form>
        </div>

		<?php require_once "includes/footer.php"; ?>
	</body>
</html>