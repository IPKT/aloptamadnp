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
            echo '  <a class="btn btn-xs btn-success" href="'.base_url('wrs/list_kunjungan"').'>Lihat Data</a> </div>';
        }
        
        ?>
        <div class="form-group hidden">
            <button type="" class="btn btn-success" name="btn-check">Cek Lokasi</button>
        </div>
        <?php echo form_open_multipart('wrs/input_data_kunjungan')?>
        <div class="form-group">
            <label for="">Kode</label>
            <select class="form-control" name="id_wrs" id="cars">
                <option disabled selected value="">Pilih Site</option>
                <?php foreach($site as $key => $value){?>
                <option value="<?=$value->id_wrs?>:<?=$value->koordinat?>"><?=$value->lokasi?></option>
                <?php }?>
            </select>
        </div>

        <div class="form-group">
            <label for="">Jenis Kunjungan</label>
            <select class="form-control" name="jenis" id="">
                <option value="PM">PM</option>
                <option value="CM">CM</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Tanggal Kunjungan</label>
            <input class="form-control" type="date" name="tanggal" required >
        </div>
        <div class="form-group">
            <label for="">Pelaksana (Singkat)</label>
            <textarea class="form-control textAreaMultiline" name="pelaksana" rows="3" placeholder="1. Nama \n2. Nama"
                required></textarea>
        </div>
        <div class="form-group">
            <label for="">Kondisi Akhir</label>
            <select class="form-control" name="kondisi" id="">
                <option value="ON">ON</option>
                <option value="ON Perlu Penanganan">ON Perlu Penanganan</option>
                <option value="OFF">OFF</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Kerusakan</label>
            <textarea class="form-control textAreaMultiline" name="kerusakan" rows="3"
                placeholder="UPS, Stabilizer , ..."></textarea>
        </div>
        <div class="form-group">
            <label for="">Rekomendasi</label>
            <textarea class="form-control textAreaMultiline" name="rekomendasi" rows="3"
                placeholder="1. \n2. "></textarea>
        </div>
        <div class="form-group">
            <label for="">Text WA</label>
            <textarea class="form-control textAreaMultiline" name="text_wa" rows="3" placeholder=""></textarea>
        </div>

        <div class="form-group">
            <label for="">Dokumentasi Foto Bersama (optional)</label>
            <input class="form-control" name="gambar" type="file" accept="image/*">
        </div>
        <div class="form-group">
            <label for="">File Laporan (PDF)</label>
            <input class="form-control" name="laporan" type="file" required
                accept="application/pdf,application/vnd.ms-word">
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
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-danger">Riset</button>
        </div>


        <?php echo form_close()?>



    </div>

</div>



<script>
var latlong;
document.getElementById('cars').addEventListener('change', function() {
    var dat = this.value;
    console.log('You selected: ', dat);
    const ar = dat.split(":");
    latlong = ar[1].split(", ");
    console.log(latlong[0]);
    var lat = latlong[0];
    var lng = latlong[1];

    // var lat_lng = koordinat.value;
    // console.log(lat);


    if (!marker) {
        marker = L.marker([lat, lng]).addTo(map);
    } else {
        marker.setLatLng([lat, lng]);
    }
    map.panTo(new L.LatLng(lat, lng));
    map.setView([lat, lng], 10);
});
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
var center_map_lat = -8.34656224716775;
var center_map_lng = 115.16081838649232;

const map = L.map('map', {
    center: [center_map_lat, center_map_lng],
    zoom: 10,
    layers: [peta3]
});

const baseLayers = {
    'Default': peta1,
    'Satelite': peta2,
    'Street': peta3,
    'Dark': peta4,
};

const layerControl = L.control.layers(baseLayers).addTo(map);


// get koordinat
// var latInput = document.querySelector("[name=latitude]");
// var lngInput = document.querySelector("[name=longitude]");
var btn_check = document.querySelector("[name=btn-check]");
var koordinat = document.querySelector("[name=koordinat]");


var curLocation = [center_map_lat, center_map_lng];
map.attributionControl.setPrefix(false);
var marker = new L.marker(curLocation, {
    draggable: false,
});

// marker.on('dragend', function(e) {
//     var position = marker.getLatLng();
//     marker.setLatLng(position, {
//         curLocation
//     }).bindPopup(position).update();
//     // $("#Latitude").val(position.lng);
//     // $("#Longitude").val(position.lng);
//     koordinat.value = position.lat + ", " + position.lng;
// });

// map.on("click", function(e) {
//     var lat = e.latlng.lat;
//     var lng = e.latlng.lng;
//     if (!marker) {
//         marker = L.marker(e.latlng).addTo(map);
//     } else {
//         marker.setLatLng(e.latlng);
//     }
//     koordinat.value = lat + ", " + lng;
//     // lngInput.value = lng;

// });

btn_check.onclick = function(e) {
    //var lat = latInput.value;
    //var lng = lngInput.value;


    // var e = document.getElementById("cars");
    // var value = e.value;
    // var text = e.options[e.selectedIndex].text;

    // console.log(text);
    // var lat_lng1 = koordinat.value;
    // var lat_lng = lat_lng1.split(", ");

    // var lat = lat_lng[0];
    // var lng = lat_lng[1];
    var lat = latlong[0];
    var lng = latlong[1];

    // var lat_lng = koordinat.value;
    // console.log(lat);


    if (!marker) {
        marker = L.marker([lat, lng]).addTo(map);
    } else {
        marker.setLatLng([lat, lng]);
    }
    map.panTo(new L.LatLng(lat, lng));
    map.setView([lat, lng], 10);



};
map.addLayer(marker);


//Setting Text Area
var textAreas = document.getElementsByTagName('textarea');
Array.prototype.forEach.call(textAreas, function(elem) {
    elem.placeholder = elem.placeholder.replace(/\\n/g, '\n');
});
</script>