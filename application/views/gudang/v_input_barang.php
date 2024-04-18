<div class="row">
    <!-- <div class="col-sm-8">
        <div id="map" style="width: 100%; height: 600px;"></div>
    </div> -->
    <div class="col-sm-12">
        <?php 
        //notifikasi pesan validasi
        echo validation_errors('<div class="alert alert-danger">','</div>');
        
        //notifikasi pesan data berhasil disimpan
        if ($this->session->flashdata('pesan')) {
            # code...
            echo '<div class="alert alert-success">';
            echo $this->session->flashdata('pesan');
            echo '  <a class="btn btn-xs btn-success" href="'.base_url('gudang/"').'>Lihat Data</a> </div>';
        }
        
        ?>
        <?php echo form_open_multipart("gudang/input/")?>

        <div class="form-group">
            <label for="" onclick="hideStyle('jenis_barang')">Jenis Barang</label>
            <select class="form-control" name="jenis_barang" id="jenis_barang" onchange="toggleInput('jenis_barang')">
                <option disabled selected value="">Pilih Jenis Hardware</option>
                <option value="Modem GSM">Modem GSM</option>
                <option value="Sensor">Sensor</option>
                <option value="Cube">Cube</option>
                <option value="Stabilizer">Stabilizer</option>
                <option value="UPS">UPS</option>
                <option value="Hub Switch">Hub Switch</option>
                <option value="Terminal Arrester">Terminal Arrester</option>
                <option value="Adaptor Cube">Adaptor Cube</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <input name="jenis_barang_lainnya" class="form-control" type="text" id="jenis_barang_lainnya"
                style="display: none;" placeholder="Masukkan opsi lainnya">
        </div>
        <div class="form-group">
            <label for="">Jenis Aloptama</label>
            <select class="form-control" name="jenis_aloptama" id="">
                <option disabled selected value="">Pilih Jenis Aloptama</option>
                <option value="Intensity Realshake">Intensity Realshake</option>
                <option value="Intensity Reis">Intensity Reis</option>
                <option value="WRS">WRS</option>
                <option value="Seismo">Seismo</option>
                <option value="Accelero">Accelero</option>
                <option value="Peralatan Kantor">Peralatan Kantor</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Merk</label>
            <input class="form-control" name="merk" id="" placeholder="" required>
        </div>
        <div class="form-group">
            <label for="">Tipe</label>
            <input class="form-control" name="tipe" id="" placeholder="" required>
        </div>
        <div class="form-group">
            <label for="">Serial Number</label>
            <input class="form-control" name="sn" id="" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Tanggal Perolehan</label>
            <input class="form-control" type="date" name="tanggal_masuk">
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <select class="form-control" name="kondisi" id="">
                <option selected value="Baru">Barang Baru</option>
                <option value="Bekas">Barang Bekas</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Sumber Pengadaan</label>
            <select class="form-control" name="sumber" id="">
                <option selected value="Stageof Denpasar">Stageof Denpasar</option>
                <option value="PSGT">PSGT</option>
                <option value="Pusinskal">Pusinskal</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Catatan</label>
            <input class="form-control" name="catatan_masuk" id="" placeholder="">
        </div>
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
    draggable: true,
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



function toggleInput(jenis) {
    var id_lainnya = jenis + "_lainnya";
    var selectBox = document.getElementById(jenis);
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var lainnyaInput = document.getElementById(id_lainnya);

    if (selectedValue === "lainnya") {
        lainnyaInput.style.display = "block";
        lainnyaInput.name = jenis;
        selectBox.style.display = "none";
    } else {
        lainnyaInput.style.display = "none";
        lainnyaInput.name = id_lainnya;
    }
}

function hideStyle(jenis) {
    var selectBox = document.getElementById(jenis);
    selectBox.style.display = "block";
    selectBox.selectedIndex = 0;
    var id_lainnya = jenis + "_lainnya";
    var lainnyaInput = document.getElementById(id_lainnya);
    lainnyaInput.style.display = "none";
    lainnyaInput.name = id_lainnya;
}
</script>