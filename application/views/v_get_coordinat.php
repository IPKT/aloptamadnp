<div class="row">
    
<div class="col-sm-6">
    <div class="form-group">
        <label for="">Latitude</label>
        <input class="form-control" name="latitude" id="Latitude">
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
        <label for="">Longitude</label>
        <input class="form-control" name="longitude" id="Longitude">
    </div>
</div>

</div>
<div id="map" style="width: 100%; height: 600px;"></div>

<script>
    var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11'
	});

var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/satellite-v9'
	});


var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	});

var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/dark-v10'
	});

    const map = L.map('map', {
		center: [-8.346562247167757, 115.16081838649232],
		zoom: 10,
		layers: [peta1]
	});

	const baseLayers = {
		'Default': peta1,
		'Satelite': peta2,
        'Street': peta3,
        'Dark': peta4,
	};

    const layerControl = L.control.layers(baseLayers).addTo(map);


// get koordinat
var latInput = document.querySelector("[name=latitude]");
var lngInput = document.querySelector("[name=longitude]");

var curLocation = [-8.346562247167757, 115.16081838649232];
map.attributionControl.setPrefix(false);
var marker = new L.marker(curLocation,{
    draggable : 'true',
});

marker.on('dragend', function(e){
    var position = marker.getLatLng();
    marker.setLatLng(position,{
        curLocation
    }).bindPopup(position).update();
    $("#Latitude").val(position.lat);
    $("#Longitude").val(position.lng);
});

map.on("click", function(e){
    var lat = e.latlng.lat;
    var lng = e.latlng.lng;
    if(!marker){
        marker = L.marker(e.latlng).addTo(map);
    } else {
        marker.setLatLng(e.latlng);
    }
    latInput.value = lat;
    lngInput.value = lng;

});
map.addLayer(marker);
</script>
