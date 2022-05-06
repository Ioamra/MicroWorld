<?php
class CommandeManager{

    private $_db;

    public function __construct($db) {
        $this->setDB($db);
    }

    public function add(Commande $commande) {
        $req = $this->_db->prepare('INSERT INTO commande (idClient, dateCmde) VALUES ((SELECT idClient FROM client WHERE idClient = :idClient), :dateCmde)');
        $req->bindValue(':idClient', $commande->getIdClient());
        $req->bindValue(':dateCmde', $commande->getDateCmde());
        $req->execute();
    }

    // public function delete(Commande $commande) {
    //     $this->_db->query('DELETE FROM commande WHERE idCmde = '.$commande->getIdCmde());
    // }

    public function get($idCmde) {
		$req = $this->_db->query('SELECT idClient, dateCmde FROM commande Where idCmde = '.$idCmde);
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
		return new Commande($donnees);
    }

    public function getByIdClient($idClient) {
		$req = $this->_db->query('SELECT  idCmde, idClient, dateCmde FROM commande Where idClient = '.$idClient);
		$donnees = $req->fetchAll(PDO::FETCH_ASSOC);
        $res = [];
        foreach ($donnees as $li) {
            $res[] = new Commande($li);
        }
		return $res;
    }

    public function getMaxId() {
        $req = $this->_db->query('SELECT MAX(idCmde) FROM commande');
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
		return $donnees['MAX(idCmde)'];
    }

    public function setDB(PDO $db) {
        $this->_db = $db;
    }
}
?>