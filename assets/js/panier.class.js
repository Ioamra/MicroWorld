class Panier {
    constructor() {
        let panier = localStorage.getItem("panier");
        if (panier == null) {
            this.panier = [];
        } else {
            this.panier = JSON.parse(panier);
        }
    }
    
    save() {
        localStorage.setItem("panier", JSON.stringify(this.panier));
    }

    add(produit) {
        let produitExist = this.panier.find((p) => p.id == produit.id);
        if (produitExist != undefined) {
            produitExist.qte++;
        } else {
            produit.qte = 1;
            this.panier.push(produit);
        }
        this.save();
    }

    remove(produit) {
        this.panier = this.panier.filter((p) => p.id != produit.id);
        this.save()
    }

    removeAll() {
        this.panier = [];
        this.save();
    }

    ajoutQte(produit, qte) {
        let produitExist = this.panier.find((p) => p.id == produit.id);
        if (produitExist != undefined) {
            produitExist.qte += qte;
            if (produitExist.qte <= 0) {
                this.remove(produitExist);
            } else {
                this.save();
            }
        }
    }

    getNbProduit() {
        let nb = 0;
        for (let produit of this.panier) {
            nb += produit.qte;
        }
        return nb;
    }

    getPrixTotal() {
        let prix = 0;
        for (let produit of this.panier) {
            prix += produit.qte * produit.prix;
        }
        return prix;
    }
}
//* Pour l'utilisation
// let panier = new Panier();
// panier.add({id:"25",prix:"850"});
// panier.remove({id:"25"});
// panier.ajoutQte({id:"25"},7);
// panier.getNbProduit();
// panier.getPrixTotal();