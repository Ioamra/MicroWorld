function loadFile(numImg, event){
    var output = document.getElementById('imgPrecharger'+numImg);
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function(){
        URL.revokeObjectURL(output.src);
    }
}