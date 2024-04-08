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
        
        $CI =& get_instance();
        $CI->load->model('m_wrs');
        $wrs = $CI->m_wrs->detail_wrs($kunjungan->id_wrs)
        ?>
        <div class="form-group hidden">
            <button type="" class="btn btn-success" name="btn-check">Cek Lokasi</button>
        </div>
        <?php echo form_open_multipart('wrs/update_data_kunjungan')?>
        <div class="form-group" hidden>
            <label for="">Kode</label>
            <select class="form-control" name="" id="cars">
                <?php foreach($site as $key => $value){?>
                <option value="<?=$value->id_wrs?>:<?=$value->koordinat?>"><?=$value->kode?></option>
                <?php }?>
            </select>
        </div>
        <div class="form-group" hidden>
            <label for="">ID_Kunjungan</label>
            <input class="form-control" name="id_kunjungan" placeholder="" required
                value="<?=$kunjungan->id_kunjungan?>">
        </div>
        <div class="form-group" hidden>
            <label for="">ID_wrs</label>
            <input class="form-control" name="id_wrs" placeholder="" required value="<?=$wrs->id_wrs?>">
        </div>
        <div class="form-group">
            <label for="">Kode</label>
            <input class="form-control" name="kode" placeholder="" required value="<?=$wrs->lokasi?>">
        </div>
        <div class="form-group">
            <label for="">Jenis Kunjungan</label>
            <select class="form-control" name="jenis" id="">
                <option <?php if ($kunjungan->jenis =="PM"){echo"selected";}?> value="PM">PM</option>
                <option <?php if ($kunjungan->jenis =="CM"){echo"selected";}?> value="CM">CM</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Tanggal Kunjungan</label>
            <input class="form-control" type="date" name="tanggal" required value="<?=$kunjungan->tanggal?>">
        </div>
        <div class="form-group">
            <label for="">Pelaksana (Singkat)</label>
            <textarea class="form-control textAreaMultiline" name="pelaksana" rows="3" placeholder="1. Nama \n2. Nama"
                required value=""><?=$kunjungan->pelaksana?></textarea>
        </div>
        <div class="form-group">
            <label for="">Kondisi Akhir</label>
            <select class="form-control" name="kondisi" id="">
                <option <?php if ($kunjungan->kondisi =="ON"){echo"selected";}?> value="ON">ON</option>
                <option <?php if ($kunjungan->kondisi =="ON Perlu Penanganan"){echo"selected";}?>
                    value="ON Perlu Penanganan">ON Perlu Penanganan</option>
                <option <?php if ($kunjungan->kondisi =="OFF"){echo"selected";}?> value="OFF">OFF</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Kerusakan</label>
            <textarea class="form-control textAreaMultiline" name="kerusakan" rows="3"
                placeholder="UPS, Stabilizer , ..."><?=$kunjungan->kerusakan?></textarea>
        </div>
        <div class="form-group">
            <label for="">Rekomendasi</label>
            <textarea class="form-control textAreaMultiline" name="rekomendasi" rows="3"
                placeholder="1. \n2. "><?=$kunjungan->rekomendasi?></textarea>
        </div>
        <div class="form-group">
            <label for="">Text WA</label>
            <textarea class="form-control textAreaMultiline" name="text_wa" rows="3"
                placeholder=""><?=$kunjungan->text_wa?></textarea>
        </div>

        <div class="form-group">
            <label for="">Dokumentasi (Foto Bersama)</label>
            <input class="form-control" name="gambar" type="file" accept="image/*">
        </div>
        <div class="form-group">
            <label for="">File Laporan (PDF or WORD)</label>
            <input class="form-control" name="laporan" type="file" accept="application/pdf,application/vnd.ms-word">
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
            <button type="submit" class="btn btn-primary">Update</button>

        </div>


        <?php echo form_close()?>
        <a href="<?=base_url('wrs/list_kunjungan')?>"><button class="btn btn-success">Kembali</button></a>



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
    center: [<?php echo $wrs->koordinat?>],
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


var curLocation = [<?php echo $wrs->koordinat?>];
map.attributionControl.setPrefix(false);
var marker = new L.marker(curLocation, {
    draggable: 'true',
}).bindTooltip("<?=$wrs->lokasi?>", {
    permanent: true,
    direction: 'right'
});
map.addLayer(marker);


//Setting Text Area
var textAreas = document.getElementsByTagName('textarea');
Array.prototype.forEach.call(textAreas, function(elem) {
    elem.placeholder = elem.placeholder.replace(/\\n/g, '\n');
});
</script>