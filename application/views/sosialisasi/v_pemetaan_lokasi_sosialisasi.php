<?php 
if ($this->session->flashdata('pesan')) {
  # code...
  echo '<div class="alert alert-success">';
  echo $this->session->flashdata('pesan');
  echo '</div>';
}
?>
<div id="map" style="width: 100%; height: 700px;"></div>
<div class="table-responsive m-3">
    <h2>List Lokasi Sosialisasi</h2>
    <button class="btn btn-m btn-success hidden" type="button" data-column="#column_action">Cetak Laporan</button> <br> </br>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lokasi</th>
                <th>Kabupaten</th>
                <th>Detail Lokasi</th>
                <th>Jenis</th>
                <th>jumlah kunjungan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1;
        foreach($lokasi_sosialisasi as $key => $value){?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$value->nama_lokasi?></td>
                <td><?=$value->kabupaten?></td>
                <td><?=$value->detail_lokasi?></td>
                <td><?=$value->jenis_lokasi?></td>
                <td><?php 
                $CI =& get_instance();
                $CI->load->model('m_sosialisasi'); 
                $jml = $CI->m_sosialisasi->ambil_jumlah_kunjungan($value->id_lokasi);
                echo $jml;  ?></td>
                <td>
                    <a class='btn btn-xs btn-success'
                        href='<?=base_url('sosialisasi/detail_sosialisasi/'.$value->id_lokasi) ?>'>
                        Detail</a>
                    <a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') != 1 and $this->session->userdata('id_user') != $value->id_author )  {echo 'hidden';}?>'
                        href='<?=base_url('sosialisasi/edit/'.$value->id_lokasi) ?>'>
                        Edit</a>
                    <a class='btn btn-xs btn-danger hidden <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>'
                        onclick="del('<?=base_url('sosialisasi/delete/'.$value->id_lokasi) ?>' , '<?=$value->nama_lokasi?>')">
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

var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
});

var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
});
var greenIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [20, 30],
    iconAnchor: [10, 30],
    popupAnchor: [1, -34],
    shadowSize: [30, 30]
});

var redIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});
var blueIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [20, 30],
    iconAnchor: [10, 30],
    popupAnchor: [1, -34],
    shadowSize: [30, 30]
});
var blackIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-black.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});
var yellowIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-yellow.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [20, 30],
    iconAnchor: [10, 30],
    popupAnchor: [1, -34],
    shadowSize: [30, 30]
});

var violetIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-violet.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [20, 30],
    iconAnchor: [10, 30],
    popupAnchor: [1, -34],
    shadowSize: [30, 30]
});



const baseLayers = {
    'Google Streets': googleStreets,
    'Google Satelite': googleSat,
    'Open Street Map': peta3
};



// Menambahkan seluruh data 2023
const data_2023 = L.layerGroup();
const sebelum_2023 = L.layerGroup();

<?php    
        $CI =& get_instance();
        $CI->load->model('m_sosialisasi'); 
         
        foreach ($lokasi_sosialisasi as $key => $value) {
        $tanggal= $CI->m_sosialisasi->tanggal_kunjungan_terbaru($value->id_lokasi);
        if ($tanggal>=date('2023-01-01')) {
         continue;   
        }?>
        
         
L.marker([<?=$value->koordinat?>] <?php if ($value->jenis_lokasi =='Sekolah') { ?>, {
        icon: greenIcon
    }
    <?php } elseif($value->jenis_lokasi =='Kantor Pemerintah') { ?>, {
        icon: yellowIcon
    }
    <?php } elseif($value->jenis_lokasi =='Kantor Swasta') { ?>, {
        icon: violetIcon
    }
    <?php } elseif($value->jenis_lokasi =='Lain lain') { ?>, {
        icon: blueIcon
    }
    <?php } ?>

).bindTooltip("<h7><b><?php
    $jml = $CI->m_sosialisasi->ambil_jumlah_kunjungan($value->id_lokasi);       
    echo $value->nama_lokasi.' ('.$jml.')';?></h7></b>", {
    permanent: false,
    direction: 'right'
}).bindPopup("<h5><b> <?=$value->nama_lokasi.' ('.$jml.')'?></b> <h5>" +
    "<h6>Detail Lokasi : <?=$value->detail_lokasi?><h6>" +
    "<h6><?php   
            echo 'Kunjungan : '.$tanggal; ?> </h6>" +
    "<div class='text-center mt-1' style= 'margin: 1px;'>" +
    "<a class='btn btn-xs btn-success' href='<?=base_url('sosialisasi/detail_sosialisasi/'.$value->id_lokasi) ?>'> Detail</a> " +
    "<a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>' href='<?=base_url('sosialisasi/edit/'.$value->id_lokasi) ?>'> Edit</a> " +
    "<a class='btn btn-xs btn-danger <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>' onclick='del(`<?=base_url('sosialisasi/delete/'.$value->id_lokasi) ?>`,`<?=$value->id_lokasi?>`)'> Delete</a> " +
    "</div>").addTo(sebelum_2023);
