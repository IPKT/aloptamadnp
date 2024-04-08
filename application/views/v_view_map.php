<div id="map" style="width: 100%; height: 600px;"></div>

<script>
const map = L.map('map').setView([-8.421670813516512, 115.35885647730456], 20); 
const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);
</script>