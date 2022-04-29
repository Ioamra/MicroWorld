<?php
session_start();
require_once "includes/autoload.php";

if (isset($_GET['action'])) {

    $action = $_GET['action'];

    if ($action == 'validAchat') {
        if (isset($_GET['idProduit'], $_GET['qteProduit'])) {
            $listId = $_GET['idProduit'];
            $listQte = $_GET['qteProduit'];
            $managerCommande = new CommandeManager($bdd);
            $managerLigneDeCommande = new LigneDeCommandeManager($bdd);
            date_default_timezone_set("Europe/Paris");
            $managerCommande->add(
                new Commande([
				    "IdClient" => $_SESSION['id'],
				    "DateCmde" => date("Y-m-d")
			    ])
            );
            $idCmde = $managerCommande->getMaxId();
            for ($i = 0; $i < count($listId); $i++) {
                $managerLigneDeCommande->add(
                    new LigneDeCommande([     
                        "IdCmde" => $idCmde,
                        "IdProduit" => $listId[$i],
                        "Qte" => $listQte[$i]
                    ])
                );
            }
        }
    }

    
    if ($action == 'getProduitByCategorie' && isset($_GET['idCategorie'])) {
        
        $idCategorie = $_GET['idCategorie'];
        $managerProduit = new ProduitManager($bdd);
        $managerImageProduit = new ImageProduitManager($bdd);
        $managerAvisClient = new AvisClientManager($bdd);
        
        $list = $managerProduit->getByCategorie($idCategorie);
        
        foreach ($list as $i => $val) {
            $list[$i]['img'] = $managerImageProduit->getOne($val['idProduit']);
            $list[$i]['note'] = round($managerAvisClient->getMoyenne($val['idProduit']), 2);
        }
        echo json_encode($list);
    }

    if ($action == 'switchDispo' && isset($_GET['idProduit'])) {
        $managerProduit = new ProduitManager($bdd);
        $managerProduit->switchDispo($_GET['idProduit']);
    }
}
