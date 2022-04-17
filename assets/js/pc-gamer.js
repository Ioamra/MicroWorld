$(function() {
    getProduit();

} );

async function getProduit() {
    const result = await fetch('api.php?action=getProduitByCategorie&idCategorie=1');
    let res = await result.json();
    $('#datatable').DataTable({
        data: res,
        columns: [                  
            { 'data': 'nom' },
            { 'data': 'descriptionProduit' },
            { 'data': 'prix' },
            // { 'data': 'img' }
        ],
    });
}