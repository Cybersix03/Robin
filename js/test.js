
function request(callback) {

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {

        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {

            callback(xhr.responseText);

        }

    };
    xhr.open("GET", "./core/php/crud/models/user.php", true);
    xhr.send(null);
}


function readData(sData) {

    // On peut maintenant traiter les données sans encombrer l'objet XHR.

    console.log(sData);



}


request(readData);
