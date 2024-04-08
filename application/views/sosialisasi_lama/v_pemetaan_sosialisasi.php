<?php 
if ($this->session->flashdata('pesan')) {
  # code...
  echo '<div class="alert alert-success">';
  echo $this->session->flashdata('pesan');
  echo '</div>';
}
?>
<div class="container">
  <h1>HAYYYY</h1>
</div>
<div id="map" style="width: 100%; height: 700px;"></div>

<div class="table-responsive m-3">
    <h2>List Kunjungan</h2>
    <button class="btn btn-m btn-success" type="button" data-column="#column_action">Cetak Laporan</button> <br> </br>
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
                <td>....</td>
                <td>
                    <a class='btn btn-xs btn-success'
                        href='<?=base_url('sosialisasi/detail/'.$value->id_lokasi) ?>'>
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
    var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11'
	});

var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/satellite-v9'
	});


var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	});

var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
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

    const map = L.map('map', {
		center: [-8.346562247167757, 115.16081838649232],
		zoom: 10,
		layers: [peta1]
	});

	const baseLayers = {
		'Default': peta1,
		'Satelite': peta2,
        'Street': peta3,
        'Dark': peta4,
	};

    const layerControl = L.control.layers(baseLayers).addTo(map);
	


    <?php 
        foreach ($lokasi_sosialisasi as $key => $value) {?> 
            L.marker([<?=$value->koordinat?>]
			) .bindTooltip("<b><?= $value->nama_lokasi?></b>", {
        		permanent: true, 
        		direction: 'right'
    		}).bindPopup("<h5><b> <?=$value->nama_lokasi ?></b> <h5>" +
            "<h6><?=$value->jenis_lokasi ?> </h6>" + 
            "<h6><?=$value->detail_lokasi ?> </h6>" +
            "<h6>Jenis : <?=$value->kabupaten ?> </h6>" +  
     
			"<div class='text-center mt-1' style= 'margin: 1px;'>" +
      "<a class='btn btn-xs btn-success' href='<?=base_url('sosialisasi/detail/'.$value->id_lokasi) ?>'> Detail</a> "+
			"<a class='btn btn-xs btn-warning' href='<?=base_url('sosialisasi/edit/'.$value->id_lokasi) ?>'> Edit</a> "+
			"<a class='btn btn-xs btn-danger' href='<?=base_url('sosialisasi/delete/'.$value->id_lokasi) ?>'> Delete</a> "+
			"</div>").addTo(map);
    <?php    } ?>
</script>