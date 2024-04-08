<div class="row">
    <div class="col-sm-8">
        <div id="map" style="width: 100%; height: 600px;"></div>
    </div>
    <div class="col-sm-4">
        <?php 
        //notifikasi pesan validasi
        echo validation_errors('<div class="alert alert-danger">','</div>');
        
        //notifikasi pesan data berhasil disimpan
        if ($this->session->flashdata('pesan')) {
            # code...
            echo '<div class="alert alert-success">';
            echo $this->session->flashdata('pesan');
            echo '  <a class="btn btn-xs btn-success" href="'.base_url('sosialisasi"').'>Lihat Data</a> </div>';
        }
        
        ?>

        <?php echo form_open_multipart('sosialisasi/input_data_lokasi')?>
        <div class="form-group">
            <label for="">Nama Lokasi</label>
            <input class="form-control" name="nama_lokasi" placeholder="Nama Lokasi" required>
        </div>
        <div class="form-group">
            <label for="">Koordinat</label>
            <input class="form-control" name="koordinat" id="Longitude" placeholder="lat,lng" required>
        </div>
        <!-- <div class="form-group">
            <label for="">Latitude</label>
            <input class="form-control" name="latitude" id="Latitude" placeholder = "Latitude">
        </div>
        <div class="form-group">
            <label for="">Longitude</label>
            <input class="form-control" name="longitude" id="Longitude" placeholder = "Longitude">
        </div> -->
        <div class="form-group">
            <label for="">Kabupaten /  Kota</label>
            <select class="form-control" name="kabupaten" id="" required >
            <option disabled selected value="">Pilih</option>
                <option value="Denpasar">Denpasar</option>
                <option value="Badung">Badung</option>
                <option value="Gianyar">Gianyar</option>
                <option value="Klungkung">Klungkung</option>
                <option value="Karangasem">Karangasem</option>
                <option value="Bangli">Bangli</option>
                <option value="Buleleng">Buleleng</option>
                <option value="Tabanan">Tabanan</option>
                <option value="Jembrana">Jembrana</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Detail Lokasi</label>
            <input class="form-control" name="detail_lokasi" placeholder="Detail Lokasi" >
        </div>
        <div class="form-group">
            <label for="">Jenis Lokasi</label>
            <select class="form-control" name="jenis_lokasi" id="cars" required >
            <option disabled selected value="">Pilih</option>
                <option value="Sekolah">Sekolah</option>
                <option value="Kantor Pemerintah">Kantor Pemerintah</option>
                <option value="Kantor Swasta">Kantor Swasta</option>
                <option value="Lain lain">Lain Lain</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-danger">Riset</button>
        </div>


        <?php echo form_close()?>
        <div class="form-group">
            <button type="" class="btn btn-success" name="btn-check">Cek Lokasi</button>
        </div>


    </div>

</div>



<script>
var peta1 = L.tileLayer(
    'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11'
    });

var peta2 = L.tileLayer(
    'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/satellite-v9'
    });


var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
});

var peta4 = L.tileLayer(
    'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/dark-v10'
    });
var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
});

var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
});

var center_map_lat = -8.34656224716775;
var center_map_lng = 115.16081838649232;
const map = L.map('map', {
    center: [center_map_lat, center_map_lng],
    zoom: 10,
    layers: [googleStreets]
});

const baseLayers = {
    'Satelite': googleSat,
    'Street': googleStreets,
    'Open Street map': peta3,
};

const layerControl = L.control.layers(baseLayers).addTo(map);


var greenIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

var redIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});
var blueIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});
var blackIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-black.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});
var yellowIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-yellow.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

var violetIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-violet.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});


// Menambahkan seluruh data

<?php        
        foreach ($lokasi_sosialisasi as $key => $value) {?>
L.marker([<?=$value->koordinat?>] <?php if ($value->jenis_lokasi =='Sekolah') { ?>, {
        icon: greenIcon
    }
    <?php } elseif($value->jenis_lokasi =='Kantor Pemerintah') { ?>, {
        icon: yellowIcon
    }
    <?php } elseif($value->jenis_lokasi =='Kantor Swasta') { ?>, {
        icon: violetIcon
    }
    <?php } ?>

).bindTooltip("<h7><b><?php
            
    echo $value->nama_lokasi?></h7></b>", {
    permanent: true,
    direction: 'right'
}).addTo(map);
<?php    } ?>
// AKHIR Menambahkan seluruh data









// get koordinat
// var latInput = document.querySelector("[name=latitude]");
// var lngInput = document.querySelector("[name=longitude]");
var btn_check = document.querySelector("[name=btn-check]");
var koordinat = document.querySelector("[name=koordinat]");


var curLocation = [center_map_lat, center_map_lng];
map.attributionControl.setPrefix(false);
var marker = new L.marker(curLocation, {
    draggable: 'true',
});

marker.on('dragend', function(e) {
    var position = marker.getLatLng();
    marker.setLatLng(position, {
        curLocation
    }).bindPopup(position).update();
    // $("#Latitude").val(position.lng);
    // $("#Longitude").val(position.lng);
    koordinat.value = position.lat + ", " + position.lng;
});

map.on("click", function(e) {
    var lat = e.latlng.lat;
    var lng = e.latlng.lng;
    if (!marker) {
        marker = L.marker(e.latlng).addTo(map);
    } else {
        marker.setLatLng(e.latlng);
    }
    koordinat.value = lat + ", " + lng;
    // lngInput.value = lng;

});

btn_check.onclick = function(e) {
    //var lat = latInput.value;
    //var lng = lngInput.value;
    var lat_lng1 = koordinat.value;
    var lat_lng = lat_lng1.split(", ");

    var lat = lat_lng[0];
    var lng = lat_lng[1];


    // var lat_lng = koordinat.value;
    // console.log(lat);


    if (!marker) {
        marker = L.marker([lat, lng]).addTo(map);
    } else {
        marker.setLatLng([lat, lng]);
    }
    map.panTo(new L.LatLng(lat, lng));
    map.setView([lat, lng], 13);



};
map.addLayer(marker);


//Setting Text Area
var textAreas = document.getElementsByTagName('textarea');
Array.prototype.forEach.call(textAreas, function(elem) {
    elem.placeholder = elem.placeholder.replace(/\\n/g, '\n');
});
</script>