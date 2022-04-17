$(function() {
    console.log(window.screen.width);

});

async function getProduit(categorie, search) {
    fetch('api.php?categorie='+categorie+'&search='+search)
        .then(res => res.text())
        .then((data) => { 
            return JSON.parse(data);
        }
    );
}