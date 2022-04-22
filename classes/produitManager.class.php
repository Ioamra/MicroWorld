<?php
class ProduitManager{

    private $_db;

    public function __construct($db) {
        $this->setDB($db);
    }

    public function add(Produit $produit) {
        $req = $this->_db->prepare('INSERT INTO produit (nom, prix, idCategorie, descriptionProduit, caracteristique, dispo) 
        VALUES (:nom, :prix, :idCategorie, :descriptionProduit, :caracteristique, :dispo)');
        $req->bindValue(':nom', $produit->getNom());
        $req->bindValue(':prix', $produit->getPrix());
        $req->bindValue(':idCategorie', $produit->getIdCategorie());
        $req->bindValue(':descriptionProduit', $produit->getDescriptionProduit());
        $req->bindValue(':caracteristique', $produit->getCaracteristique());
        $req->bindValue(':dispo', $produit->getDispo());
        $req->execute();
    }

    public function delete(Produit $produit) {
        $this->_db->query('DELETE FROM produit WHERE idProduit = '.$produit->getIdProduit());
    }

    public function get($idProduit) {
		$req = $this->_db->query('SELECT nom, prix, idCategorie, descriptionProduit, caracteristique, dispo FROM produit Where idProduit = '.$idProduit);
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
		return new Produit($donnees);
    }

    public function getByCategorie($idCategorie) {
		$req = $this->_db->query('SELECT idProduit, nom, prix, idCategorie, descriptionProduit, caracteristique, dispo FROM produit Where idCategorie = '.$idCategorie);
		$donnees = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($donnees as $i => $val) {
            $donnees[$i]['nom'] = stripslashes($donnees[$i]['nom']);
            $donnees[$i]['descriptionProduit'] = stripslashes($donnees[$i]['descriptionProduit']);
        }
        return $donnees;
    }

    public function getByNom($nom) {
		$req = $this->_db->prepare("SELECT idProduit, nom, prix, idCategorie, descriptionProduit, caracteristique, dispo FROM produit Where nom = :nom");
        $req->bindValue(':nom', $nom);
        $req->execute();
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
		return new Produit($donnees);
    }

    public function setDB(PDO $db) {
        $this->_db = $db;
    }
}
?>