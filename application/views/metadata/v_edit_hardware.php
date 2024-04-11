<?php 
    $CI =& get_instance();
    $CI->load->model('m_aloptama');
    $jenis_aloptama = $hardware->jenis_aloptama;
    $aloptama = $CI->m_metadata->ambil_aja("SELECT * FROM tbl_$jenis_aloptama WHERE kode = '$kode' ");
    $koordinat = '';
    $id_aloptama = 0;
    foreach($aloptama as $key => $aloptama){
        $koordinat = $aloptama->koordinat;
        $id_aloptama = $aloptama->id;
    }

?>


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
            echo '  <a class="btn btn-xs btn-success" href="'.base_url('intensity"').'>Lihat Data</a> </div>';
        }
        
        ?>
        <?php echo form_open_multipart("metadata/update_hardware/$hardware->id/$kode")?>
        <div class="form-group hidden">
            <label for="">id_hardware</label>
            <input  class="form-control" name="id" placeholder=""
                value="<?=$hardware->id?>">
        </div>
        <div class="form-group hidden">
            <label for="">ID Aloptama</label>
            <input  class="form-control" name="id_aloptama" placeholder=""
                value="<?=$id_aloptama?>">
        </div>
        <div class="form-group">
            <label for="">Kode Aloptama</label>
            <input disabled class="form-control" name="" placeholder=""
                value="<?=$kode?>">
        </div>

        <div class="form-group">
            <label for="">Jenis Hardware</label>
            <select class="form-control" name="jenis_hardware" id="">
                <option selected value="<?=$hardware->jenis_hardware?>"><?=$hardware->jenis_hardware?></option>
                <?php if ($hardware->jenis_aloptama == 'intensity'):?>
                <option value="Modem GSM">Modem GSM</option>
                <option value="Sensor">Sensor</option>
                <option value="Cube">Cube</option>
                <option value="Stabilizer">Stabilizer</option>
                <option value="UPS">UPS</option>
                <option value="Hub Switch">Hub Switch</option>
                <option value="Terminal Arrester">Terminal Arrester</option>
                <option value="Adaptor Cube">Adaptor Cube</option>
                <option value="LAN Arrester">LAN Arrester</option>
                <option value="Antenna Outdoor">Antenna Outdoor</option>
                <?php endif ?>
                <?php if ($hardware->jenis_aloptama == 'seismo'):?>
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
            <input class="form-control" name="merk" id="" placeholder="" value="<?=$hardware->merk?>" required>
        </div>
        <div class="form-group">
            <label for="">Tipe</label>
            <input class="form-control" name="tipe" id="" placeholder="" value="<?=$hardware->tipe?>" required>
        </div>
        <div class="form-group">
            <label for="">Serial Number</label>
            <input class="form-control" name="sn" id="" value="<?=$hardware->sn?>" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Tanggal Pemasangan</label>
            <input class="form-control" type="date" value="<?=$hardware->tanggal_pemasangan?>" name="tanggal_pemasangan">
        </div>
        <div class="form-group">
            <label for="">Sumber Pengadaan</label>
            <select class="form-control" name="sumber" id="">
                <option disabled selected value="<?=$hardware->sumber?>"><?=$hardware->sumber?></option>
                <option selected value="PSGT">PSGT</option>
                <option value="Stageof Denpasar">Stageof Denpasar</option>
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
    center: [<?=$koordinat?>],
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

var curLocation = [<?=$koordinat?>];
map.attributionControl.setPrefix(false);
var marker = new L.marker(curLocation, {
    draggable: false,
});


map.addLayer(marker);



//Setting Text Area
var textAreas = document.getElementsByTagName('textarea');
Array.prototype.forEach.call(textAreas, function(elem) {
    elem.placeholder = elem.placeholder.replace(/\\n/g, '\n');
});
</script>