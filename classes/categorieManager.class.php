<?php
class CategorieManager{

    private $_db;

    public function __construct($db) {
        $this->setDB($db);
    }

    public function add(Categorie $categorie) {
        $req = $this->_db->prepare('INSERT INTO categorie (nomCategorie) VALUES (:nomCategorie)');
        $req->bindValue(':nomCategorie', $categorie->getNomCategorie());
        $req->execute();
    }

    public function delete(Categorie $categorie) {
        $this->_db->query('DELETE FROM categorie WHERE idCategorie = '.$categorie->getIdCategorie());
    }

    public function update(Categorie $categorie) {
        $req = $this->_db->prepare('UPDATE categorie SET nomCategorie = :nomCategorie WHERE idCategorie = :idCategorie');
        $req->bindValue(':nomCategorie', $categorie->getNomCategorie());
        $req->bindValue(':idCategorie', $categorie->getIdCategorie());
        $req->execute();
    }

    public function get($idCategorie) {
		$req = $this->_db->query('SELECT idCategorie, nomCategorie FROM categorie Where idCategorie = '.$idCategorie);
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
		return new Categorie($donnees);
    }

    // Retourne toutes les categories
    public function getList() {
		$categories = [];
		$req = $this->_db->query('SELECT idCategorie, nomCategorie FROM categorie ORDER BY idCategorie');
		while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
			$categories[] = new Categorie($donnees);
		}
		return $categories;
    }

    public function setDB(PDO $db) {
        $this->_db = $db;
    }
}
?>