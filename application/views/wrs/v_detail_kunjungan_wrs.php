<div class="row">
    <div class="col-sm-6" style="margin-bottom: 20px;">
        <div id="map" style="width: 100%; height: 600px;"></div>
    </div>
    <div class="col-sm-6" style="margin-bottom: 20px;">
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
        
        $CI =& get_instance();
        $CI->load->model('m_wrs');
        $wrs = $CI->m_wrs->detail_wrs($lokasi->id_wrs)
        ?>
        <table class="table table-striped table-hover">
            <tbody>
                <tr>
                    <td>Nama lokasi</td>
                    <td>:</td>
                    <td><?=$wrs->lokasi?></td>
                </tr>
                <tr>
                    <td>Detail Lokasi</td>
                    <td>:</td>
                    <td><?=$wrs->detail_lokasi?></td>
                </tr>
                <tr>
                    <td>Koordinat</td>
                    <td>:</td>
                    <td><?=$wrs->koordinat?></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><?=$lokasi->tanggal?></td>
                </tr>
                <tr>
                    <td>Jenis Kegiatan</td>
                    <td>:</td>
                    <td><?=$lokasi->jenis?></td>
                </tr>
                <tr>
                    <td>Kerusakan</td>
                    <td>:</td>
                    <td><?=$lokasi->kerusakan?></td>
                </tr>
                <tr>
                    <td>Rekomendasi</td>
                    <td>:</td>
                    <td>
                        <?php $reko = str_replace("\n", '<br />', $lokasi->rekomendasi);
                    echo $reko;?></td>
                </tr>
                <tr>
                    <td>Pelaksana</td>
                    <td>:</td>
                    <td><?php 
                    $pelaksana =str_replace("\r\n","<br>",$lokasi->pelaksana);
                    echo $pelaksana;
                        ?></td>
                </tr>
                <tr>
                    <td>Petugas Input</td>
                    <td>:</td>
                    <td><?php 
                     $CI =& get_instance();
                     $CI->load->model('m_wrs');
                     $author = $CI->m_wrs->detail_user($lokasi->id_author);
                     if (isset($author)) {
                        echo $author->name;
                     }
                     
                        ?></td>
                </tr>
            </tbody>
        </table>
        <div class="form-group">
            <label for="">Text WA</label>
            <textarea class="form-control textAreaMultiline" name="text_wa" rows="8" placeholder=""
                disabled><?=$lokasi->text_wa?></textarea>
        </div>

        <a href="<?=base_url('wrs/list_kunjungan')?>"><button class="btn btn-success">Kembali</button></a>
    </div>
    <span></span>
    <div class="col-sm-12">
        <iframe src="<?=base_url('kunjungan_wrs/laporan/').$lokasi->laporan?>" height="500px" width="100%"
            title="Iframe Example"></iframe>
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
    center: [<?=$wrs->koordinat?>],
    zoom: 9,
    layers: [peta3]
});

const baseLayers = {
    'Default': peta1,
    'Satelite': peta2,
    'Street': peta3,
    'Dark': peta4,
};

const layerControl = L.control.layers(baseLayers).addTo(map);



var curLocation = [<?=$wrs->koordinat?>];
map.attributionControl.setPrefix(false);
var marker = new L.marker(curLocation, {

});

map.addLayer(marker);
</script>