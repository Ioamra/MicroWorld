<?php
class AvisClientManager {

    private $_db;

    public function __construct($db) {
        $this->setDB($db);
    }

    public function add(AvisClient $avisClient) {
        $req = $this->_db->prepare('INSERT INTO avis_client (idProduit, dateAvis, idClient, note, titre, contenu) 
                                    VALUES ((SELECT idProduit FROM produit WHERE idProduit = :idProduit), :dateAvis, (SELECT idClient FROM client WHERE idClient = :idClient), :note, :titre, :contenu)');
        $req->bindValue(':idProduit', $avisClient->getIdProduit());
        $req->bindValue(':dateAvis', $avisClient->getDateAvis());
        $req->bindValue(':idClient', $avisClient->getIdClient());
        $req->bindValue(':note', $avisClient->getNote());
        $req->bindValue(':titre', $avisClient->getTitre());
        $req->bindValue(':contenu', $avisClient->getContenu());
        $req->execute();
    }

    // public function delete(AvisClient $avisClient) {
    //     $this->_db->query('DELETE FROM avis_client WHERE idAvisClient = '.$avisClient->getIdAvisClient());
    // }

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

    public function getByIdProduit($idProduit) {
      $req = $this->_db->query("SELECT idAvisClient, idProduit, dateAvis, idClient, note, titre, contenu FROM avis_client Where idProduit = $idProduit ORDER BY idAvisClient DESC");
      $donnees = $req->fetchAll(PDO::FETCH_ASSOC);
      $res = [];
      foreach ($donnees as $li) {
        $res[] = new AvisClient($li);
      }
      return $res;
    }

    public function getByIdClient($idClient) {
      $req = $this->_db->query("SELECT idAvisClient, idProduit, dateAvis, idClient, note, titre, contenu FROM avis_client Where idClient = $idClient ORDER BY idAvisClient DESC");
      $donnees = $req->fetchAll(PDO::FETCH_ASSOC);
      $res = [];
      foreach ($donnees as $li) {
        $res[] = new AvisClient($li);
      }
      return $res;
    }

    public function getMoyenne($idProduit) {
      $req = $this->_db->query('SELECT AVG(note) as n FROM avis_client Where idProduit = '.$idProduit);
      $donnees = $req->fetch(PDO::FETCH_ASSOC);
      return (float)$donnees['n'];
    }

    public function countByIdProduit($idProduit) {
      $req = $this->_db->query('SELECT * FROM avis_client Where idProduit = '.$idProduit);
      $res = $req->rowCount();
      return $res;
    }

    public function countByIdProduitAndNote($idProduit, $note) {
      $req = $this->_db->query("SELECT * FROM avis_client Where idProduit = $idProduit AND note = $note");
      $res = $req->rowCount();
      return $res;
    }

    public function setDB(PDO $db) {
        $this->_db = $db;
    }
}
?>