<?php    } ?>


<?php    
        $CI =& get_instance();
        $CI->load->model('m_sosialisasi'); 
         
        foreach ($lokasi_sosialisasi as $key => $value) {
        $tanggal= $CI->m_sosialisasi->tanggal_kunjungan_terbaru($value->id_lokasi);
        if ($tanggal<date('2023-01-01')) {
         continue;   
        }?>
        
         
L.marker([<?=$value->koordinat?>] <?php if ($value->jenis_lokasi =='Sekolah') { ?>, {
        icon: greenIcon
    }
    <?php } elseif($value->jenis_lokasi =='Kantor Pemerintah') { ?>, {
        icon: yellowIcon
    }
    <?php } elseif($value->jenis_lokasi =='Kantor Swasta') { ?>, {
        icon: violetIcon
    }
    <?php } elseif($value->jenis_lokasi =='Lain lain') { ?>, {
        icon: blueIcon
    }
    <?php } ?>

).bindTooltip("<h7><b><?php
    $jml = $CI->m_sosialisasi->ambil_jumlah_kunjungan($value->id_lokasi);       
    echo $value->nama_lokasi.' ('.$jml.')';?></h7></b>", {
    permanent: false,
    direction: 'right'
}).bindPopup("<h5><b> <?=$value->nama_lokasi.' ('.$jml.')'?></b> <h5>" +
    "<h6>Detail Lokasi : <?=$value->detail_lokasi?><h6>" +
    "<h6><?php   
            echo 'Kunjungan : '.$tanggal; ?> </h6>" +
    "<div class='text-center mt-1' style= 'margin: 1px;'>" +
    "<a class='btn btn-xs btn-success' href='<?=base_url('sosialisasi/detail_sosialisasi/'.$value->id_lokasi) ?>'> Detail</a> " +
    "<a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>' href='<?=base_url('sosialisasi/edit/'.$value->id_lokasi) ?>'> Edit</a> " +
    "<a class='btn btn-xs btn-danger <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>' onclick='del(`<?=base_url('sosialisasi/delete/'.$value->id_lokasi) ?>`,`<?=$value->nama_lokasi?>`)'> Delete</a> " +
    "</div>").addTo(data_2023);
<?php    } ?>


const map = L.map('map', {
    center: [-8.346562247167757, 115.16081838649232],
    zoom: 10,
    layers: [peta3, data_2023],

});

const overlays = {
    '2023': data_2023,
    'sebelum 2023': sebelum_2023
};

const layerControl = L.control.layers(baseLayers, overlays).addTo(map);



//function edit
function edit(url) {
    open(url);
}

//konfirmasi delete
function del(url, kode) {
    if (confirm("yakin ingin menghapus site " + kode)) {
        window.location.assign(url);
    }
}


//cetak Laporan
$(document).on("click", "[data-column]", function() {

var button = $(this),
    header = $(button.data("column")),
    table = header.closest("table"),
    index = header.index() + 1, // convert to CSS's 1-based indexing
    selector = "tbody tr td:nth-child(" + index + ")",
    column = table.find(selector).add(header);



column.toggleClass("hidden");

const doc = new jspdf.jsPDF('landscape');

// It can parse html:
// <table id="my-table"><!-- ... --></table>
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = dd + '/' + mm + '/' + yyyy;
var text = "Laporan sosialisasimeter " + today
doc.text(text, 12, 10)
doc.autoTable({
    html: '#dataTables-example'
})

doc.save('sosialisasi_'+today+'.pdf')
column.toggleClass("hidden");
});
</script>