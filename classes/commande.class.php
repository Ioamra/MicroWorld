<?php
class Commande {
    public $idCmde;
    public $idClient;
    public $dateCmde;

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
    public function getIdCmde() {
        return $this->idCmde;
    }

    public function getIdClient() {
        return $this->idClient;
    }

    public function getDateCmde() {
        return $this->dateCmde;
    }

    //* Setters
    public function setIdCmde($id_cmde) {
        $this->idCmde = $id_cmde;
    }

    public function setIdClient($id_client) {
        $this->idClient = $id_client;
    }

    public function setDateCmde($date_cmde) {
        $this->dateCmde = $date_cmde;
    }
}
?>
