<!DOCTYPE html>
<html>
<head>
    <title>Map</title>
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet/dist/leaflet.css"
    />
    <style>
        #map { height: 100vh; }
    </style>
</head>
<body>

<div id="map"></div>
<p id="error" style="color:red;"></p>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            success,
            error
        );
    } else {
        document.getElementById('error').innerText =
            "Geolocation not supported";
    }

    function success(position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;

        const map = L.map('map').setView([lat, lng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // User marker
        L.marker([lat, lng]).addTo(map)
            .bindPopup("You are here")
            .openPopup();

        // Dummy hotels
        const hotels = [
            { name: "Hotel One", lat: lat + 0.01, lng: lng + 0.01 },
            { name: "Hotel Two", lat: lat - 0.01, lng: lng - 0.01 },
        ];

        hotels.forEach(hotel => {
            L.marker([hotel.lat, hotel.lng])
                .addTo(map)
                .bindPopup(hotel.name);
        });
    }

    function error() {
        document.getElementById('error').innerText =
            "Location permission denied";
    }
</script>

</body>
</html>
