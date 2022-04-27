<?php
class LigneDeCommandeManager{

    private $_db;

    public function __construct($db) {
        $this->setDB($db);
    }

    public function add(LigneDeCommande $ligneDeCommande) {
        $req = $this->_db->prepare('INSERT INTO ligne_de_commande (idCmde, idProduit, qte) 
        VALUES ((SELECT idCmde FROM commande WHERE idCmde = :idCmde), (SELECT idProduit FROM produit WHERE idProduit = :idProduit), :qte)');
        $req->bindValue(':idCmde', $ligneDeCommande->getIdCmde());
        $req->bindValue(':idProduit', $ligneDeCommande->getIdProduit());
        $req->bindValue(':qte', $ligneDeCommande->getQte());
        $req->execute();
    }

    public function verifProduitAchete(LigneDeCommande $ligneDeCommande) {
        $req = $this->_db->prepare("SELECT idCmde, idProduit FROM ligne_de_commande WHERE idCmde = :idCmde AND idProduit = :idProduit");
        $req->bindValue(':idCmde', $ligneDeCommande->getIdCmde());
        $req->bindValue(':idProduit', $ligneDeCommande->getIdProduit());
        $req->execute();
        return $req->rowCount();
    }

    public function get($idCmde) {
		$req = $this->_db->query('SELECT idProduit, qte FROM ligne_de_commande Where idCmde = '.$idCmde);
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
		return new LigneDeCommande($donnees);
    }

    public function setDB(PDO $db) {
        $this->_db = $db;
    }
}
?>