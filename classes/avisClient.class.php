<?php
class AvisClient {
    public $idAvisClient;
    public $idProduit;
    public $dateAvis;
    public $idClient;
    public $note;
    public $titre;
    public $contenu;

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
    public function getIdAvisClient() {
        return $this->idAvisClient;
    }

    public function getIdProduit() {
        return $this->idProduit;
    }

    public function getDateAvis() {
        return $this->dateAvis;
    }

    public function getIdClient() {
        return $this->idClient;
    }

    public function getNote() {
        return $this->note;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getContenu() {
        return $this->contenu;
    }

    //* Setters
    public function setIdAvisClient($id_avis_client) {
        $this->idAvisClient = $id_avis_client;
    }

    public function setIdProduit($id_produit) {
        $this->idProduit = $id_produit;
    }

    public function setDateAvis($date_avis) {
        $this->dateAvis = $date_avis;
    }

    public function setIdClient($id_client) {
        $this->idClient = $id_client;
    }

    public function setNote($note_avis) {
        $this->note = $note_avis;
    }

    public function setTitre($titre_avis) {
        $this->titre = $titre_avis;
    }

    public function setContenu($contenu_avis) {
        $this->contenu = $contenu_avis;
    }
}
?>
