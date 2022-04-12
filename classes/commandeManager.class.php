<?php
class CommandeManager{

    private $_db;

    public function __construct($db) {
        $this->setDB($db);
    }

    public function add(Commande $commande) {
        $req = $this->_db->prepare('INSERT INTO commande (idClient, dateCmde) VALUES (:idClient, :dateCmde)');
        $req->bindValue(':idClient', $commande->getIdClient());
        $req->bindValue(':dateCmde', $commande->getDateCmde());
        $req->execute();
    }

    public function delete(Commande $commande) {
        $this->_db->query('DELETE FROM commande WHERE idCmde = '.$commande->getIdCmde());
    }

    public function get($idCmde) {
		$req = $this->_db->query('SELECT idClient, dateCmde FROM commande Where idCmde = '.$idCmde);
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
		return new Commande($donnees);
    }

    public function getByIdClient($idClient) {
		$req = $this->_db->query('SELECT idCmde, dateCmde FROM commande Where idClient = '.$idClient);
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
		return new Commande($donnees);
    }

    public function setDB(PDO $db) {
        $this->_db = $db;
    }
}
?>