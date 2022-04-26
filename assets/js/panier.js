$(function(){
    let panier = new Panier();
    if (panier.panier.length > 0) {
        // Si il y a des produit dans le panier
        let contenu = '<table class="table"><tbody>';
        contenu += '<tr>';
        contenu += '<th></th>';
        contenu += '<th>Nom</th>';
        contenu += '<th>Prix unitaire</th>';
        contenu += '<th>quantité</th>';
        contenu += '<th>prix global</th>';
        contenu += '</tr>';

        for (let i = 0; i < panier.panier.length; i++) {
            contenu += '<tr>';
            contenu += '<td><img src="'+panier.panier[i].cheminImage+'" style="height:4em; width:auto;"</td>';
            contenu += '<td>'+panier.panier[i].nom+'</td>';
            contenu += '<td>'+panier.panier[i].prix+' €/unité</td>';
            contenu += '<td><button class="btn btn-outline-secondary m-1" onclick="let panier = new Panier(); panier.ajoutQte({id:'+panier.panier[i].id+'},-1); if(!panier.panier['+i+']){window.location.reload();} if(panier.panier['+i+'].id != '+panier.panier[i].id+'){window.location.reload();} refreshQte();">-</button>'
                    +'<button class="btn btn-outline-secondary m-1" id="qte'+panier.panier[i].id+'">'+panier.panier[i].qte+'</button>'
                    +'<button class="btn btn-outline-secondary m-1" onclick="let panier = new Panier(); panier.ajoutQte({id:'+panier.panier[i].id+'},1); refreshQte();">+</button></td>';
            contenu += '<td id="prixLigne'+panier.panier[i].id+'">'+panier.panier[i].prix*panier.panier[i].qte+' €</td>';
            contenu += '</tr>';
        }
        contenu += '<tr>';
        contenu += '<td></td>';
        contenu += '<td></td>';
        contenu += '<td></td>';
        contenu += '<td>TOTAL :</td>';
        contenu += '<td id="prixTotal">'+panier.getPrixTotal()+' €</td>';
        contenu += '</tr>';
        contenu += '</tbody></table>';
        contenu += '<br>La livraison est offerte et les colis sont livrés en 2-3 jours ouvrables avec Colissimo.<hr>';

        contenu += '<h3 class="text-center my-4">Vos coordonnées bancaires</h3>';
        contenu += '<form method="post" class="box-coord-banq">';
	    contenu += '    <input type="text" class="form-control" name="nom-carte" placeholder="Nom du détenteur de la carte">';
	    contenu += '    <input type="int" class="form-control" name="num-carte" placeholder="Numéros de la carte">';
        contenu += '    <div class="input-group">';
	    contenu += '        <input type="text" class="form-control" name="date-carte" placeholder="Date d\'expiration">';
	    contenu += '        <input type="int" class="form-control" name="num-secu-carte" placeholder="Code de sécurité">';
        contenu += '    </div>';
        contenu += '</form>';
        contenu += '<button class="btn btn-primary mt-4" type="button" id="valider-achat">Valider l\'achat</button>';
        $("#box-panier").html(contenu);
        
        $('#valider-achat').on('click', function(){
            if (confirm('Etes-vous sur de vouloir valider cet achat?') == true){
                let chaine = "";
                for (let i = 0; i < panier.panier.length; i++) {
                    chaine += '&idProduit[]='+panier.panier[i].id;
                    chaine += '&qteProduit[]='+panier.panier[i].qte;
                }
                fetch('api.php?action=validAchat'+chaine)
                    .then(res => res.text())
                    .then((data) => {
                        if (data) {
                            alert(data);
                        } else {
                            panier.removeAll();
                            // changement de page
                        }
                    });
            }
        });

    
    } else {
        // Si il ni a pas de produit dans le panier
        $("#box-panier").html("<h2>Votre panier est vide.</h2>");
    }
});


function refreshQte() {
    let panier = new Panier();
    for (let i = 0; i < panier.panier.length; i++) {
        $('#qte'+panier.panier[i].id).text(panier.panier[i].qte);
        $('#prixLigne'+panier.panier[i].id).text(panier.panier[i].prix*panier.panier[i].qte+' €');
        $('#prixTotal').text(panier.getPrixTotal()+' €');
    }
}