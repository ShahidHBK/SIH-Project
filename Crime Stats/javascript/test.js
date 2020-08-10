var mymap = L.map('mapid').setView([51.512, -0.104], 6);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
maxZoom: 18,
id: 'mapbox.streets',
accessToken: 'pk.eyJ1Ijoic2hlZXRhbDEyMyIsImEiOiJjazRtc3VibWQyZDk2M21xdzUzcXRsZThvIn0.kVFd0-xEuhehxR8v4kp1iA'
}).addTo(mymap);