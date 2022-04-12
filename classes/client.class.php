<?php
class Client {
    public $idClient;
    public $nom;
    public $prenom;
    public $pseudo;
    public $mail;
    public $telephone;
    public $adresse;
    public $mdp;

    function __construct(array $donnees) {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees) {
	    foreach ($donnees as $key => $value) {
		    $method = 'set'.$key;
		    if (method_exists($this, $method)) {
			    $this->$method($value);
		    }
        }
    }

    //* Getters
    public function getIdClient() {
        return $this->idClient;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getMdp() {
        return $this->mdp;
    }

    //* Setters
    public function setIdClient($id_client) {
        $this->idClient = $id_client;
    }

    public function setNom($nom_client) {
        $this->nom = $nom_client;
    }

    public function setPrenom($prenom_client) {
        $this->prenom = $prenom_client;
    }

    public function setPseudo($pseudo_client) {
        $this->pseudo = $pseudo_client;
    }

    public function setMail($mail_client) {
        $this->mail = $mail_client;
    }

    public function setTelephone($telephone_client) {
        $this->telephone = $telephone_client;
    }

    public function setAdresse($adresse_client) {
        $this->adresse = $adresse_client;
    }

    public function setMdp($mdp_client) {
        $this->mdp = $mdp_client;
    }
}
?>
