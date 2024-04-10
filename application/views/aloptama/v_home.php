<div id="map" style="width: 100%; height: 700px;"></div>

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
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});



const seismo = L.layerGroup();

const baseLayers = {
    'Google Streets': googleStreets,
    'Google Satelite': googleSat,
    'Open Street Map': peta3
};

// const layerControl = L.control.layers(baseLayers).addTo(map);


//Seismo
<?php 
	$CI =& get_instance();
	$CI->load->model('m_aloptama');
        foreach ($seismo as $key => $value):
			$result= $CI->m_aloptama->kondisi_kunjungan_terbaru('seismo',$value->id);
			$tanggal= $CI->m_aloptama->tanggal_kunjungan_terbaru('seismo',$value->id);?>
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
            
            $jml = $CI->m_aloptama->ambil_jumlah_kunjungan('seismo',$value->id);
            echo $value->kode.' ('.$jml.')'?></h7></b>", {
    permanent: <?php if ($value->kondisi_terkini =='ON' && $result=="Dengan Catatan") { ?>
    false
    <?php } elseif($value->kondisi_terkini =='ON') { ?>
    false
    <?php } elseif($value->kondisi_terkini =='OFF') { ?>
    true
    <?php } ?>,
    direction: 'right'
}).bindPopup("<h5><b>Seismo <?=$value->kode.' ('.$jml.')' ?></b> <h5>" +
    "<h6><?=$value->lokasi ?> </h6>" +
    "<h6><?php 
            
            
            
            
            echo 'Kunjungan '.$tanggal.' : '.$result.' ';
            
            
            
            ?> </h6>" +
    "<div class='text-center mt-1' style= 'margin: 1px;'>" +
    "<a class='btn btn-xs btn-success' href='<?=base_url('aloptama/detail_aloptama/seismo/'.$value->id) ?>'> Detail</a> " +
    "<a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>' href='<?=base_url('seismo/edit/'.$value->id) ?>'> Edit</a> " +
    "<a class='btn btn-xs btn-danger hidden' href='<?=base_url('seismo/delete/'.$value->id) ?>'> Delete</a> " +
    "</div>").addTo(seismo);
<?php endforeach ?>

// Intensity

const inten = L.layerGroup();

<?php 
        $CI =& get_instance();
        $CI->load->model('m_aloptama');
        
        foreach ($intensity as $key => $value):
          $result= $CI->m_aloptama->kondisi_kunjungan_terbaru('intensity',$value->id);
          $tanggal= $CI->m_aloptama->tanggal_kunjungan_terbaru('intensity',$value->id);?>
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
            
            $jml = $CI->m_aloptama->ambil_jumlah_kunjungan('intensity',$value->id);
            echo $value->kode.' ('.$jml.')'?></h7></b>", {
    permanent: <?php if ($value->kondisi_terkini =='ON' && $result=="Dengan Catatan") { ?>
    false
    <?php } elseif($value->kondisi_terkini =='ON') { ?>
    false
    <?php } elseif($value->kondisi_terkini =='OFF') { ?>
    true
    <?php } ?>,
    direction: 'right'
}).bindPopup("<h5><b>Intensity <?=$value->kode.' ('.$jml.')' ?></b> <h5>" +
    "<h6><?=$value->lokasi ?> </h6>" +
    "<h6><?php 
            
            
            
            
            echo 'Kunjungan '.$tanggal.' : '.$result.' ';
            
            
            
            ?> </h6>" +
    "<div class='text-center mt-1' style= 'margin: 1px;'>" +
    "<a class='btn btn-xs btn-success' href='<?=base_url('aloptama/detail_aloptama/intensity/'.$value->id) ?>'> Detail</a> " +
    "<a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>' href='<?=base_url('intensity/edit/'.$value->id) ?>'> Edit</a> " +
    "<a class='btn btn-xs btn-danger hidden' href='<?=base_url('intensity/delete/'.$value->id) ?>'> Delete</a> " +
    "</div>").addTo(inten);
<?php endforeach ?>

// Akhir Intensity

// WRS

const wrs = L.layerGroup();

