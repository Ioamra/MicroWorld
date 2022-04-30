<?php
class HistoriqueProduit {
    public $idProduit;
    public $nom;
    public $prix;
    public $idCategorie;
    public $descriptionProduit;
    public $caracteristique;
    public $dateChangement;
    public $type;

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

    public function getNom() {
        return $this->nom;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getidCategorie() {
        return $this->idCategorie;
    }

    public function getDescriptionProduit() {
        return $this->descriptionProduit;
    }

    public function getCaracteristique() {
        return $this->caracteristique;
    }

    public function getDateChangement() {
        return $this->dateChangement;
    }

    public function getType() {
        return $this->type;
    }

    //* Setters
    public function setIdProduit($id_produit) {
        $this->idProduit = $id_produit;
    }

    public function setNom($nom_produit) {
        $this->nom = $nom_produit;
    }

    public function setPrix($prix_produit) {
        $this->prix = $prix_produit;
    }
    
    public function setidCategorie($id_categorie) {
        $this->idCategorie = $id_categorie;
    }

    public function setDescriptionProduit($description_produit) {
        $this->descriptionProduit = $description_produit;
    }

    public function setCaracteristique($caracteristique) {
        $this->caracteristique = $caracteristique;
    }

    public function setDateChangement($date_changement) {
        $this->dateChangement = $date_changement;
    }

    public function setType($type) {
        $this->type = $type;
    }
}
?>
