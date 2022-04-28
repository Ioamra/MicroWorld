$(function(){
    getProduit();

});

async function getProduit() {
    const result = await fetch('api.php?action=getProduitByCategorie&idCategorie=3');
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
                'render': (data,type,row,meta) => {
                    return '<a class="text-decoration-none text-dark description" href="produit.php?id='+row.idProduit+'">'+row.descriptionProduit.slice(0,600)+' ...</a>';
                },
                'searchable': false
            },
            { 
                'data': 'prix',
                'render': (data) => '<h3>'+data+'€</h3>',
                'searchable': false
            },
            { 
                'data': 'note',
                'render': (data) => {
                    let roundNote = Math.round(data);
                    let resNote = '<div class="etoile">';
                    for (let i = 0; i < roundNote; i++) {
                        resNote += '★';
                    }
                    for (let i = 0; i < 5-roundNote; i++) {
                        resNote += '☆';
                    }
                    resNote += '</div>';
                    return resNote;
                },
                'searchable': false
            }
        ],
        "language": {
            "url": "assets/DataTables/French.json"
        }
    });
}