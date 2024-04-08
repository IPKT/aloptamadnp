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
    <h2>List seismo</h2>
    <button class="btn btn-m btn-success hidden" type="button" data-column="#column_action">Cetak Laporan</button>
    <button class="btn btn-m btn-success" type="button" data-column="#column-action">Cetak Laporan PDF</button><span>   </span><button class="btn btn-m btn-success" type="button" data-kolom="#column-a" >Cetak Laporan Excel</button> <br> <br>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>No</th>
                <th>Site</th>
                <th>Lokasi</th>
                <th>Kondisi</th>
                <th>Kunjungan</th>
                <th>Last Kunjungan</th>
                <th>Rekomendasi Terakhir</th>
                <th>Kerusakan</th>
                <th>Catatan Teknisi</th>
                <th id="column_action" <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
        $CI =& get_instance();
        $CI->load->model('m_seismo');
        $seismo = $CI->m_seismo->allData(); 
        foreach($seismo as $key => $value){?>
            <tr>
                <td><?=$no++?></td>
                <td><a href="<?=base_url('seismo/detail_seismo/'.$value->id_seismo) ?>"><?=$value->kode?></a></td>
                <td><?=$value->lokasi?></td>
                <td><?=$value->kondisi_terkini?></td>
                <td><?=$jml = $CI->m_seismo->ambil_jumlah_kunjungan($value->id_seismo);?></td>
                <td><?php $tanggal= $CI->m_seismo->tanggal_kunjungan_terbaru($value->id_seismo);
                 $newDate = date("d-m-Y", strtotime($tanggal));  
                 echo $newDate;
                ?></td>

                <td><?php 
                $rekomendasi= $CI->m_seismo->rekomendasi_kunjungan_terbaru($value->id_seismo);
                if ($rekomendasi != NULL and $rekomendasi != "" ) {
                  # code...
                  $reko = str_replace("\n", '<br />', $rekomendasi->rekomendasi);
                  echo $reko;
                };
                if (($rekomendasi= $CI->m_seismo->rekomendasi_kunjungan_terbaru($value->id_seismo)) == "") {
                  # code...
                };?></td>


                <td><?php 
                $kerusakan= $CI->m_seismo->kerusakan_kunjungan_terbaru($value->id_seismo);
                if ($kerusakan != NULL and $kerusakan != "" ) {
                  # code...
                  // $ker = str_replace("\n", '<br />', $kerusakan->kerusakan);
                  echo $kerusakan->kerusakan;
                };
                if (($kerusakan= $CI->m_seismo->kerusakan_kunjungan_terbaru($value->id_seismo)) == "") {
                  # code...
                };?></td>

                <td><?php $catatan = str_replace("\n", '<br />', $value->catatan);
                    echo $catatan;?>

                </td>
                <td <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>>
                    <a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>'
                        href='<?=base_url('seismo/edit/'.$value->id_seismo) ?>'>
                        Edit</a>
                    <a class='btn btn-xs btn-danger hidden  <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>'
                        onclick="del('<?=base_url('seismo/delete/'.$value->id_seismo) ?>' , '<?=$value->kode?>')">
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


var greenIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
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
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
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
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

var violetIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-violet.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

const map = L.map('map', {
    center: [-8.346562247167757, 115.16081838649232],
    zoom: 10,
    layers: [peta3]
});

const baseLayers = {
    'Default': peta3,
    'Satelite': peta2,
    'Street': peta3,
    'Dark': peta4,
};

const layerControl = L.control.layers(baseLayers).addTo(map);



<?php 
        $CI =& get_instance();
        $CI->load->model('m_seismo');
        
        foreach ($seismo as $key => $value) {
          $result= $CI->m_seismo->kondisi_kunjungan_terbaru($value->id_seismo);
          $tanggal= $CI->m_seismo->tanggal_kunjungan_terbaru($value->id_seismo);?>
L.marker([<?=$value->koordinat?>] <?php if ($value->kondisi_terkini =='ON' && $result=="Dengan Catatan") { ?>, {
        icon: violetIcon
    }
    <?php } elseif($value->kondisi_terkini =='ON') { ?>, {
        icon: greenIcon
    }
    <?php } elseif($value->kondisi_terkini =='OFF') { ?>, {
        icon: blackIcon
    }
    <?php } ?>







).bindTooltip("<h7><b><?php
            
            $jml = $CI->m_seismo->ambil_jumlah_kunjungan($value->id_seismo);
            echo $value->kode.' ('.$jml.')'?></h7></b>", {
    permanent: true,
    direction: 'right'
}).bindPopup("<h5><b> <?=$value->kode.' ('.$jml.')' ?></b> <h5>" +
    "<h6><?=$value->lokasi ?> </h6>" +
    "<h6><?php 
            
            
            
            
            echo 'Kunjungan '.$tanggal.' : '.$result.' ';
            
            
            
            ?> </h6>" +
    "<div class='text-center mt-1' style= 'margin: 1px;'>" +
    "<a class='btn btn-xs btn-success' href='<?=base_url('seismo/detail_seismo/'.$value->id_seismo) ?>'> Detail</a> " +
    "<a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>' href='<?=base_url('seismo/edit/'.$value->id_seismo) ?>'> Edit</a> " +
    "<a class='btn btn-xs btn-danger hidden <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>' onclick='del(`<?=base_url('seismo/delete/'.$value->id_seismo) ?>`,`<?=$value->kode?>`)'> Delete</a> " +
    "</div>").addTo(map);
<?php    } ?>
<?php $jml_int = $CI->m_seismo->jumlah_seismo();
          $jml_off = $CI->m_seismo->jumlah_off();
          $jml_on = $CI->m_seismo->jumlah_on(); ?>

/*Legend specific*/
var legend = L.control({
    position: "bottomleft"
});

legend.onAdd = function(map) {
    var div = L.DomUtil.create("div", "legend");
    div.innerHTML += "<h4>Kondisi seismometer</h4>";
    div.innerHTML += '<span>Jumlah : <?=$jml_int?> </span><br>';
    div.innerHTML += '<i style="background: #000000"></i><span>OFF : <?=$jml_off?></span><br>';
    div.innerHTML += '<i style="background: #008000"></i><span>ON : <?=$jml_on?></span><br>';



    return div;
};

legend.addTo(map);

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
var text = "Laporan Seismometer " + today
doc.text(text, 12, 10)
doc.autoTable({
    html: '#dataTables-example'
})

doc.save('seismo_'+today+'.pdf')
column.toggleClass("hidden");
});


function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('dataTables-example');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Seismo.' + (type || 'xlsx')));
    }

$(document).on("click", "[data-kolom]", function() {

// var button = $(this),
//     header = $(button.data("kolom")),
//     table = header.closest("table"),
//     index = header.index() + 1, // convert to CSS's 1-based indexing
//     selector = "tbody tr td:nth-child(" + index + ")",
//     column = table.find(selector).add(header);



// column.toggleClass("disabled");

ExportToExcel('xlsx');
});
</script>