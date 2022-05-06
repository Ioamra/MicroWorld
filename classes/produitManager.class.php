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

    public function update(Produit $produit) {
        $req = $this->_db->prepare('UPDATE produit SET nom = :nom, prix = :prix, descriptionProduit = :descriptionProduit, 
                                    caracteristique = :caracteristique WHERE idProduit = :idProduit');
        $req->bindValue(':nom', $produit->getNom());
        $req->bindValue(':prix', $produit->getPrix());
        $req->bindValue(':descriptionProduit', $produit->getDescriptionProduit());
        $req->bindValue(':caracteristique', $produit->getCaracteristique());
        $req->bindValue(':idProduit', $produit->getIdProduit());
        $req->execute();
    }

    // public function delete(Produit $produit) {
    //     $this->_db->query('DELETE FROM produit WHERE idProduit = '.$produit->getIdProduit());
    // }

    public function get($idProduit) {
		$req = $this->_db->query("SELECT nom, prix, idCategorie, descriptionProduit, caracteristique, dispo FROM produit Where idProduit = $idProduit");
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
        $donnees['nom'] = stripslashes($donnees['nom']);
        $donnees['descriptionProduit'] = stripslashes($donnees['descriptionProduit']);
		return new Produit($donnees);
    }

    public function getByCategorie($idCategorie) {
		$req = $this->_db->query("SELECT idProduit, nom, prix, idCategorie, descriptionProduit, caracteristique, dispo FROM produit Where idCategorie = $idCategorie AND dispo = 1 ORDER BY idProduit DESC");
		$donnees = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($donnees as $i => $val) {
            $donnees[$i]['nom'] = stripslashes($donnees[$i]['nom']);
            $donnees[$i]['descriptionProduit'] = stripslashes($donnees[$i]['descriptionProduit']);
        }
        return $donnees;
    }
    
    public function getTroisDernierByCategorie($idCategorie) {
		$req = $this->_db->query("SELECT idProduit, nom, prix, idCategorie, descriptionProduit, caracteristique, dispo FROM produit Where idCategorie = $idCategorie AND dispo = 1 ORDER BY idProduit DESC LIMIT 3");
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

    public function getLimitOffset($limit, $offset) {
		$req = $this->_db->query("SELECT idProduit, nom, prix, idCategorie, descriptionProduit, caracteristique, dispo FROM produit ORDER BY idProduit DESC LIMIT $limit OFFSET $offset");
        $donnees = $req->fetchAll(PDO::FETCH_ASSOC);
        $res = [];
        foreach ($donnees as $li) {
            $li['nom'] = stripslashes($li['nom']);
            $li['descriptionProduit'] = stripslashes($li['descriptionProduit']);
            $res[] = new Produit($li);
        }
		return $res;
    }

    public function count() {
		$req = $this->_db->query("SELECT * FROM produit");
        return $req->rowCount();
    }

    public function switchDispo($idProduit) {
		$req = $this->_db->query("SELECT dispo FROM produit WHERE idProduit = $idProduit");
        $dispo = $req->fetch(PDO::FETCH_ASSOC)['dispo'];
        switch ($dispo) {
            case 0:
                $req = $this->_db->query("UPDATE produit SET dispo = 1 WHERE idProduit = $idProduit");
                break;
            
            case 1:
                $req = $this->_db->query("UPDATE produit SET dispo = 0 WHERE idProduit = $idProduit");
                break;
        }

    }

    public function setDB(PDO $db) {
        $this->_db = $db;
    }
}
?>