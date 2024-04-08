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
            echo '  <a class="btn btn-xs btn-success" href="'.base_url('sosialisasi/list_kunjungan"').'>Lihat Data</a> </div>';
        }
        
        $CI =& get_instance();
        $CI->load->model('m_sosialisasi');
        $sosialisasi = $CI->m_sosialisasi->detail_sosialisasi($kunjungan->id_lokasi)
        ?>
        <div class="form-group" hidden>
            <button type="" class="btn btn-success" name="btn-check">Cek Lokasi</button>
        </div>
        <?php echo form_open_multipart('sosialisasi/update_data_kunjungan')?>
        <div class="form-group" hidden>
            <label for="">ID_Kunjungan</label>
            <input class="form-control" name="id_kunjungan" placeholder="" required
                value="<?=$kunjungan->id_kunjungan?>">
        </div>
        <div class="form-group" hidden>
            <label for="">ID_lokasi Sosialisasi</label>
            <input class="form-control" name="id_lokasi" placeholder="" required value="<?=$sosialisasi->id_lokasi?>">
        </div>
        <div class="form-group">
            <label for="">Nama Lokasi</label>
            <input class="form-control" name="nama_lokasi" placeholder="" required value="<?=$sosialisasi->nama_lokasi?>">
        </div>                
        <div class="form-group">
            <label for="">Jenis Kunjungan</label>
            <select class="form-control" name="jenis_kegiatan" id="" required>
            <option disabled selected value="">Pilih</option>
            <option <?php if ($kunjungan->jenis_kegiatan =="SLG") {echo "selected";} ?> value="SLG">SLG</option>
                <option <?php if ($kunjungan->jenis_kegiatan =="BGTS PM") {echo "selected";} ?> value="BGTS PM">BGTS PM</option>
                <option <?php if ($kunjungan->jenis_kegiatan =="BGTS") {echo "selected";} ?> value="BGTS">BGTS</option>
                <option <?php if ($kunjungan->jenis_kegiatan =="Penyerahan Brosur") {echo "selected";} ?> value="Penyerahan Brosur">Penyerahan Brosur</option>
                <option <?php if ($kunjungan->jenis_kegiatan =="Penyerahan Peta") {echo "selected";} ?> value="Penyerahan Peta">Penyerahan Peta</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Tanggal Kunjungan</label>
            <input class="form-control" type="date" name="tanggal" value="<?=$kunjungan->tanggal ?>" required>
        </div>
        <div class="form-group">
            <label for="">Pelaksana (Singkat)</label>
            <textarea class="form-control textAreaMultiline" name="pelaksana" rows="3" placeholder="1. Nama \n2. Nama"
                ><?=$kunjungan->pelaksana ?></textarea>
        </div>
        <div class="form-group">
            <label for="">Jumlah Peserta</label>
           <input class="form-control" type="number" name="jumlah_peserta" value="<?=$kunjungan->jumlah_peserta ?>">
        </div>
        <div class="form-group">
            <label for="">Catatan</label>
            <input class="form-control" name="catatan" placeholder="Catatan" value="<?=$kunjungan->catatan ?>">
        </div>
        <div class="form-group">
            <label for="">Dokumentasi Foto Bersama</label>
            <input class="form-control" name="gambar" type="file" accept="image/*">
        </div>
        <div class="form-group">
            <label for="">File Laporan (PDF)</label>
            <input class="form-control" name="laporan" type="file"
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
            <button type="submit" class="btn btn-primary">Update</button>

        </div>


        <?php echo form_close()?>
        <a href="<?=base_url('sosialisasi/list_kunjungan')?>"><button class="btn btn-success">Kembali</button></a>



    </div>

</div>



<script>
var latlong;
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
    center: [<?=$sosialisasi->koordinat?>],
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


var curLocation = [<?=$sosialisasi->koordinat?>];
map.attributionControl.setPrefix(false);
var marker = new L.marker(curLocation, {
    draggable: 'false',
}).bindTooltip("<h7><b><?php
    $jml = $CI->m_sosialisasi->ambil_jumlah_kunjungan($sosialisasi->id_lokasi);       
    echo $sosialisasi->nama_lokasi.' ('.$jml.')';?></h7></b>", {
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