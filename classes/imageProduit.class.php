<?php
class ImageProduit {
    public $idProduit;
    public $cheminImage;

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
    public function getIdProduit() {
        return $this->idProduit;
    }

    public function getCheminImage() {
        return $this->cheminImage;
    }

    //* Setters
    public function setIdProduit($id_produit) {
        $this->idProduit = $id_produit;
    }

    public function setCheminImage($chemin_image) {
        $this->cheminImage = $chemin_image;
    }
}
?>
