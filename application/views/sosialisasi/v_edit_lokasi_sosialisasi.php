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

        <?php echo form_open_multipart('sosialisasi/update_data')?>
        <div class="form-group" hidden>
            <label for="">ID Lokasi</label>
            <input class="form-control" name="id_lokasi" placeholder="Nama Lokasi" value="<?=$sosialisasi->id_lokasi?>" required>
        </div>
        <div class="form-group">
            <label for="">Nama Lokasi</label>
            <input class="form-control" name="nama_lokasi" placeholder="Nama Lokasi" required value="<?=$sosialisasi->nama_lokasi ?>">
        </div>
        <div class="form-group">
            <label for="">Koordinat</label>
            <input class="form-control" name="koordinat" id="Longitude" placeholder="lat,lng" required value="<?=$sosialisasi->koordinat ?>">
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
                <option <?php if ($sosialisasi->kabupaten =="Denpasar") {echo "selected";} ?> value="Denpasar">Denpasar</option>
                <option <?php if ($sosialisasi->kabupaten =="Badung") {echo "selected";} ?> value="Badung">Badung</option>
                <option <?php if ($sosialisasi->kabupaten =="Gianyar") {echo "selected";} ?> value="Gianyar">Gianyar</option>
                <option <?php if ($sosialisasi->kabupaten =="Klungkung") {echo "selected";} ?> value="Klungkung">Klungkung</option>
                <option <?php if ($sosialisasi->kabupaten =="Karangasem") {echo "selected";} ?> value="Karangasem">Karangasem</option>
                <option <?php if ($sosialisasi->kabupaten =="Bangli") {echo "selected";} ?> value="Bangli">Bangli</option>
                <option <?php if ($sosialisasi->kabupaten =="Buleleng") {echo "selected";} ?> value="Buleleng">Buleleng</option>
                <option <?php if ($sosialisasi->kabupaten =="Tabanan") {echo "selected";} ?> value="Tabanan">Tabanan</option>
                <option <?php if ($sosialisasi->kabupaten =="Jembrana") {echo "selected";} ?> value="Jembrana">Jembrana</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Detail Lokasi</label>
            <input class="form-control" name="detail_lokasi" placeholder="Detail Lokasi" value="<?=$sosialisasi->detail_lokasi ?>">
        </div>
        <div class="form-group">
            <label for="">Jenis Lokasi</label>
            <select class="form-control" name="jenis_lokasi" id="cars" required >
            <option disabled selected value="">Pilih</option>
                <option <?php if ($sosialisasi->jenis_lokasi =="Sekolah") {echo "selected";} ?> value="Sekolah">Sekolah</option>
                <option <?php if ($sosialisasi->jenis_lokasi =="Kantor Pemerintah") {echo "selected";} ?> value="Kantor Pemerintah">Kantor Pemerintah</option>
                <option <?php if ($sosialisasi->jenis_lokasi =="Kantor Swasta") {echo "selected";} ?> value="Kantor Swasta">Kantor Swasta</option>
                <option <?php if ($sosialisasi->jenis_lokasi =="Lain lain") {echo "selected";} ?> value="Lain lain">Lain lain</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-warning">Riset</button>
        </div>
        <?php echo form_close()?>
        <div class="form-group">
            
            <a href="<?=base_url('sosialisasi/')?>"><button class="btn btn-danger">Kembali</button></a>
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
    center: [<?=$sosialisasi->koordinat?>],
    zoom: 10,
    layers: [googleStreets]
});

const baseLayers = {
    'Satelite': googleSat,
    'Street': googleStreets,
    'Open Street map': peta3,
};;

const layerControl = L.control.layers(baseLayers).addTo(map);




// get koordinat
// var latInput = document.querySelector("[name=latitude]");
// var lngInput = document.querySelector("[name=longitude]");
var btn_check = document.querySelector("[name=btn-check]");
var koordinat = document.querySelector("[name=koordinat]");


var curLocation = [<?=$sosialisasi->koordinat?>];
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




//cetak Laporan
$(document).on("click", "[data-column]", function() {

var button = $(this),
    header = $(button.data("column")),
    table = header.closest("table"),
    index = header.index() + 1, // convert to CSS's 1-based indexing
    selector = "tbody tr td:nth-child(" + index + ")",
    column = table.find(selector).add(header);



column.toggleClass("hidden");

const doc = new jspdf.jsPDF('landscape');

// It can parse html:
// <table id="my-table"><!-- ... --></table>
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = dd + '/' + mm + '/' + yyyy;
var text = "Laporan Seismometer " + today
doc.text(text, 12, 10)
doc.autoTable({
    html: '#dataTables-example'
})

doc.save('seismo_'+today+'.pdf')
column.toggleClass("hidden");
});
</script>