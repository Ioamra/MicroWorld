<?php
class LigneDeCommande {
    public $idCmde;
    public $idProduit;
    public $qte;

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

    public function getIdProduit() {
        return $this->idProduit;
    }

    public function getQte() {
        return $this->qte;
    }

    //* Setters
    public function setIdCmde($id_cmde) {
        $this->idCmde = $id_cmde;
    }

    public function setIdProduit($id_produit) {
        $this->idProduit = $id_produit;
    }

    public function setQte($qte_ligne) {
        $this->qte = $qte_ligne;
    }
}
?>
