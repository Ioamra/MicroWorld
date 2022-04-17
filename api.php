<?php
require_once "includes/autoload.php";
if (isset($_GET['action'])) {

    $action = $_GET['action'];

    if (isset($_GET['idCategorie'])) {

        $idCategorie = $_GET['idCategorie'];

        if ($action = 'getProduitByCategorie') {

            //! Ajouter la moyenne des avis et l'ajouter dans les differents datatables (pour le tri)
            $managerProduit = new ProduitManager($bdd);
            $managerImageProduit = new ImageProduitManager($bdd);
            
            $list = $managerProduit->getByCategorie($idCategorie);
            
            foreach ($list as $i => $val) {
                $listImg = $managerImageProduit->getOne($val['idProduit']);
                foreach ($listImg as $cheminImg) {
                    $list[$i]['img'] = $cheminImg;
                }
            }
            echo json_encode($list);
        }
    }
    // if (isset($_GET['idProduit'])) {
    //     $idProduit = $_GET['idProduit'];
    //     if ($action = 'getProduitById') {
    //         $managerProduit = new ProduitManager($bdd);
    //         $managerImageProduit = new ImageProduitManager($bdd);
    //         $list = $managerProduit->get($idProduit);
    //     }
    // }
}
