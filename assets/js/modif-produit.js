$(function(){
    let url = window.location;
    let params = new URLSearchParams(url.search);
    let page = params.get('page');
    let numPage = document.getElementsByClassName('page-item');

    for (i = 0; i < numPage.length; i++){
        if ( numPage[i].firstChild.innerHTML == page) {
            numPage[i].className = "page-item active";
        }
    }
});

function switchDispo(idProduit) {
    fetch('api.php?action=switchDispo&idProduit='+idProduit);
    window.location.reload();
}

function loadFile(numImg, event){
    var output = document.getElementById('imgPrecharger'+numImg);
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function(){
        URL.revokeObjectURL(output.src);
    }
}