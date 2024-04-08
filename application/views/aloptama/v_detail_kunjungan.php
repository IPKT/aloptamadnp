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
        $CI->load->model('m_aloptama');
        if ($jenis_aloptama == 'intensity') {
            $aloptama = $CI->m_aloptama->detail_aloptama($jenis_aloptama, $kunjungan->id_intensity);
        } elseif ($jenis_aloptama =='seismo'){
            $aloptama = $CI->m_aloptama->detail_aloptama($jenis_aloptama, $kunjungan->id_seismo);
        }
        elseif ($jenis_aloptama =='wrs'){
            $aloptama = $CI->m_aloptama->detail_aloptama($jenis_aloptama, $kunjungan->id_wrs);
        }
        elseif ($jenis_aloptama =='acc_noncolo'){
            $aloptama = $CI->m_aloptama->detail_aloptama($jenis_aloptama, $kunjungan->id_acc_noncolo);
        }
        elseif ($jenis_aloptama =='int_reis'){
            $aloptama = $CI->m_aloptama->detail_aloptama($jenis_aloptama, $kunjungan->id_int_reis);
        }
        // $aloptama = $CI->m_aloptama->detail_aloptama($kunjungan->id_aloptama)
        ?>
        <table class="table table-striped table-hover">
            <tbody>
                <tr>
                    <td>Nama Lokasi</td>
                    <td>:</td>
                    <td><?=$aloptama->kode?></td>
                </tr>
                <tr>
                    <td>Detail Lokasi</td>
                    <td>:</td>
                    <td><?=$aloptama->lokasi?></td>
                </tr>
                <tr>
                    <td>Koordinat</td>
                    <td>:</td>
                    <td><?=$aloptama->koordinat?></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><?=$kunjungan->tanggal?></td>
                </tr>
                <tr>
                    <td>Jenis Kegiatan</td>
                    <td>:</td>
                    <td><?=$kunjungan->jenis?></td>
                </tr>
                <tr>
                    <td>Kerusakan</td>
                    <td>:</td>
                    <td><?=$kunjungan->kerusakan?></td>
                </tr>
                <tr>
                    <td>Rekomendasi</td>
                    <td>:</td>
                    <td>
                        <?php $reko = str_replace("\n", '<br />', $kunjungan->rekomendasi);
                    echo $reko;?></td>
                </tr>
                <tr>
                    <td>Catatan</td>
                    <td>:</td>
                    <td>
                        <?php if ($kunjungan->catatan_kunjungan != NULL) {
                            $catatan = str_replace("\n", '<br />', $kunjungan->catatan_kunjungan);
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
                     $CI->load->model('m_aloptama');
                     $author = $CI->m_aloptama->detail_user($kunjungan->id_author);
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
                disabled><?=$kunjungan->text_wa?></textarea>
        </div>


        <a href="<?=base_url("aloptama/detail_aloptama/$jenis_aloptama/$aloptama->id")?>"><button class="btn btn-success">Kembali</button></a>
    </div>
    <span></span>
    
    <div class="col-sm-12">
    <h4>LAPORAN 1</h4>
        <iframe src="<?=base_url("kunjungan_$jenis_aloptama/laporan/").$kunjungan->laporan?>" height="500px" width="100%"
            title="Iframe Example"></iframe>
    </div>

    <span></span>
    <?php if($kunjungan->laporan2 != NULL): ?>
    <div class="col-sm-12">
    <h4>LAPORAN 2</h4>
        <iframe src="<?=base_url("kunjungan_$jenis_aloptama/laporan/").$kunjungan->laporan2?>" height="500px" width="100%"
            title="Iframe Example"></iframe>
    </div>
    <?php endif ?> 



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



var curLocation = [<?=$aloptama->koordinat?>];
map.attributionControl.setPrefix(false);
var marker = new L.marker(curLocation, {

});

map.addLayer(marker);
</script>