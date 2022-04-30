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
    <script src="assets/js/modif-produit.js"></script>
</head>
	<body class="body-bg-grey">
		<?php
		require_once "includes/autoload.php";
		require_once "includes/nav.php";

		$managerProduit = new ProduitManager($bdd);
		$managerImageProduit = new ImageProduitManager($bdd);
		$managerCategorie = new CategorieManager($bdd);

		if (!empty($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			$page = 1;
		}
		$nbProduit = $managerProduit->count();
		$limit = 10;
		$offset = ($page - 1) * $limit;
		$nbPage = ceil($nbProduit / $limit);
		$listProduit = $managerProduit->getLimitOffset($limit, $offset);
		?>
		<div class="box-produit">
			<?php
					foreach ($listProduit as $produit) {
						$listImg = $managerImageProduit->get($produit->getIdProduit());
						$categorie = $managerCategorie->get($produit->getIdCategorie());
						
						if (isset($_POST['submit'.$produit->getIdProduit()])) {
							$nom = addslashes(htmlspecialchars($_POST['nom'.$produit->getIdProduit()]));
							$description = addslashes(htmlspecialchars($_POST['description'.$produit->getIdProduit()]));
							$prix = htmlspecialchars($_POST['prix'.$produit->getIdProduit()]);
							$caracteristique = $_POST['caracteristique'.$produit->getIdProduit()];

							$managerProduit->update(
								new Produit([
									"IdProduit" => $produit->getIdProduit(),
									"Nom" => $nom,
									"Prix" => (int)$prix,
									"DescriptionProduit" => $description,
									"Caracteristique" => $caracteristique,
								])
							);
							
							for ($i=0; $i < 5; $i++) { 
								if (isset($_FILES['img'.($i+1).$produit->getIdProduit()])) {
									$ext_img = ".".strtolower(substr(strrchr($_FILES['img'.($i+1).$produit->getIdProduit()]['name'], "."), 1));
									$valid = true;
									if ($ext_img != ".jpeg" && $ext_img != ".jpg" && $ext_img != ".png") {
										$valid = False;
										$mesError = "Le format de l'image ".($i+1)." ne correspond pas";
									}
									if ($valid == true) {
										$verif = $managerImageProduit->verif(
											new ImageProduit([
												"IdProduit" => $produit->getIdProduit(),
												"CheminImage" => 'image-produit/'.$produit->getIdProduit().'/img'.($i+1).$ext_img
											])
										);
										
										if ($verif = true) {
											// au cas ou l'extention change
											$managerImageProduit->update(
												new ImageProduit([
													"IdProduit" => $produit->getIdProduit(),
													"CheminImage" => 'image-produit/'.$produit->getIdProduit().'/img'.($i+1).$ext_img
												])
											);
										}
										if ($verif = false) {
											$managerImageProduit->add(
												new ImageProduit([
													"IdProduit" => $produit->getIdProduit(),
													"CheminImage" => 'image-produit/'.$produit->getIdProduit().'/img'.($i+1).$ext_img
												])
											);
										}
										move_uploaded_file($_FILES['img'.($i+1).$produit->getIdProduit()]['tmp_name'], 'image-produit/'.$produit->getIdProduit().'/img'.($i+1).$ext_img);
									}
								}
							}
						}
						
			echo '<div class="row border my-1">';
			echo '	<div class="col">';
			echo '		<a class="text-decoration-none text-dark mb-1 w-100 text-start" data-bs-toggle="collapse" href="#collapse'.$produit->getIdProduit().'">';
			echo '			<img style="height:auto; width:3em;" src="'.$listImg[0]['cheminImage'].'" />';
			echo '		</a>';
			echo '	</div>';
			echo '	<div class="col">';
			echo '		<a class="text-decoration-none text-dark mb-1 w-100 text-start" data-bs-toggle="collapse" href="#collapse'.$produit->getIdProduit().'">';
			echo substr($produit->getNom(), 0, 30).' ...';
			echo '		</a>';
			echo '	</div>';
			echo '	<div class="col">';
			echo '		<a class="text-decoration-none text-dark mb-1 w-100 text-start" data-bs-toggle="collapse" href="#collapse'.$produit->getIdProduit().'">';
			echo $categorie->getNomCategorie();
			echo '		</a>';
			echo '	</div>';
			echo '	<div class="col">';
			echo '		<a class="text-decoration-none text-dark mb-1 w-100 text-start" data-bs-toggle="collapse" href="#collapse'.$produit->getIdProduit().'">';
			echo $produit->getPrix().' €';
			echo '		</a>';
			echo '	</div>';
			echo '	<div class="col">';
			if ($produit->getDispo() == 1) {
				echo '<button onclick="switchDispo('.$produit->getIdProduit().');" class="btn btn-success"> Disponible </button>';
			} else {
				echo '<button onclick="switchDispo('.$produit->getIdProduit().');" class="btn btn-danger">Indisponible</button>';
			}
			echo '	</div>';
			echo '</div>';
			echo '<div id="collapse'.$produit->getIdProduit().'" class="collapse">';
			echo '';
			?>
			<form class="text-center" method="post" enctype="multipart/form-data">
                <h1 class="pb-4">Ajouter un Produit</h1>

                <div class="mb-3">
                    <label for="nom<?=$produit->getIdProduit();?>" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom<?=$produit->getIdProduit();?>" name="nom<?=$produit->getIdProduit();?>" value="<?=$produit->getNom();?>" required>
                </div>
				<div class="mb-3">
					<label for="description<?=$produit->getIdProduit();?>" class="form-label">Description</label>
					<textarea class="w-100 form-control" name="description<?=$produit->getIdProduit();?>" id="description<?=$produit->getIdProduit();?>" rows="10" ><?=$produit->getDescriptionProduit();?></textarea>
				</div>
				<div class="mb-3">
					<label for="caracteristique<?=$produit->getIdProduit();?>" class="form-label">Caracteristique</label>
					<textarea class="w-100 form-control" name="caracteristique<?=$produit->getIdProduit();?>" id="caracteristique<?=$produit->getIdProduit();?>" rows="30"><?=$produit->getCaracteristique();?></textarea>
				</div>
                <div class="mb-3">
                    <label for="prix<?=$produit->getIdProduit();?>" class="form-label">Prix</label>
                    <input type="tel" class="form-control" id="prix<?=$produit->getIdProduit();?>" name="prix<?=$produit->getIdProduit();?>" value="<?=$produit->getPrix();?>" required>
                </div>
				<div class="image-produit-upload mb-3">
					<label class="form-label">Images (une image minimum)</label><br>
					<label for="img1<?=$produit->getIdProduit();?>">
						<img src="assets/img/icon-download-img.png" role="button"/>
					</label>
					<label for="img2<?=$produit->getIdProduit();?>">
						<img src="assets/img/icon-download-img.png" role="button"/>
					</label>
					<label for="img3<?=$produit->getIdProduit();?>">
						<img src="assets/img/icon-download-img.png" role="button"/>
					</label>
					<label for="img4<?=$produit->getIdProduit();?>">
						<img src="assets/img/icon-download-img.png" role="button"/>
					</label>
					<label for="img5<?=$produit->getIdProduit();?>">
						<img src="assets/img/icon-download-img.png" role="button"/>
					</label>
					<?php
							for ($i=0; $i < 5; $i++) { 
								echo '<input class="form-control" type="file" name="img'.($i+1).$produit->getIdProduit().'" id="img'.($i+1).$produit->getIdProduit().'" onchange="loadFile('."'".($i+1).$produit->getIdProduit()."'".', event)">';
							}
						?>
					<div>
						<?php
							for ($i=0; $i < count($listImg); $i++) { 
								echo '<img style="height:auto; width: 18%;" id="imgPrecharger'.($i+1).$produit->getIdProduit().'" src="'.$listImg[$i]['cheminImage'].'" />';
							}
							for ($i=count($listImg); $i < 5; $i++) { 
								echo '<img style="height:auto; width: 18%;" id="imgPrecharger'.($i+1).$produit->getIdProduit().'" />';
							}
						?>
					</div>
		
                </div>
                <button type="submit" name="submit<?=$produit->getIdProduit();?>" class="btn btn-primary">Modifier le produit</button>
            </form>

			<?php
			echo '</div>';
					}
					?>

			<ul class="pagination">
                <?php 
                if ($nbPage < 5) {
                    for ($i=1; $i<=$nbPage; $i++) {
                        echo "<li class='page-item'><a class='page-link' href='modif-produit.php?page=$i'>$i</a></li>";
                    }
                } else {
                    echo "<li class='page-item'><a class='page-link' href='modif-produit.php?page=1'>1</a></li>";
                    if ($page <= 2) {
                        echo "<li class='page-item'><a class='page-link' href='modif-produit.php?page=2'>2</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='modif-produit.php?page=3'>3</a></li>";
                        echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                    } elseif ($page == 3) {
                        echo "<li class='page-item'><a class='page-link' href='modif-produit.php?page=2'>2</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='modif-produit.php?page=3'>3</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='modif-produit.php?page=4'>4</a></li>";
                        echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                    } elseif ($page == ($nbPage-2)) {
                        echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='modif-produit.php?page=".($nbPage-3)."'>".($nbPage-3)."</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='modif-produit.php?page=".($nbPage-2)."'>".($nbPage-2)."</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='modif-produit.php?page=".($nbPage-1)."'>".($nbPage-1)."</a></li>";
                    } elseif ($page > ($nbPage-2)) {
                        echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='modif-produit.php?page=".($nbPage-2)."'>".($nbPage-2)."</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='modif-produit.php?page=".($nbPage-1)."'>".($nbPage-1)."</a></li>";
                    } else {
                        echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='modif-produit.php?page=".($page-1)."'>".($page-1)."</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='modif-produit.php?page=$page'>$page</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='modif-produit.php?page=".($page+1)."'>".($page+1)."</a></li>";
                        echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                    }
                    echo "<li class='page-item'><a class='page-link' href='modif-produit.php?page=$nbPage'>$nbPage</a></li>";
                }
                ?>
            </ul>
		</div>

		<?php require_once "includes/footer.php"; ?>
	</body>
</html>