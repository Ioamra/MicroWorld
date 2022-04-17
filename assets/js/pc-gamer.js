$(function() {
    $('#datatable').DataTable( {
        ajax: {
            url: "api.php",
            data: data
        }

    } );
} );