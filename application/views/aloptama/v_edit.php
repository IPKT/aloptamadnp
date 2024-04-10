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

        <?php echo form_open_multipart('aloptama/update_data/'.$jenis_aloptama.'/'.$aloptama->id)?>
        <div class="form-group">
            <label for="">Kode</label>
            <input disabled class="form-control" name="" placeholder="" value="<?=$aloptama->kode?>">
        </div>
        <div class="form-group" hidden>
            <label for="">id Aloptama</label>
            <input class="form-control" name="id" placeholder="Nama Lokasi" value="<?=$aloptama->id?>" required>
        </div>
        <div class="form-group hidden">
            <label for="">Kode</label>
            <input class="form-control" name="kode" placeholder="Nama Site" required value="<?=$aloptama->kode?>">
        </div>
        <div class="form-group">
            <label for="">Koordinat</label>
            <input class="form-control" name="koordinat" id="Longitude" placeholder="lat,lng" required
                value="<?=$aloptama->koordinat?>">
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
            <label for="">Lokasi</label>
            <input class="form-control" name="lokasi" placeholder="Lokasi" required value="<?=$aloptama->lokasi?>">
        </div>
        <div class="form-group">
            <label for="">Detail Lokasi</label>
            <input class="form-control" name="detail_lokasi" placeholder="Detail Lokasi"
                value="<?=$aloptama->detail_lokasi?>">
        </div>
        <div class="form-group">
            <label for="">Tipe</label>
            <select class="form-control" name="tipe" id="cars">
                <!-- Untuk Intensity -->
                <?php if ($jenis_aloptama == 'intensity'):?>
                <option <?php if ($aloptama->tipe =="P-alert") {
                    echo "selected";
                }?> value="P-alert">P-alert</option>
                <option <?php if ($aloptama->tipe =="Reis") {
                    echo "selected";
                }?> value="Reis">Reis</option>
                <?php endif ?>

                <!-- Untuk Seismo -->
                <?php if ($jenis_aloptama == 'seismo'):?>
                <option <?php if ($aloptama->tipe =="Type B") {
                    echo "selected";
                }?> value="Type B">Type B</option>
                <option <?php if ($aloptama->tipe =="Libra") {
                    echo "selected";
                }?> value="Libra">Libra</option>
                <option <?php if ($aloptama->tipe =="Minireg") {
                    echo "selected";
                }?> value="Minireg">Minireg</option>
                <option <?php if ($aloptama->tipe =="Reis") {
                    echo "selected";
                }?> value="Minireg">Reis</option>
                <option <?php if ($aloptama->tipe =="CEA") {
                    echo "selected";
                }?> value="Minireg">CEA</option>
                <option <?php if ($aloptama->tipe =="BB 2021") {
                    echo "selected";
                }?> value="BB 2021">BB 2021</option>
                <?php endif ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Nama PIC</label>
            <input class="form-control" name="nama_pic" placeholder="Nama PIC" value="<?=$aloptama->nama_pic?>">
        </div>
        <div class="form-group">
            <label for="">Jabatan PIC</label>
            <input class="form-control" name="jabatan_pic" placeholder="Jabatan PIC"
                value="<?=$aloptama->jabatan_pic?>">
        </div>
        <div class="form-group">
            <label for="">Kontak PIC</label>
            <input class="form-control" name="kontak_pic" placeholder="Masukan No HP"
                value="<?=$aloptama->kontak_pic?>">
        </div>
        <div class="form-group">
            <label for="">Catatan Teknisi</label>
            <textarea class="form-control textAreaMultiline" name="catatan" rows="3"
                placeholder="1. \n2. "><?=$aloptama->catatan?></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        <?php echo form_close()?>
        <div class="form-group">
            <button type="" class="btn btn-success" name="btn-check">Cek Lokasi</button>
            <a href="<?=base_url('aloptama/')?>"><button class="btn btn-danger">Home</button></a>
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
var center_map_lat = -8.34656224716775;
var center_map_lng = 115.16081838649232;
const map = L.map('map', {
    center: [<?=$aloptama->koordinat?>],
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


var curLocation = [<?=$aloptama->koordinat?>];
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