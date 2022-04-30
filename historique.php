<?php
session_start();
if(empty($_SESSION['id'])){
    header('location:index.php');
    exit();
}
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

        $managerCommande = new CommandeManager($bdd);
        $managerLigneDeCommande = new LigneDeCommandeManager($bdd);
        $managerHistoriqueProduit = new HistoriqueProduitManager($bdd);
        $managerImageProduit = new ImageProduitManager($bdd);
        $listCmde = $managerCommande->getByIdClient($_SESSION['id']);
        $prixTotal = 0;
        ?>
<div class="box-perso">
    <div class="row">
            <b class="col">N° commande</b>
            <b class="col">Date</b>
    </div>
<?php   
        foreach ($listCmde as $li) {
            echo '<a class="btn btn-outline-secondary mb-1 w-100 text-start" data-bs-toggle="collapse" href="#collapse'.$li->getIdCmde().'"><div class="row"><div class="d-inline col">'.$li->getIdCmde().'</div><div class="d-inline col">'.$li->getDateCmde().'</div></div></a>';
            echo '<div id="collapse'.$li->getIdCmde().'" class="collapse">';
            echo '<table class="table">';
            echo '<tr>';
            echo '    <thead>';
            echo '        <th></th>';
            echo '        <th>Nom</th>';
            echo '        <th>Prix</th>';
            echo '        <th>Quantité</th>';
            echo '        <th>Prix Total</th>';
            echo '    </thead>';
            echo '</tr>';
            $listeLigneCmde = $managerLigneDeCommande->get($li->getIdCmde());
            foreach ($listeLigneCmde as $liLigne) {
                $infoProduit = $managerHistoriqueProduit->getAncienProduit($liLigne->getIdProduit(), $li->getDateCmde());
                $img = $managerImageProduit->getOne($liLigne->getIdProduit());
                echo '<tr role=button onclick="window.location.href='."'".'produit.php?id='.$liLigne->getIdProduit()."'".'">';
                echo '  <td class="p-2"><img style="height:4em; width:auto;" src="'.$img.'" /></td>';
                echo '  <td class="p-2">'.substr($infoProduit->getNom(), 0, 30).' ...</td>';
                echo '  <td class="p-2">'.$infoProduit->getPrix().' €</td>';
                echo '  <td class="p-2">x '.$liLigne->getQte().'</td>';
                echo '  <td class="p-2">'.$liLigne->getQte()*$infoProduit->getPrix().' €</td>';
                echo '</tr>';
                $prixTotal += $liLigne->getQte()*$infoProduit->getPrix();
            }
            echo '<tr><td></td><td></td><td></td><td></td><td>'.$prixTotal.' €</td></tr>';
            echo '</table>';
            echo '</div><br>';
            $prixTotal = 0;
        }
?>      

</div>


		<?php require_once "includes/footer.php"; ?>
	</body>
</html>