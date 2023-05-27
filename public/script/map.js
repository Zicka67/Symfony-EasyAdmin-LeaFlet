// Code pour la carte Leaflet.js
var map = L.map('map').setView([48.54952, 7.73248], 15);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var marker = L.marker([48.54952, 7.73748]).addTo(map);

//On donne les coordonnées et la forme
var polygon = L.polygon([
    [48.551411850277134,7.740937248448404],
    [48.548952213518675,7.738328376287058],
    [48.5475740669051,7.7476307184389555],
    [48.551411850277134,7.740937248448404]
    //On ajoute a la map
]).addTo(map);

//On donne les coordonnées et la forme
var circle = L.circle([48.54952, 7.73248], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 120
    //On ajoute a la map
}).addTo(map);

//openPopup pour afficher au chargement
marker.bindPopup("<b>ELAN Formation").openPopup();
circle.bindPopup("I am a circle.");
polygon.bindPopup("I am a polygon.");

//Pour afficher un pop up indépendament des éléments plus haut et ajuste la map selon l'endroit du clic
var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("You clicked the map at " + e.latlng.toString())
        .openOn(map);
}

map.on('click', onMapClick);