<?php 
        $CI =& get_instance();
        $CI->load->model('m_aloptama');
        
        foreach ($wrs as $key => $value) :
          $result= $CI->m_aloptama->kondisi_kunjungan_terbaru('wrs',$value->id);
          $tanggal= $CI->m_aloptama->tanggal_kunjungan_terbaru('wrs',$value->id);?>
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
            
            $jml = $CI->m_aloptama->ambil_jumlah_kunjungan('wrs',$value->id);
            echo $value->lokasi.' ('.$jml.')'?></h7></b>", {
    permanent: <?php if ($value->kondisi_terkini =='ON' && $result=="Dengan Catatan") { ?>
    false
    <?php } elseif($value->kondisi_terkini =='ON') { ?>
    false
    <?php } elseif($value->kondisi_terkini =='OFF') { ?>
    true
    <?php } ?>,
    direction: 'right'
}).bindPopup("<h5><b>WRS <?=$value->lokasi.' ('.$jml.')' ?></b> <h5>" +
    "<h6><?=$value->detail_lokasi ?> </h6>" +
    "<h6><?php 
            
            
            
            
            echo 'Kunjungan '.$tanggal.' : '.$result.' ';
            
            
            
            ?> </h6>" +
    "<div class='text-center mt-1' style= 'margin: 1px;'>" +
    "<a class='btn btn-xs btn-success' href='<?=base_url('aloptama/detail_aloptama/wrs/'.$value->id) ?>'> Detail</a> " +
    "<a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>' href='<?=base_url('wrs/edit/'.$value->id) ?>'> Edit</a> " +
    "<a class='btn btn-xs btn-danger hidden' href='<?=base_url('wrs/delete/'.$value->id) ?>'> Delete</a> " +
    "</div>").addTo(wrs);
<?php endforeach ?>
// Akhir WRS

//Acc Non colo
const acc_noncolo = L.layerGroup();

<?php 
	$CI =& get_instance();
	$CI->load->model('m_aloptama');
        foreach ($acc_noncolo as $key => $value) :
			$result= $CI->m_aloptama->kondisi_kunjungan_terbaru('acc_noncolo',$value->id);
			$tanggal= $CI->m_aloptama->tanggal_kunjungan_terbaru('acc_noncolo',$value->id);?>
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
            
            $jml = $CI->m_aloptama->ambil_jumlah_kunjungan('acc_noncolo',$value->id);
            echo $value->kode.' ('.$jml.')'?></h7></b>", {
    permanent: <?php if ($value->kondisi_terkini =='ON' && $result=="Dengan Catatan") { ?>
    false
    <?php } elseif($value->kondisi_terkini =='ON') { ?>
    false
    <?php } elseif($value->kondisi_terkini =='OFF') { ?>
    true
    <?php } ?>,
    direction: 'right'
}).bindPopup("<h5><b>Acc Noncolo <?=$value->kode.' ('.$jml.')' ?></b> <h5>" +
    "<h6><?=$value->lokasi ?> </h6>" +
    "<h6><?php 
            
            
            
            
            echo 'Kunjungan '.$tanggal.' : '.$result.' ';
            
            
            
            ?> </h6>" +
    "<div class='text-center mt-1' style= 'margin: 1px;'>" +
    "<a class='btn btn-xs btn-success' href='<?=base_url('aloptama/detail_aloptama/acc_noncolo/'.$value->id) ?>'> Detail</a> " +
    "<a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>' href='<?=base_url('acc_noncolo/edit/'.$value->id) ?>'> Edit</a> " +
    "<a class='btn btn-xs btn-danger hidden' href='<?=base_url('acc_noncolo/delete/'.$value->id) ?>'> Delete</a> " +
    "</div>").addTo(acc_noncolo);
<?php endforeach ?>

// Int Reis
const int_reis = L.layerGroup();

<?php 
	$CI =& get_instance();
	$CI->load->model('m_aloptama');
        foreach ($int_reis as $key => $value):
			$result= $CI->m_aloptama->kondisi_kunjungan_terbaru('int_reis',$value->id);
			$tanggal= $CI->m_aloptama->tanggal_kunjungan_terbaru('int_reis',$value->id);?>
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
            
            $jml = $CI->m_aloptama->ambil_jumlah_kunjungan('int_reis',$value->id);
            echo $value->kode.' ('.$jml.')'?></h7></b>", {
    permanent: <?php if ($value->kondisi_terkini =='ON' && $result=="Dengan Catatan") { ?>
    false
    <?php } elseif($value->kondisi_terkini =='ON') { ?>
    false
    <?php } elseif($value->kondisi_terkini =='OFF') { ?>
    true
    <?php } ?>,
    direction: 'right'
}).bindPopup("<h5><b>Int Reis <?=$value->kode.' ('.$jml.')' ?></b> <h5>" +
    "<h6><?=$value->lokasi ?> </h6>" +
    "<h6><?php 
            
            
            
            
            echo 'Kunjungan '.$tanggal.' : '.$result.' ';
            
            
            
            ?> </h6>" +
    "<div class='text-center mt-1' style= 'margin: 1px;'>" +
    "<a class='btn btn-xs btn-success' href='<?=base_url('aloptama/detail_aloptama/int_reis/'.$value->id) ?>'> Detail</a> " +
    "<a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>' href='<?=base_url('int_reis/edit/'.$value->id) ?>'> Edit</a> " +
    "<a class='btn btn-xs btn-danger hidden' href='<?=base_url('int_reis/delete/'.$value->id) ?>'> Delete</a> " +
    "</div>").addTo(int_reis);
