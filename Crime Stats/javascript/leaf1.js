var mymap = L.map('mapid').setView([51.512, -0.104], 1);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
maxZoom: 18,
id: 'mapbox.streets',
accessToken: 'pk.eyJ1Ijoic2hlZXRhbDEyMyIsImEiOiJjazRtc3VibWQyZDk2M21xdzUzcXRsZThvIn0.kVFd0-xEuhehxR8v4kp1iA'
}).addTo(mymap);

var circle = L.circle([19.1981,72.8259], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 100000
}).addTo(mymap);
var marker = new L.marker([19.1981,72.9259],{
    draggable: true,
    autoPan: true
}).addTo(mymap);



marker.on('drag', function(e) {
    var d = mymap.distance(e.latlng, circle.getLatLng());
    var isInside = d < circle.getRadius();
    circle.setStyle({
        fillColor: isInside ? 'green' : '#f03'

    })

});