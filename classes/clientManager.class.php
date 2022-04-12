<?php
class ClientManager{

    private $_db;

    public function __construct($db) {
        $this->setDB($db);
    }

    public function add(Client $client) {
        $req = $this->_db->prepare('INSERT INTO client (nom, prenom, pseudo, mail, telephone, adresse, mdp) 
                                    VALUES (:nom, :prenom, :pseudo, :mail, :telephone, :adresse, :mdp)');
        $req->bindValue(':nom', $client->getNom());
        $req->bindValue(':prenom', $client->getPrenom());
        $req->bindValue(':nomPseudo', $client->getNomPseudo());
        $req->bindValue(':mail', $client->getMail());
        $req->bindValue(':telephone', $client->getTelephone());
        $req->bindValue(':adresse', $client->getAdresse());
        $req->bindValue(':mdp', $client->getMdp());
        $req->execute();
    }

    public function delete(Client $client) {
        $this->_db->query('DELETE FROM client WHERE idClient = '.$client->getIdClient());
    }

    public function update(Client $client) {
        $req = $this->_db->prepare('UPDATE client SET nom = :nom, prenom = :prenom, pseudo = :pseudo, mail = :mail, telephone = :telephone, adresse = :adresse, mdp = :mdp 
                                    WHERE idClient = :idClient');
        $req->bindValue(':nom', $client->getNom());
        $req->bindValue(':prenom', $client->getPrenom());
        $req->bindValue(':pseudo', $client->getPseudo());
        $req->bindValue(':mail', $client->getMail());
        $req->bindValue(':telephone', $client->getTelephone());
        $req->bindValue(':adresse', $client->getAdresse());
        $req->bindValue(':mdp', $client->getMdp());
        $req->bindValue(':idClient', $client->getIdClient());
        $req->execute();
    }

    public function get($idClient) {
		$req = $this->_db->query('SELECT idClient, nom, prenom, pseudo, mail, telephone, adresse FROM client Where idClient = '.$idClient);
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
		return new Client($donnees);
    }

    public function setDB(PDO $db) {
        $this->_db = $db;
    }
}
?>