<?php endforeach ?>


const map = L.map('map', {
    center: [-8.346562247167757, 115.16081838649232],
    zoom: 10,
    layers: [googleStreets, seismo, inten, wrs, acc_noncolo, int_reis],

});
const overlays = {
    'Seismo': seismo,
    'Intensity': inten,
    'WRS': wrs,
    'Acc Noncolo': acc_noncolo,
    'Intensity Reis': int_reis
};

const layerControl = L.control.layers(baseLayers, overlays).addTo(map);

<?php 
$jml_seismo = $CI->m_aloptama->jumlah_aloptama('seismo');
$jml_seismo_off = $CI->m_aloptama->jumlah_off('seismo');
$jml_seismo_on = $CI->m_aloptama->jumlah_on('seismo');
$jml_int = $CI->m_aloptama->jumlah_aloptama('intensity');
$jml_int_off = $CI->m_aloptama->jumlah_off('intensity');
$jml_int_on = $CI->m_aloptama->jumlah_on('intensity');
$jml_wrs = $CI->m_aloptama->jumlah_aloptama('wrs');
$jml_wrs_off = $CI->m_aloptama->jumlah_off('wrs');
$jml_wrs_on = $CI->m_aloptama->jumlah_on('wrs');
$jml_int_reis = $CI->m_aloptama->jumlah_aloptama('int_reis');
$jml_int_reis_off = $CI->m_aloptama->jumlah_off('int_reis');
$jml_int_reis_on = $CI->m_aloptama->jumlah_on('int_reis');
$jml_acc_noncolo = $CI->m_aloptama->jumlah_aloptama('acc_noncolo');
$jml_acc_noncolo_off = $CI->m_aloptama->jumlah_off('acc_noncolo');
$jml_acc_noncolo_on = $CI->m_aloptama->jumlah_on('acc_noncolo');

?>
var legend = L.control({
    position: "bottomleft"
});

legend.onAdd = function(map) {
    var div = L.DomUtil.create("div", "legend");
    div.innerHTML += "<span><h4>Kondisi seismometer</h4></span>";
    div.innerHTML += '<span>Jumlah : <?=$jml_seismo?> </span><br>';
    div.innerHTML += '<i style="background: #000000"></i><span>OFF : <?=$jml_seismo_off?></span><br>';
    div.innerHTML += '<i style="background: #008000"></i><span>ON : <?=$jml_seismo_on?></span><br>';
    div.innerHTML += "<h4>Kondisi Intensity Realshake</h4>";
    div.innerHTML += '<span>Jumlah : <?=$jml_int?> </span><br>';
    div.innerHTML += '<i style="background: #000000"></i><span>OFF : <?=$jml_int_off?></span><br>';
    div.innerHTML += '<i style="background: #008000"></i><span>ON : <?=$jml_int_on?></span><br>';


    return div;
};
legend.addTo(map);

var legend2 = L.control({
    position: "bottomright"
});

legend2.onAdd = function(map) {
    var div = L.DomUtil.create("div", "legend");
    div.innerHTML += "<h4>Kondisi WRS</h4>";
    div.innerHTML += '<span>Jumlah : <?=$jml_wrs?> </span><br>';
    div.innerHTML += '<i style="background: #000000"></i><span>OFF : <?=$jml_wrs_off?></span><br>';
    div.innerHTML += '<i style="background: #008000"></i><span>ON : <?=$jml_wrs_on?></span><br>';
    div.innerHTML += "<h4>Kondisi Acc Noncolo</h4>";
    div.innerHTML += '<span>Jumlah : <?=$jml_acc_noncolo?> </span><br>';
    div.innerHTML += '<i style="background: #000000"></i><span>OFF : <?=$jml_acc_noncolo_off?></span><br>';
    div.innerHTML += '<i style="background: #008000"></i><span>ON : <?=$jml_acc_noncolo_on?></span><br>';
    div.innerHTML += "<h4>Kondisi Intensity Reis</h4>";
    div.innerHTML += '<span>Jumlah : <?=$jml_int_reis?> </span><br>';
    div.innerHTML += '<i style="background: #000000"></i><span>OFF : <?=$jml_int_reis_off?></span><br>';
    div.innerHTML += '<i style="background: #008000"></i><span>ON : <?=$jml_int_reis_on?></span><br>';



    return div;
};
legend2.addTo(map);

</script>