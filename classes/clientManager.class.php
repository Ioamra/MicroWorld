<?php
class ClientManager{

    private $_db;

    public function __construct($db) {
        $this->setDB($db);
    }

    public function inscription(Client $client) {
        //* Vérification des doublons d'adresse mail
        $req = $this->_db->prepare("SELECT * FROM client WHERE mail = :mail");
        $req->bindValue(':mail', $client->getMail());
        $req->execute();
        $result = $req->rowCount();
        if ($result > 0) {
            return "Cette adresse mail est déjà utilisé.";
        }
    
        //* Vérification des doublons de pseudo
        $req = $this->_db->prepare("SELECT * FROM client WHERE pseudo = :pseudo");
        $req->bindValue(':pseudo', $client->getPseudo());
        $req->execute();
        $result = $req->rowCount();
        if ($result > 0) {
            return "Ce pseudo est déjà utilisé.";
        }

        $req = $this->_db->prepare('INSERT INTO client (nom, prenom, pseudo, mail, telephone, adresse, mdp) 
                                    VALUES (:nom, :prenom, :pseudo, :mail, :telephone, :adresse, :mdp)');
        $req->bindValue(':nom', $client->getNom());
        $req->bindValue(':prenom', $client->getPrenom());
        $req->bindValue(':pseudo', $client->getPseudo());
        $req->bindValue(':mail', $client->getMail());
        $req->bindValue(':telephone', $client->getTelephone());
        $req->bindValue(':adresse', $client->getAdresse());
        $req->bindValue(':mdp', $client->getMdp());
        $req->execute();

        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['mail'] = $mail;
        $_SESSION['telephone'] = $telephone;
        $_SESSION['adresse'] = $adresse;
        header("location:index.php");
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

    public function connexion(Client $client) {    
        $req = $this->_db->prepare("SELECT mail, mdp FROM client WHERE mail = :mail AND mdp = :mdp");
        $req->bindValue(':mail', $client->getMail());
        $req->bindValue(':mdp', $client->getMdp());
        $req->execute();
        $user_exist = $req->rowCount();
        if ($user_exist == 1) {
            $req = $this->_db->prepare("SELECT idClient, nom, prenom, pseudo, mail, telephone, adresse FROM client WHERE mail = :mail");
            $req->bindValue(':mail', $client->getMail());
            $req->execute();
            $data = $req->fetch(\PDO::FETCH_OBJ);
            $id = $data->idClient;
            $nom =  $data->nom;
            $prenom =  $data->prenom;
            $pseudo =  $data->pseudo;
            $mail =  $data->mail;
            $telephone =  $data->telephone;
            $adresse =  $data->adresse;
    
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['mail'] = $mail;
            $_SESSION['telephone'] = $telephone;
            $_SESSION['adresse'] = $adresse;
            header("location:index.php");
        } else {
            return false;
        }
    }

    public function setDB(PDO $db) {
        $this->_db = $db;
    }
}
?>