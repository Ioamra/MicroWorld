$(function() {
    var caracteristiqueTextArea = 
    '<table class="table w-100">\n'+
    '    <thead>\n'+
    '        <tr>\n'+
    '            <th class="w-25">Informations générales sur le produit</th>\n'+
    '        </tr>\n'+
    '    </thead>\n'+
    '    <tbody>\n'+
    '        <tr>\n'+
    '            <td>Marque</td>\n'+
    '            <td>aaaaa</td>\n'+
    '        </tr>\n'+
    '        <tr>\n'+
    '            <td>Nom du produit</td>\n'+
    '            <td>aaaaa</td>\n'+
    '        </tr>\n'+
    '        <tr>\n'+
    '            <td>Catégorie</td>\n'+
    '            <td>aaaaa</td>\n'+
    '        </tr>\n'+
    '    </tbody>\n'+
    '    <thead>\n'+
    '        <tr>\n'+
    '            <th>Firstname</th>\n'+
    '        </tr>\n'+
    '    </thead>\n'+
    '    <tbody>\n'+
    '        <tr>\n'+
    '            <td>John</td>\n'+
    '            <td>aaaaa</td>\n'+
    '        </tr>\n'+
    '        <tr>\n'+
    '            <td>Mary</td>\n'+
    '            <td>aaaaa</td>\n'+
    '        </tr>\n'+
    '        <tr>\n'+
    '            <td>July</td>\n'+
    '            <td>aaaaa</td>\n'+
    '        </tr>\n'+
    '    </tbody>\n'+
    '</table>';

    $('#caracteristique').val(caracteristiqueTextArea);
});

function loadFile(numImg, event){
    var output = document.getElementById('imgPrecharger'+numImg);
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function(){
        URL.revokeObjectURL(output.src);
    }
}

