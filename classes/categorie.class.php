<?php
class Categorie {
    public $idCategorie;
    public $nomCategorie;

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
    public function getIdCategorie() {
        return $this->idCategorie;
    }

    public function getNomCategorie() {
        return $this->nomCategorie;
    }
    
    //* Setters
    public function setIdCategorie($id_categorie) {
        $this->idCategorie = $id_categorie;
    }

    public function setNomCategorie($nom_categorie) {
        $this->nomCategorie = $nom_categorie;
    }

}
?>
