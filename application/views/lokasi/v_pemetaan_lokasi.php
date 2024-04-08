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
    "<a class='btn btn-xs btn-success' href='<?=base_url('seismo/detail_seismo/'.$value->id_seismo) ?>'> Detail</a> " +
    "<a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>' href='<?=base_url('seismo/edit/'.$value->id_seismo) ?>'> Edit</a> " +
    "<a class='btn btn-xs btn-danger hidden' href='<?=base_url('seismo/delete/'.$value->id_seismo) ?>'> Delete</a> " +
    "</div>").addTo(seismo);
<?php    } ?>

// Intensity

const inten = L.layerGroup();

<?php 
        $CI =& get_instance();
        $CI->load->model('m_intensity');
        
        foreach ($intensity as $key => $value) {
          $result= $CI->m_intensity->kondisi_kunjungan_terbaru($value->id_intensity);
          $tanggal= $CI->m_intensity->tanggal_kunjungan_terbaru($value->id_intensity);?>
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
            
            $jml = $CI->m_intensity->ambil_jumlah_kunjungan($value->id_intensity);
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
    "<a class='btn btn-xs btn-success' href='<?=base_url('intensity/detail_intensity/'.$value->id_intensity) ?>'> Detail</a> " +
    "<a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>' href='<?=base_url('intensity/edit/'.$value->id_intensity) ?>'> Edit</a> " +
    "<a class='btn btn-xs btn-danger hidden' href='<?=base_url('intensity/delete/'.$value->id_intensity) ?>'> Delete</a> " +
    "</div>").addTo(inten);
<?php    } ?>

// Akhir Intensity

// WRS

const wrs = L.layerGroup();

<?php 
        $CI =& get_instance();
        $CI->load->model('m_wrs');
        
        foreach ($wrs as $key => $value) {
          $result= $CI->m_wrs->kondisi_kunjungan_terbaru($value->id_wrs);
          $tanggal= $CI->m_wrs->tanggal_kunjungan_terbaru($value->id_wrs);?>
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
            
            $jml = $CI->m_wrs->ambil_jumlah_kunjungan($value->id_wrs);
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
    "<a class='btn btn-xs btn-success' href='<?=base_url('wrs/detail_wrs/'.$value->id_wrs) ?>'> Detail</a> " +
    "<a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>' href='<?=base_url('wrs/edit/'.$value->id_wrs) ?>'> Edit</a> " +
    "<a class='btn btn-xs btn-danger hidden' href='<?=base_url('wrs/delete/'.$value->id_wrs) ?>'> Delete</a> " +
    "</div>").addTo(wrs);
<?php    } ?>
// Akhir WRS

//Acc Non colo
const acc_noncolo = L.layerGroup();

<?php 
	$CI =& get_instance();
	$CI->load->model('m_acc_noncolo');
        foreach ($acc_noncolo as $key => $value) {
			$result= $CI->m_acc_noncolo->kondisi_kunjungan_terbaru($value->id_acc_noncolo);
			$tanggal= $CI->m_acc_noncolo->tanggal_kunjungan_terbaru($value->id_acc_noncolo);?>
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
            
            $jml = $CI->m_acc_noncolo->ambil_jumlah_kunjungan($value->id_acc_noncolo);
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
    "<a class='btn btn-xs btn-success' href='<?=base_url('acc_noncolo/detail_acc_noncolo/'.$value->id_acc_noncolo) ?>'> Detail</a> " +
    "<a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>' href='<?=base_url('acc_noncolo/edit/'.$value->id_acc_noncolo) ?>'> Edit</a> " +
    "<a class='btn btn-xs btn-danger hidden' href='<?=base_url('acc_noncolo/delete/'.$value->id_acc_noncolo) ?>'> Delete</a> " +
    "</div>").addTo(acc_noncolo);
<?php    } ?>

// Int Reis
const int_reis = L.layerGroup();

<?php 
	$CI =& get_instance();
	$CI->load->model('m_int_reis');
        foreach ($int_reis as $key => $value) {
			$result= $CI->m_int_reis->kondisi_kunjungan_terbaru($value->id_int_reis);
			$tanggal= $CI->m_int_reis->tanggal_kunjungan_terbaru($value->id_int_reis);?>
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
            
            $jml = $CI->m_int_reis->ambil_jumlah_kunjungan($value->id_int_reis);
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
    "<a class='btn btn-xs btn-success' href='<?=base_url('int_reis/detail_int_reis/'.$value->id_int_reis) ?>'> Detail</a> " +
    "<a class='btn btn-xs btn-warning <?php if ($this->session->userdata('role_id') == 2) {echo 'hidden';}?>' href='<?=base_url('int_reis/edit/'.$value->id_int_reis) ?>'> Edit</a> " +
    "<a class='btn btn-xs btn-danger hidden' href='<?=base_url('int_reis/delete/'.$value->id_int_reis) ?>'> Delete</a> " +
    "</div>").addTo(int_reis);
<?php    } ?>




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


/*Legend Seismo*/

<?php 
$jml_seismo = $CI->m_seismo->jumlah_seismo();
$jml_seismo_off = $CI->m_seismo->jumlah_off();
$jml_seismo_on = $CI->m_seismo->jumlah_on();
$jml_int = $CI->m_intensity->jumlah_intensity();
$jml_int_off = $CI->m_intensity->jumlah_off();
$jml_int_on = $CI->m_intensity->jumlah_on();
$jml_wrs = $CI->m_wrs->jumlah_wrs();
$jml_wrs_off = $CI->m_wrs->jumlah_off();
$jml_wrs_on = $CI->m_wrs->jumlah_on();
$jml_int_reis = $CI->m_int_reis->jumlah_int_reis();
$jml_int_reis_off = $CI->m_int_reis->jumlah_off();
$jml_int_reis_on = $CI->m_int_reis->jumlah_on();
$jml_acc_noncolo = $CI->m_acc_noncolo->jumlah_acc_noncolo();
$jml_acc_noncolo_off = $CI->m_acc_noncolo->jumlah_off();
$jml_acc_noncolo_on = $CI->m_acc_noncolo->jumlah_on();

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
legend.addTo(map2);

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
legend2.addTo(map2);
</script>