/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global google*/
var marker = null;
var marqueur = [];
var largeurPseudo = 0;
var map = null;
var pseudo = document.getElementById('pseudo').innerHTML;
function initialize() {
    "use strict";
    var mapOptions;
    mapOptions = {
        center: { lat: 48.856614, lng: 2.3522219000000177},
        zoom: 15
    };
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(48.856614, 2.35222190000000177),
        map: map
    });
    google.maps.event.addListener(map, 'rightclick', function (event) {
        if (localStorage) {
            if (marqueur.length <= 41) {
                ajoutMarqueur(event.latLng);
            }
        } else {
            alert("localStorage n'est pas pris par votre navigateur donc on ne pourras pas enregistrer vos marqueurs");
        }
    });
}

function ajoutMarqueur(location) {
    "use strict";
    var image, marker, demande, infowindow;
    image = {
        url: 'media/imageMarqueur/' + (marqueur.length + 1) + '.png',
        size: new google.maps.Size(25, 25)
    };
    demande = prompt("le contenu de votre marqueur :");
    marker = new google.maps.Marker({
        position: location,
        map: map,
        icon: image
    });
    infowindow = new google.maps.InfoWindow({
        content: 'demande'
    });
    marqueur.push(marker);//on ajoute le marqueur dans le tableau
    largeurPseudo = largeurPseudo + 1;
    localStorage.setItem(pseudo + 'largeur',largeurPseudo);
    localStorage.setItem(pseudo + marqueur.length + 'position', location);
    localStorage.setItem(pseudo + marqueur.length, demande);
    document.getElementById('tresor').innerHTML = document.getElementById('tresor').innerHTML + 'Marqueur ' + marqueur.length + ' : ' + demande + '</br>';
}

document.getElementById('local').addEventListener('click', function () {
    "use strict";
    document.getElementById('tresor').innerHTML = null;
    var i;
    for (i = 1; i <= localStorage.getItem(pseudo + 'largeur'); i = i + 1) {
        document.getElementById('tresor').innerHTML = document.getElementById('tresor').innerHTML + 'Marqueur ' + i + ' : ' + localStorage.getItem(pseudo + i) + '<a href="#" id="lien' + i + '" title="#" onclick=rechercheLiens(' + i + ')>' + localStorage.getItem(pseudo + i + 'position') + '</a>' + '</br>';
    }
});

document.getElementById('vider').addEventListener('click', function () {
    "use strict";
    var i;
    document.getElementById('tresor').innerHTML = null;
    for (i = 0; i <= localStorage.getItem(pseudo + 'largeur'); i = i + 1) {
        localStorage.removeItem(pseudo + i);
    }
    localStorage.removeItem(pseudo + 'largeur');
});

document.getElementById('full_screen').addEventListener('click', function () {
    "use strict";
    var elem = document.getElementById('map-canvas');
    if (elem.requestFullscreen) {//pour IE ?
        elem.requestFullscreen();
    } else if (elem.mozRequestFullScreen) {//pour mozilla
        elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) {//pour chrome fait un carre noir autour
        elem.webkitRequestFullscreen();
    }
});


google.maps.event.addDomListener(window, 'load', initialize);
function rechercheLiens(id) {
    "use strict";
    var result = document.getElementById('lien' + id).innerHTML;
    result = result.trim();
    new google.maps.Geocoder().geocode({
        'address': result
    },
        function (resultat, status) {
            if (status === "OK") {
                marker = new google.maps.Marker({
                    map: map
                });
                marker.setPosition(resultat[0].geometry.location);
                map.setCenter(resultat[0].geometry.location);
                map.setZoom(15);
            } else {
                console.log("Pas de resultat !!");
            }
        }
        );
}

function rechercheVille() {
    "use strict";
    document.getElementById('result').innerHTML = "Voici les resultats de votre recherche :" + '</br>';//on afface les precedents resultats
    new google.maps.Geocoder().geocode({'address': document.getElementById('search').value},//on prend la valeur de l'input
        function (resultat, status) {
            var i, marker;
            if (status === "OK") {
                marker = new google.maps.Marker({map: map});
                marker.setPosition(resultat[0].geometry.location);
                map.setCenter(resultat[0].geometry.location);
                map.setZoom(15);
                for (i = 0; i < resultat.length; i = i + 1) {
                    document.getElementById('result').innerHTML = document.getElementById('result').innerHTML + '<a href="#" id="lien' + [i] + '" title="#" onclick=rechercheLiens(' + [i] + ')>' + resultat[i].formatted_address + '</a>' + '</br>';
                }
            } else {
                alert("Pas de resultats !! ou " + status);
            }
        }
        );
}