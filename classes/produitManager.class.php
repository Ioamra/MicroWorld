<?php
class ProduitManager{

    private $_db;

    public function __construct($db) {
        $this->setDB($db);
    }

    public function add(Produit $produit) {
        $req = $this->_db->prepare('INSERT INTO produit (nom, prix, idCategorie, description, dispo) 
                                    VALUES (:nom, :prix, :idCategorie, :description, :dispo)');
        $req->bindValue(':nom', $produit->getNom());
        $req->bindValue(':prix', $produit->getPrix());
        $req->bindValue(':idCategorie', $produit->getCategorie());
        $req->bindValue(':description', $produit->getDescription());
        $req->bindValue(':dispo', $produit->getDispo());
        $req->execute();
    }

    public function delete(Produit $produit) {
        $this->_db->query('DELETE FROM produit WHERE idProduit = '.$produit->getIdProduit());
    }

    public function get($idProduit) {
		$req = $this->_db->query('SELECT nom, prix, idCategorie	description	dispo FROM produit Where idProduit = '.$idProduit);
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
		return new Produit($donnees);
    }

    public function getByCategorie($idCategorie) {
		$req = $this->_db->query('SELECT idProduit, nom, prix, description, dispo FROM produit Where idCategorie = '.$idCategorie);
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
		return new Produit($donnees);
    }

    public function setDB(PDO $db) {
        $this->_db = $db;
    }
}
?>