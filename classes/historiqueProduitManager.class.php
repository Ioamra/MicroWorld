<?php
class HistoriqueProduitManager{

    private $_db;

    public function __construct($db) {
        $this->setDB($db);
    }

    public function getAncienProduit($idProduit, $dateCmde) {
		$req = $this->_db->query("SELECT * FROM historique_produit Where idProduit = $idProduit AND dateChangement = 
        (SELECT MAX(dateChangement) FROM historique_produit WHERE idProduit = $idProduit AND dateChangement <= '$dateCmde')");
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
        $donnees['nom'] = stripslashes($donnees['nom']);
        $donnees['descriptionProduit'] = stripslashes($donnees['descriptionProduit']);
		return new HistoriqueProduit($donnees);
    }

    public function setDB(PDO $db) {
        $this->_db = $db;
    }
}
?>