var mymap = L.map('mapid').setView([19.2056541, 72.81624769999999], 10);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
maxZoom: 18,
id: 'mapbox.streets',
accessToken: 'pk.eyJ1Ijoic2hlZXRhbDEyMyIsImEiOiJjazRtc3VibWQyZDk2M21xdzUzcXRsZThvIn0.kVFd0-xEuhehxR8v4kp1iA'
}).addTo(mymap);

var circle1 = L.circle([19.2056541, 72.81624769999999], {
    color: 'blue',
    fillColor: 'blue',
    fillOpacity: 0.5,
    radius: 1000
}).addTo(mymap);
var myIcon = L.icon({
iconUrl: 'man2.png',
iconSize: [25, 95],
iconAnchor: [22, 94],
popupAnchor: [-3, -76],
shadowSize: [68, 95],
shadowAnchor: [22, 94]
});
L.marker([50.505, 30.57], {icon: myIcon}).addTo(map);



function getLocation() {

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
     document.getElementById("demo").innerHTML = "Geolocation is not supported by this browser.";
  }
}
function showPosition(position) {
document.getElementById("demo").innerHTML = "Latitude: " + position.coords.latitude +
  "<br>Longitude: " + position.coords.longitude;
var lat=position.coords.latitude;
var lon=position.coords.longitude;
var marker2 = new L.marker([lat,lon],{
    draggable: true,
    autoPan: true,
   icon: myIcon
}).addTo(mymap).bindPopup("this is your location");


marker2.on('click', function(e) {
    var d = mymap.distance(e.latlng, circle1.getLatLng());
    var isInside = d < circle1.getRadius();
   if(isInside){
alert("It seems like the locality you are in is more prone to pick pocketing");
}
});


}