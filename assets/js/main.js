$(function() {
    actuNavPanier();
    
});

function actuNavPanier() {
    let panier = new Panier();
    if (panier.getNbProduit() == 0) {
        $('#nav-panier').addClass('d-none');
    } else {
        $('#nav-panier').removeClass('d-none');
        $('#nb-produit-panier').text(panier.getNbProduit());
    }
}