/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global google*/
var marker = null;
var map = null;
var google;
function initialize() {
    "use strict";
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var mapOptions;
            mapOptions = {
                center: { lat: position.coords.latitude, lng: position.coords.longitude },
                zoom: 15
            };
            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
                map: map
            });
        });
        document.getElementById('full_screen').addEventListener('click', function () {
            var elem = document.getElementById('map-canvas');
            if (elem.requestFullscreen) {//pour IE ?
                elem.requestFullscreen();
            } else if (elem.mozRequestFullScreen) {//pour mozilla
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) {//pour chrome fait un carre noir autour
                elem.webkitRequestFullscreen();
            }
        });
    } else {
        alert("Veuillez accepter de partager vos coordonnées svp (on le donnera à personne promis)");
        return;
    }
}
google.maps.event.addDomListener(window, 'load', initialize);
function rechercheLiens(id) {
    "use strict";
    marker.setMap(null);
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

function recherche() {
    "use strict";
    marker.setMap(null);
    document.getElementById('result').innerHTML = "Voici les resultats de votre recherche :" + '</br>';//on afface les precedents resultats
    new google.maps.Geocoder().geocode({'address': document.getElementById('search').value},//on prend la valeur de l'input
        function (resultat, status) {
            var i;
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

function trajet() {
    "use strict";
    var origin, destination, select, valeurOption, traject, direction, requete, directionsService;
    origin = document.getElementById('origin').value;
    destination = document.getElementById('arriver').value;
    select = document.getElementById('transport');
    valeurOption = select.options[select.selectedIndex].value;
    traject = document.getElementById('destination');
    traject.innerHTML = '';
    direction = new google.maps.DirectionsRenderer({map : map, panel : traject});
    requete = {origin : origin, destination : destination, travelMode : google.maps.DirectionsTravelMode[valeurOption] // Type de transport
        };
    directionsService = new google.maps.DirectionsService(); // Service de calcul d'itinéraire
    directionsService.route(requete, function (response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            var nbr, i, distance_km, distance_temps, depart, arriver, etapes, etapeLong, etapeLat, etapePosition;
            direction.setDirections(response); // Trace l'itinéraire sur la carte et les différentes étapes du parcours
            distance_km = response.routes[0].legs[0].distance.text;
            distance_temps = response.routes[0].legs[0].duration.text;
            depart = response.routes[0].legs[0].start_address;
            arriver = response.routes[0].legs[0].end_address;
            etapes = response.routes[0].legs[0].steps;
            document.getElementById('routes').innerHTML = document.getElementById('routes').innerHTML + 'Entre ' + depart + ' et ' + arriver + ' il y a ' + distance_km + '</br>';
            document.getElementById('routes').innerHTML = document.getElementById('routes').innerHTML + 'Fait en ' + distance_temps + '</br>';
            if (etapes.length < 5) {
                nbr = etapes.length / 2;
                nbr = Math.floor(nbr);
            }
            if (etapes.length < 10 && etapes.length > 5) {
                nbr = etapes.length / 3;
                nbr = Math.floor(nbr);
            }
            if (etapes.length < 20 && etapes.length > 10) {
                nbr = etapes.length / 4;
                nbr = Math.floor(nbr);
            }
            if (etapes.length < 30 && etapes.length > 20) {
                nbr = etapes.length / 5;
                nbr = Math.floor(nbr);
            }
            if (etapes.length < 50 && etapes.length > 30) {
                nbr = etapes.length / 10;
                nbr = Math.floor(nbr);
            }
            if (etapes.length < 100 && etapes.length > 50) {
                nbr = etapes.length / 10;
                nbr = Math.floor(nbr);
            }
            if (etapes.length < 200 && etapes.length > 100) {
                nbr = etapes.length / 20;
                nbr = Math.floor(nbr);
            }
            if (etapes.length > 200) {
                nbr = etapes.length / 50;
                nbr = Math.floor(nbr);
            }
            for (i = 0; i < etapes.length; i = i + nbr) {
                etapeLat = etapes[i].end_location.k;
                etapeLat = etapeLat.toString();
                etapeLong = etapes[i].end_location.D;
                etapeLong = etapeLong.toString();
                etapePosition = etapeLat + ', ' + etapeLong;
                new google.maps.Geocoder().geocode({'address': etapePosition},//on prend la valeur de l'input
                    function (resultat, status) {
                        var infowindow, service, requete_demande;
                        if (status === "OK") {
                            marker = new google.maps.Marker({map: map});
                        } else {
                            console.log("Pas de resultats !! ou " + status);
                            return;//arrete la fonction lorsqu'il y a pas de resultat
                        }
                        requete_demande = {
                            location: resultat[0].geometry.location,
                            radius: [50],
                            query: 'point of interest, monuments'
                        };
                        infowindow = new google.maps.InfoWindow();
                        service = new google.maps.places.PlacesService(map);
                        service.textSearch(requete_demande, callbacksTrajet);

                        function creerMarkerTrajet(place) {
                            var marker;
                            marker = new google.maps.Marker({
                                map: map,
                                position: place.geometry.location
                            });

                            google.maps.event.addListener(marker, 'click', function () {
                                infowindow.setContent(place.name);
                                infowindow.open(map, this);
                            });
                        }

                        function callbacksTrajet(results, status) {
                            if (status === google.maps.places.PlacesServiceStatus.OK) {
                                for (i = 0; i < results.length; i = i + 1) {
                                    creerMarkerTrajet(results[i]);
                                }
                            }
                        }
                    }
                    );
                document.getElementById('routes').innerHTML = document.getElementById('routes').innerHTML + 'Etape ' + (i + 1) + ' : ' + etapes[i].instructions + '</br>';
                document.getElementById('routes').innerHTML = document.getElementById('routes').innerHTML + 'Distance : ' + etapes[i].distance.text + ' Temps esitmé : ' + etapes[i].duration.text + '</br>';
            }
        }
    });
}