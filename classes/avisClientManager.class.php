<?php
class AvisClientManager {

    private $_db;

    public function __construct($db) {
        $this->setDB($db);
    }

    public function add(AvisClient $avisClient) {
        $req = $this->_db->prepare('INSERT INTO avis_client (idProduit, dateAvis, idClient, note, titre, contenu) 
                                    VALUES (:idProduit, :dateAvis, :idClient, :note, :titre, :contenu)');
        $req->bindValue(':idProduit', $avisClient->getIdProduit());
        $req->bindValue(':dateAvis', $avisClient->getDateAvis());
        $req->bindValue(':idClient', $avisClient->getIdClient());
        $req->bindValue(':note', $avisClient->getNote());
        $req->bindValue(':titre', $avisClient->getTitre());
        $req->bindValue(':contenu', $avisClient->getContenu());
        $req->execute();
    }

    public function delete(AvisClient $avisClient) {
        $this->_db->query('DELETE FROM avis_client WHERE idAvisClient = '.$avisClient->getIdAvisClient());
    }

    public function update(AvisClient $avisClient) {
        $req = $this->_db->prepare('UPDATE avis_client SET idProduit = :idProduit, dateAvis = :dateAvis, idClient = :idClient, note = :note, titre = :titre, contenu = :contenu 
                                    WHERE idAvisClient = :idAvisClient');
        $req->bindValue(':idProduit', $avisClient->getIdProduit());
        $req->bindValue(':dateAvis', $avisClient->getDateAvis());
        $req->bindValue(':idClient', $avisClient->getIdClient());
        $req->bindValue(':note', $avisClient->getNote());
        $req->bindValue(':titre', $avisClient->getTitre());
        $req->bindValue(':contenu', $avisClient->getContenu());
        $req->bindValue(':idAvisClient', $avisClient->getIdAvisClient());
        $req->execute();
    }

    public function get($idAvisClient) {
		$req = $this->_db->query('SELECT idAvisClient, idProduit, dateAvis, idClient, note, titre, contenu FROM avis_client Where idAvisClient = '.$idAvisClient);
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
		return new AvisClient($donnees);
    }

    public function getAvisClientWhereIdProduit($idProduit) {
		$req = $this->_db->query('SELECT idAvisClient, idProduit, dateAvis, idClient, note, titre, contenu FROM avis_client Where idProduit = '.$idProduit);
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
		return new AvisClient($categorie);
    }

    public function getAvisClientWhereidClient($idClient) {
		$req = $this->_db->query('SELECT idAvisClient, idProduit, dateAvis, idClient, note, titre, contenu FROM avis_client Where idClient = '.$idClient);
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
		return new AvisClient($categorie);
    }

    public function setDB(PDO $db) {
        $this->_db = $db;
    }
}
?>