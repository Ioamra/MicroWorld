<?php
class ImageProduitManager{

    private $_db;

    public function __construct($db) {
        $this->setDB($db);
    }

    public function add(ImageProduit $imageProduit) {
        $req = $this->_db->prepare('INSERT INTO image_produit (idProduit, cheminImage) VALUES (:idProduit, :cheminImage)');
        $req->bindValue(':idProduit', $imageProduit->getIdProduit());
        $req->bindValue(':cheminImage', $imageProduit->getCheminImage());
        $req->execute();
    }

    public function delete(ImageProduit $imageProduit) {
        $this->_db->query('DELETE FROM image_produit WHERE idProduit = '.$imageProduit->getIdProduit());
    }

    public function get($idProduit) {
		$req = $this->_db->query('SELECT cheminImage FROM image_produit Where idProduit = '.$idProduit);
		$donnees = $req->fetchAll(PDO::FETCH_ASSOC);
		return $donnees;
    }

    public function getOne($idProduit) {
		$req = $this->_db->query("SELECT cheminImage FROM image_produit Where idProduit = $idProduit");
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
		return $donnees['cheminImage'];
    }

    public function update(ImageProduit $imageProduit) {
        $img = substr($imageProduit->getCheminImage(), 0, strpos($imageProduit->getCheminImage(), '.'));
        $req = $this->_db->prepare("UPDATE image_produit SET idProduit = :idProduit, cheminImage = :cheminImage WHERE idProduit = :idProduit AND cheminImage LIKE '$img%'");
        $req->bindValue(':idProduit', $imageProduit->getIdProduit());
        $req->bindValue(':cheminImage', $imageProduit->getCheminImage());
        $req->execute();
    }

    public function verif(ImageProduit $imageProduit) {
        $img = substr($imageProduit->getCheminImage(), 0, strpos($imageProduit->getCheminImage(), '.'));
		$req = $this->_db->prepare("SELECT * FROM image_produit Where idProduit = :idProduit AND cheminImage LIKE '$img%'");
        $req->bindValue(':idProduit', $imageProduit->getIdProduit());
        $req->execute();
        if ($req->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function setDB(PDO $db) {
        $this->_db = $db;
    }
}
?>