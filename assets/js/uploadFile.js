var input = document.getElementById( 'file-upload' );
var infoArea = document.getElementById( 'file-upload-filename' );

input.addEventListener( 'change', showFileName );

function showFileName( event ) {
  var input = event.srcElement;
  var fileName = input.files[0].name;
    if(fileName.length >= 10){
      let splitName = fileName.split('.');
      fileName1 = splitName[0].substring(0, 11) + "... ." + splitName[1];
    }
  infoArea.textContent = fileName1;
}