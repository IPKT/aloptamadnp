<div class="row">
    <div class="col-sm-8" style="margin-bottom: 20px;">
        <div id="map" style="width: 100%; height: 600px;"></div>
    </div>
    <div class="col-sm-4" style="margin-bottom: 20px;">
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
        $CI->load->model('m_sosialisasi');
        $sosialisasi = $CI->m_sosialisasi->detail_sosialisasi($kunjungan->id_lokasi)
        ?>
        <table class="table table-striped table-hover">
            <tbody>
                <tr>
                    <td>Lokasi kunjungan</td>
                    <td>:</td>
                    <td><?=$sosialisasi->nama_lokasi?></td>
                </tr>
                <tr>
                    <td>Detail Lokasi</td>
                    <td>:</td>
                    <td><?=$sosialisasi->detail_lokasi?></td>
                </tr>
                <tr>
                    <td>Koordinat</td>
                    <td>:</td>
                    <td><?=$sosialisasi->koordinat?></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><?=$kunjungan->tanggal?></td>
                </tr>
                <tr>
                    <td>Jumlah Peserta</td>
                    <td>:</td>
                    <td><?=$kunjungan->jumlah_peserta?></td>
                </tr>
                <tr>
                    <td>Jenis Kegiatan</td>
                    <td>:</td>
                    <td><?=$kunjungan->jenis_kegiatan?></td>
                </tr>
                <tr>
                    <td>Catatan</td>
                    <td>:</td>
                    <td>
                        <?php if ($kunjungan->catatan != NULL) {
                            $catatan = str_replace("\n", '<br />', $kunjungan->catatan);
                            echo $catatan;
                        } 
                        ?></td>
                </tr>
                <tr>
                    <td>Pelaksana</td>
                    <td>:</td>
                    <td><?php 
                    $pelaksana =str_replace("\r\n","<br>",$kunjungan->pelaksana);
                    echo $pelaksana;
                        ?></td>
                </tr>
                <tr>
                    <td>Petugas Input</td>
                    <td>:</td>
                    <td><?php 
                     $CI =& get_instance();
                     $CI->load->model('m_sosialisasi');
                     $author = $CI->m_sosialisasi->detail_user($kunjungan->id_author);
                     if (isset($author)) {
                        echo $author->name;
                     }
                     
                        ?></td>
                </tr>
                <tr>
                    <td>Dokumentasi</td>
                    <td>:</td>
                    <td><img src="<?=base_url('kunjungan_sosialisasi/gambar/').$kunjungan->gambar?>" alt="" width=400px></td>
                </tr>
            </tbody>
        </table>


        <a href="<?=base_url('sosialisasi/list_kunjungan')?>"><button class="btn btn-success">Kembali</button></a>
    </div>
    <span></span> 
     
    <div class="col-sm-12">
        <iframe src="<?php if ($kunjungan->laporan != NULL) {
            echo base_url('kunjungan_sosialisasi/laporan/').$kunjungan->laporan;
        } ?>" height="500px" width="100%"
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
    center: [<?=$sosialisasi->koordinat?>],
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



var curLocation = [<?=$sosialisasi->koordinat?>];
map.attributionControl.setPrefix(false);
var marker = new L.marker(curLocation, {

});

map.addLayer(marker);
</script>