$(function(){
    getProduit();

});

async function getProduit() {
    const result = await fetch('api.php?action=getProduitByCategorie&idCategorie=4');
    let res = await result.json();
    $('#datatable').DataTable({
        data: res,
        columnDefs: [{
          orderable: false,
          targets: "no-sort"
        }],
        aaSorting: [],
        lengthMenu: [10, 20, 40],
        columns: [                  
            { 
                'data': 'img',
                'render': (data,type,row,meta) => {
                    return '<a href="produit.php?id='+row.idProduit+'"><img style="height:12em; width:auto;" src="'+row.img+'" /></a>';
                },
                'searchable': false
            },
            { 
                'data': 'nom',
                'render': (data,type,row,meta) => {
                    return '<a class="text-decoration-none text-dark" href="produit.php?id='+row.idProduit+'">'+row.nom+'</a>';
                }
             },
            { 
                'data': 'descriptionProduit',
                'render': (data) => data.slice(0,1000)+' ...',
                'searchable': false
            },
            { 
                'data': 'prix',
                'render': (data) => '<h3>'+data+'€</h3>',
                'searchable': false
            }
        ],
        "language": {
            "url": "assets/DataTables/French.json"
        }
    });
}