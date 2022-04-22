$(function(){
    let panier = new Panier();
    if (panier.panier.length > 0) {
        // Si il y a des produit dans le panier
        let contenu = "";
        for (let i = 0; i < panier.panier.length; i++) {
            contenu += 
            panier.panier[i].id;
            panier.panier[i].nom;
            panier.panier[i].id;
        }
        $("#box-panier").html(
            ""
        );
    
    } else {
        // Si il ni a pas de produit dans le panier
        $("#box-panier").html("<h2>Votre panier est vide.</h2>");
    }
    
});
