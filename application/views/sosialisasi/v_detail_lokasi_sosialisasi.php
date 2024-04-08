<div class="row">
    <div class="col-sm-7">
        <div id="map" style="width: 100%; height: 600px;"></div>
    </div>
    <div class="col-sm-5">
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
        <table class="table table-striped table-hover">
            <tbody>
                <tr>
                    <td>Lokasi</td>
                    <td>:</td>
                    <td><?=$sosialisasi->nama_lokasi?></td>
                </tr>
                <tr>
                    <td>Kabupaten</td>
                    <td>:</td>
                    <td><?=$sosialisasi->kabupaten?></td>
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
            </tbody>
        </table>

        <a href="<?=base_url('sosialisasi')?>"><button class="btn btn-success">Pemetaan</button></a>
        <a href="<?=base_url('sosialisasi/input_page_kunjungan/').$sosialisasi->id_lokasi?>"><button class="btn btn-warning">Input Kunjungan</button></a>
    </div>


</div>
<div class="table-responsive m-3">
    <h2>List Kunjungan</h2>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lokasi</th>
                <th>Jenis Kegiatan</th>
                <th>Tanggal</th>
                <th>Jumlah Peserta</th>
                <th>Pelaksana</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
        $CI =& get_instance();
        $CI->load->model('m_sosialisasi');
        $kunjungan = $CI->m_sosialisasi->kunjungan_site_tertentu($sosialisasi->nama_lokasi); 
        foreach($kunjungan as $key => $value){?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$value->nama_lokasi?></td>
                <td><?=$value->jenis_kegiatan?></td>
                <td><?=$value->tanggal?></td>
                <td><?=$value->jumlah_peserta?></td>
                <td><?php $pelaksana = str_replace("\n", '<br />', $value->pelaksana);
                    echo $pelaksana;?></td>
                <td>
                    <a class='btn btn-xs btn-success'
                        href='<?=base_url('sosialisasi/detail_kunjungan/'.$value->id_kunjungan) ?>'>
                        Detail</a>
                    <a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') != 1 and $this->session->userdata('id_user') != $value->id_author )  {echo 'hidden';}?>'
                        href='<?=base_url('sosialisasi/edit_kunjungan/'.$value->id_kunjungan) ?>'>
                        Edit</a>
                    <a class='btn btn-xs btn-danger <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>'
                        onclick="del('<?=base_url('sosialisasi/delete_kunjungan/'.$value->id_kunjungan) ?>' , '<?=$value->nama_lokasi?>')">
                        Delete</a>
                </td>
            </tr>
            <?php }?>
        </tbody>

    </table>
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

}).bindTooltip("<h7><b><?php
    $jml = $CI->m_sosialisasi->ambil_jumlah_kunjungan($sosialisasi->id_lokasi);       
    echo $sosialisasi->nama_lokasi.' ('.$jml.')';?></h7></b>", {
    permanent: true,
    direction: 'right'
});

map.addLayer(marker);
function del(url, kode) {
    if (confirm("yakin ingin menghapus kunjungan site " + kode)) {
        window.location.assign(url);
    }
}
</script>