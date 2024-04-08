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
            echo '</div>';
        }
        
        ?>
        <?php echo form_open_multipart("metadata/input/$jenis_aloptama")?>
        <div class="form-group">
            <label for="">Kode</label>
            <select class="form-control" name="id_aloptama" id="cars">
                <option disabled selected value="">Pilih Site</option>
                <?php foreach($aloptama as $key => $value){?>
                <option value="<?=$value->id?>:<?=$value->koordinat?>"><?=$value->kode?></option>
                <?php }?>
            </select>
        </div>

        <div class="form-group">
            <label for="">Jenis Hardware</label>
            <select class="form-control" name="jenis_hardware" id="">
                <option disabled selected value="">Pilih Jenis Hardware</option>
                <?php if ($jenis_aloptama == 'intensity'):?>
                <option value="Modem GSM">Modem GSM</option>
                <option value="Sensor">Sensor</option>
                <option value="Cube">Cube</option>
                <option value="Stabilizer">Stabilizer</option>
                <option value="UPS">UPS</option>
                <option value="Hub Switch">Hub Switch</option>
                <option value="Terminal Arrester">Terminal Arrester</option>
                <option value="Adaptor Cube">Adaptor Cube</option>
                <?php endif ?>
                <?php if ($jenis_aloptama == 'seismo'):?>
                <option value="Modem GSM">Modem VSAT</option>
                <option value="Sensor">Sensor</option>
                <option value="Cube">Digitizer</option>
                <option value="Stabilizer">Stabiilizer</option>
                <option value="UPS">Baterai</option>
                <?php endif ?>
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
            <label for="">Tanggal Pemasangan</label>
            <input class="form-control" type="date" name="tanggal_pemasangan">
        </div>
        <div class="form-group">
            <label for="">Sumber Pengadaan</label>
            <select class="form-control" name="sumber" id="">
                <?php if ($jenis_aloptama == 'intensity'):?>
                <option selected value="PSGT">PSGT</option>
                <option value="Stageof Denpasar">Stageof Denpasar</option>
                <?php endif ?>
                <?php if ($jenis_aloptama == 'seismo'):?>
                <option selected value="Pusat">Pusat</option>
                <option value="Balai 3">Balai 3</option>
                <?php endif ?>
            </select>
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


map.addLayer(marker);


//Setting Text Area
var textAreas = document.getElementsByTagName('textarea');
Array.prototype.forEach.call(textAreas, function(elem) {
    elem.placeholder = elem.placeholder.replace(/\\n/g, '\n');
});
</script>