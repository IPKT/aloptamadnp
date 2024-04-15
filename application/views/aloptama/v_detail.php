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
                    <td>Kode</td>
                    <td>:</td>
                    <td><?=$aloptama->kode?></td>
                </tr>
                <tr>
                    <td>Tipe</td>
                    <td>:</td>
                    <td><?=$aloptama->tipe?></td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td>:</td>
                    <td><?=$aloptama->lokasi?></td>
                </tr>
                <tr>
                    <td>Detail Lokasi</td>
                    <td>:</td>
                    <td><?=$aloptama->detail_lokasi?></td>
                </tr>
                <tr>
                    <td>Koordinat</td>
                    <td>:</td>
                    <td><?=$aloptama->koordinat?></td>
                </tr>
                <tr>
                    <td>Nama PIC</td>
                    <td>:</td>
                    <td><?=$aloptama->nama_pic?></td>
                </tr>
                <tr>
                    <td>Jabatan PIC</td>
                    <td>:</td>
                    <td><?=$aloptama->jabatan_pic?></td>
                </tr>
                <tr>
                    <td>Kontak PIC</td>
                    <td>:</td>
                    <td><?=$aloptama->kontak_pic?></td>
                </tr>
                <tr>
                    <td>Catatan Teknisi</td>
                    <td>:</td>
                    <td><?php 
                if ($aloptama->catatan != NULL and $aloptama->catatan != "" ) {
                  # code...
                  $catatan = str_replace("\n", '<br />', $aloptama->catatan);
                  echo $catatan;
                };
                if ($aloptama->catatan == "") {
                  # code...
                };?></td>
                </tr>
            </tbody>
        </table>

        <a href="<?=base_url('aloptama')?>"><button class="btn btn-success">Home</button></a>
        <a class='btn btn-warning <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>'
            href='<?=base_url('aloptama/edit/'.$jenis_aloptama.'/'.$aloptama->id) ?>'>
            Edit</a>
    </div>


</div>
<div class="table-responsive m-3">
    <h2>List Kunjungan</h2>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Jenis</th>
                <th>Kondisi</th>
                <th>Tanggal</th>
                <th>Kerusakan</th>
                <th>Rekomendasi</th>
                <th>Pelaksana</th>
                <th>Text WA</th>
                <th>Catatan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
        $CI =& get_instance();
        $CI->load->model('m_aloptama');
        $kunjungan = $CI->m_aloptama->kunjungan_site_tertentu($jenis_aloptama,$aloptama->kode); 
        foreach($kunjungan as $key => $value){?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$value->kode?></td>
                <td><?=$value->jenis?></td>
                <td><?=$value->kondisi?></td>
                <td><?php
                 $newDate = date("d-m-Y", strtotime($value->tanggal));  
                 echo $newDate;
                ?></td>
                <td><?=$value->kerusakan?></td>
                <td><?php $reko = str_replace("\n", '<br />', $value->rekomendasi);
                    echo $reko;?>

                </td>
                <td><?php $pelaksana = str_replace("\n", '<br />', $value->pelaksana);
                    echo $pelaksana;?></td>
                <td><textarea class="form-control textAreaMultiline" name="text_wa" rows="8" placeholder="" cols="50"
                        disabled><?=$value->text_wa?></textarea></td>
                <td><?php if ($value->catatan_kunjungan != NULL) {
                            $catatan = str_replace("\n", '<br />', $value->catatan_kunjungan);
                            echo $catatan;
                        }?></td>
                <td style="white-space: nowrap;">
                    <a class='btn btn-xs btn-success'
                        href='<?=base_url('aloptama/detail_kunjungan/'.$jenis_aloptama.'/'.$value->id_kunjungan) ?>'>
                        Detail</a>
                    <a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') != 1 and $this->session->userdata('id_user') != $value->id_author )  {echo 'hidden';}?>'
                        href='<?=base_url('aloptama/edit_kunjungan/'.$jenis_aloptama.'/'.$value->id_kunjungan) ?>'>
                        Edit</a>
                    <a class='btn btn-xs btn-danger <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>'
                        onclick="del('<?=base_url('aloptama/delete_kunjungan/'.$value->id_kunjungan) ?>' , '<?=$value->kode?>')">
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

function del(url, kode) {
    if (confirm("yakin ingin menghapus kunjungan site " + kode)) {
        window.location.assign(url);
    }
}
</script>