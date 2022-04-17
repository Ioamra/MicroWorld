<?php
require_once "includes/autoload.php";
if (isset($_GET['action'])) {

    $action = $_GET['action'];

    if (isset($_GET['idCategorie'])) {

        $idCategorie = $_GET['idCategorie'];

        if ($action = 'getProduitByCategorie') {

            $managerProduit = new ProduitManager($bdd);
            $managerImageProduit = new ImageProduitManager($bdd);
            
            $list = $managerProduit->getByCategorie($idCategorie);
            
            foreach ($list as $i => $val) {
                $listImg = $managerImageProduit->getOne($val['idProduit']);
                foreach ($listImg as $cheminImg) {
                    $list[$i]['img'] = $cheminImg;
                }
            }
            // $list = '{"data":'.json_encode($list).'}';
            echo json_encode($list);
        }
    }
}
